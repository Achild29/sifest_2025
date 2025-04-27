<?php

namespace App\Livewire\Guru\Absensi;

use App\Enums\StatusAbsensi;
use App\Models\Attendance;
use App\Models\ClassRoom;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class ScanPulang extends Component
{
    public $kelas;
    protected $absenId;

    public function render()
    {
        return view('livewire.guru.absensi.scan-pulang');
    }

    public function mount($id) {
        $this->kelas = ClassRoom::find($id);
    }

    #[On('qr-scanned-pulang')]
    public function handleScan(array $data) {
        if (isset($data['status'])) {
            return $this->dispatch('qr-scanned-failed-pulang', $data);
        }

        $student = Student::where('nisn', $data['code'])->first();
        if (!$student) return redirect()->route('guru.absensi.scan.masuk', $this->kelas->id)
            ->error('QR-CODE tidak terdaftar dalam database');

        $user = User::where('username', $data['code'])->first();
        $absen = Attendance::where('tanggal', now()->format('Y-m-d'))
        ->where('student_id', $student->id)->first();

        
        if ($absen) {
            if ($absen->class_room_id === $this->kelas->id){
                if ($absen->status === StatusAbsensi::others->value) {
                    $this->absenId = $absen->id;
                    return $this->updatePulang();              
                }
                if ($absen && $absen->status === StatusAbsensi::hadir->value) return redirect()->route('guru.absensi.scan.pulang', $this->kelas->id)
                        ->info($user->name.' sudah melakukan absensi pulang');
                if ($absen && $absen->status === StatusAbsensi::izin->value) return redirect()->route('guru.absensi.scan.pulang', $this->kelas->id)
                    ->info($user->name.' sudah melakukan absensi, status absensinya adalah Izin');
                if ($absen && $absen->status === StatusAbsensi::sakit->value) return redirect()->route('guru.absensi.scan.pulang', $this->kelas->id)
                    ->info($user->name.' sudah melakukan absensi, status absensinya adalah sakit');
                if ($absen && $absen->status === StatusAbsensi::alpha->value) return redirect()->route('guru.absensi.scan.pulang', $this->kelas->id)
                    ->warning($user->name.' sudah melakukan absensi, status absensinya adalah Alpha');
            }
            return redirect()->route('guru.absensi.scan.pulang', $this->kelas->id)
                ->info($user->name.' bukan Anggota kelas '. $this->kelas->name . ' ini');
        }else {
            return redirect()->route('guru.absensi.scan.pulang', $this->kelas->id)
                ->info($user->name.' Belum Melakukan Absensi Masuk');
        }
    }

    public function updatePulang() {
        $absensi = Attendance::find($this->absenId);
        $student = Student::find($absensi->student_id);
        DB::beginTransaction();
        try {
            $absensi->jam_pulang = now()->format('H:i:s');
            $absensi->status = StatusAbsensi::hadir;
            $absensi->message = "Hadir. Scanned Pulang by ". Auth::user()->name . " at ". now()->format('H:i:s');
            $absensi->scanned_pulang_by = Auth::user()->teacher->id;
            $absensi->save();

            DB::commit();
            return redirect()->route('guru.absensi.scan.pulang', $this->kelas->id)
                ->success('Berhasil Scan Pulang! '. $student->user->name . 'Hati-hati di Jalan!');
        } catch (\Exception $e) {
            DB::rollBack();
            Toaster::error('Gagal : '.$e->getMessage());
        }
    }

    #[On('qr-scanned-failed-pulang')]
    public function handleScanEror($error) {
        return redirect()->route('guru.absensi.scan.masuk', $this->kelas->id)
        ->error('Status: '. $error['status']. 'eror: '.$error['error']);
    }
}
