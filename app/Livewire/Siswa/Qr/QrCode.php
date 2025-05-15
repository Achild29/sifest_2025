<?php

namespace App\Livewire\Siswa\Qr;

use App\Enums\StatusAbsensi;
use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class QrCode extends Component
{
    public bool $absensi = false;
    public bool $masuk = false;
    public bool $pulang = false;

    public function render()
    {
        $this->checkAbsensi();

        return view('livewire.siswa.qr.qr-code');
    }

    public function mount() {
        $this->checkAbsensi();
    }

    public function checkAbsensi() {
        $this->absensi = Attendance::where('student_id', Auth::user()->student->id)
            ->where('tanggal', now()->format('Y-m-d'))
            ->exists();
        $this->masuk = Attendance::where('student_id', Auth::user()->student->id)
            ->where('tanggal', now()->format('Y-m-d'))
            ->where('status', StatusAbsensi::others->value)
            ->exists();
        $this->pulang = Attendance::where('student_id', Auth::user()->student->id)
            ->where('tanggal', now()->format('Y-m-d'))
            ->where('status', StatusAbsensi::hadir->value)
            ->exists();
        if ($this->pulang) {
            $this->dispatch('redirect-dashboard');
        }
    }
}
