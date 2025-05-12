<?php

namespace App\Livewire\Siswa;

use App\Enums\StatusAbsensi;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public array $absenHariIni = [];
    public $bulan, $user;

    public function render()
    {
        return view('livewire.siswa.dashboard');
    }

    public function mount() {
        $this->bulan = now()->format('Y-m');
        $this->user = User::find(Auth::user()->id);
        $absen = Attendance::where('student_id', $this->user->student->id)
            ->where('tanggal', now()->format('Y-m-d'))
            ->get();
        if ($absen) {
            foreach ($absen as $item) {
                if ($item->status === StatusAbsensi::hadir->value) {
                    $this->absenHariIni = [
                        'status' => $item->status,
                    ];
                }
                if ($item->status === StatusAbsensi::izin->value) {
                    $this->absenHariIni = [
                        'status' => $item->status,
                    ];
                }
                if ($item->status === StatusAbsensi::alpha->value) {
                    $this->absenHariIni = [
                        'status' => $item->status,
                    ];
                }
                if ($item->status === StatusAbsensi::sakit->value) {
                    $this->absenHariIni = [
                        'status' => $item->status,
                    ];
                }
                if ($item->status === StatusAbsensi::others->value) {
                    $this->absenHariIni = [
                        'status' => $item->status,
                        'message' => $item->message
                    ];
                }
            }
        }
    }
}
