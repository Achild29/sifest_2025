<?php

namespace App\Livewire\Guru\Absensi;

use App\Models\ClassRoom;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Absensi extends Component
{
    public $ClassRooms;

    public function render()
    {
        return view('livewire.guru.absensi.absensi');
    }

    public function mount() {
        $this->ClassRooms = ClassRoom::with('students')
        ->where('teacher_id', Auth::user()->teacher->id)
        ->get();
    }
}
