<?php

namespace App\Livewire\Guru;

use App\Models\ClassRoom;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class ManageKelas extends Component
{
    public $ClassRooms;

    public function render()
    {
        return view('livewire.guru.manage-kelas');
    }

    #[On(['kelas-created', 'kelas-updated'])]
    public function mount() {
        $this->ClassRooms = ClassRoom::with('students')
        ->where('teacher_id', Auth::user()->teacher->id)
        ->get();
    }

    public function showConfirmDelete($id) {
        $this->dispatch('delete-kelas', $id);
    }
}
