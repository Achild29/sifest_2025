<?php

namespace App\Livewire\Guru\Absensi;

use App\Enums\StatusAbsensi;
use App\Models\Attendance;
use App\Models\ClassRoom;
use App\Models\Student;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class AbsensiKelas extends Component
{
    public $kelas, $murid;
    public $siswa;

    public function render()
    {
        return view('livewire.guru.absensi.absensi-kelas');
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

    public function alphaAbsensi($id) {
        $this->siswa = Student::find($id);
        DB::beginTransaction();
        try {
            Attendance::create([
                'student_id' => $this->siswa->id,
                'class_room_id' => $this->kelas->id,
                'tanggal' => now()->format('Y-m-d'),
                'status' => StatusAbsensi::alpha,
                'message' => 'Tidak Hadir. changed by.' . Auth::user()->name . 'at ' . now()->format('H:i:s'),
            ]);
            DB::commit();
            return redirect()->route('guru.absensi.kelas', $this->kelas->id)
                ->warning('Absensi '.$this->siswa->user->name.' menjadi alpha');
        } catch (\Exception $e) {
            DB::rollBack();
            Toaster::error('Gagal: '.$e->getMessage());
        }
    }

}
