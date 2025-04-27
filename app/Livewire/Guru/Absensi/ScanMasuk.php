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

class ScanMasuk extends Component
{
    public $kelas, $siswaId, $siswa;

    
    public function render()
    {
        return view('livewire.guru.absensi.scan-masuk');
    }

    public function mount($id) {
        $this->kelas = ClassRoom::find($id);
    }

    #[On('qr-scanned')]
    public function handleScan(array $data)
    {
        if (!isset($data['code'])) {
            return $this->handleScanEror($data);
        }

        $student = Student::where('nisn', $data['code'])->first();
        $user = User::where('username', $data['code'])->first();
        $this->siswaId = $student->id;
        $siswaKelasId =  $student->kelas_id;

        $absensi = Attendance::where('tanggal', now()->format('Y-m-d'))
        ->where('student_id', $this->siswaId)->first();

        if ($absensi) {
            return redirect()->route('guru.absensi.scan.masuk', $this->kelas->id)
                ->info('Sudah melakukan Absensi');
        }

        if ($student && $siswaKelasId === $this->kelas->id) {
           $this->store();
        }else {
            return redirect()->route('guru.absensi.scan.masuk', $this->kelas->id)
                ->warning('warning. Siswa: '. $user->name . ' tidak terdaftar pada kelas ini');
        }
    }

    public function store() {
        $this->siswa = Student::find($this->siswaId);

        DB::beginTransaction();
        try {
            Attendance::create([
                'student_id' => $this->siswa->id,
                'class_room_id' => $this->kelas->id,
                'tanggal' => now()->format('Y-m-d'),
                'jam_masuk' => now()->format('H:i:s'),
                'status' => StatusAbsensi::others->value,
                'message' => 'Scanned Masuk by. '. Auth::user()->name .' at '. now()->format('H:i:s'),
                'scanned_masuk_by' => Auth::user()->teacher->id
            ]);

            DB::commit();

            return redirect()->route('guru.absensi.scan.masuk', $this->kelas->id)
            ->success('Berhasil melakukan Scan masuk');
        } catch (\Exception $e) {
            DB::rollBack();
            Toaster::error('Eror: '.$e->getMessage());
        }
    }

    #[On('qr-scanned-failed')]
    public function handleScanEror($error) {
        return redirect()->route('guru.absensi.scan.masuk', $this->kelas->id)
        ->error('EROR: '. $error);
    }
}
