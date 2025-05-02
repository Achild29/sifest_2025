<?php

namespace App\Livewire\Guru;

use App\Models\ClassRoom;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public $classRooms;

    public function render()
    {
        return view('livewire.guru.dashboard');
    }

    public function mount() {
        $user = User::find(Auth::user()->id);
        $this->classRooms = ClassRoom::where('teacher_id', $user->teacher->id)->get();

    }

    public function manageKelas() {
        return redirect()->route('manage.kelas');
    }

    public function guruAbsensi() {
        return redirect()->route('guru.absensi');
    }

    public function guruLaporan() {
        return redirect()->route('guru.laporan');
    }
}
