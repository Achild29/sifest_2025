<?php

namespace App\Livewire\Guru\Absensi;

use App\Enums\StatusAbsensi;
use App\Models\Attendance;
use App\Models\ClassRoom;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class AbsensiKelasManual extends Component
{
    public $kelas, $murid;
    protected $status, $message, $absenId, $scannedBy;
    public $siswa;

    public function render()
    {
        return view('livewire.guru.absensi.absensi-kelas-manual');
    }

    public function mount($id) {
        $this->kelas = ClassRoom::find($id);
        $this->murid = Student::where('kelas_id', $this->kelas->id)
            ->with(['user', 'attandances' => function ($q) {
                $q->where('tanggal', now()->format('Y-m-d'));
            }])
            ->join('users', 'students.user_id', '=', 'users.id')
            ->orderBy('users.name', 'asc')
            ->select('students.*')
            ->get();
    }

    public function absenMasuk($id) {
        $this->siswa = Student::find($id);
        $this->status = StatusAbsensi::others->value;
        $this->message = 'Absen Manual Masuk by. '. Auth::user()->name .' at '. now()->format('H:i:s');
        $this->scannedBy = Auth::user()->teacher->id;
        $this->store();
    }
    
    public function absenIzin($id) {
        $this->siswa = Student::find($id);
        $this->status = StatusAbsensi::izin->value;
        $this->message = 'status: Izin, change by. '. Auth::user()->name .' at '. now()->format('H:i:s');
        $this->store();
    }
    public function absenSakit($id) {
        $this->siswa = Student::find($id);
        $this->status = StatusAbsensi::sakit->value;
        $this->message = 'status: Sakit, change by. '. Auth::user()->name .' at '. now()->format('H:i:s');
        $this->store();
    }
    
    public function store() {
        DB::beginTransaction();
        try {
            Attendance::create([
                'student_id' => $this->siswa->id,
                'class_room_id' => $this->kelas->id,
                'tanggal' => now()->format('Y-m-d'),
                'jam_masuk' => now()->format('H:i:s'),
                'status' => $this->status,
                'message' => $this->message,
                'scanned_masuk_by' => $this->scannedBy
            ]);
    
            DB::commit();
            return redirect()->route('guru.absensi.kelas.manual', $this->kelas->id)
                ->success('Berhasil melakukan Absensi Masuk');
        } catch (\Exception $e) {
            DB::rollBack();
            Toaster::error('Gagal: '.$e->getMessage());
        }
    }

    public function pulang($id) {
        $absen = Attendance::find($id);
        DB::beginTransaction();
        try {
            $absen->jam_pulang = now()->format('H:i:s');
            $absen->status = StatusAbsensi::hadir;
            $absen->message = "Hadir. Absen Pulang Manual by ". Auth::user()->name . " at ". now()->format('H:i:s');
            $absen->scanned_pulang_by = Auth::user()->teacher->id;
            $absen->save();
            
            DB::commit();
            return redirect()->route('guru.absensi.kelas.manual', $this->kelas->id)
                ->success('Berhasil melakukan Absensi Pulang');
        } catch (\Exception $e) {
            DB::rollBack();
            Toaster::error('Eror: '.$e->getMessage());
        }
    }
}
