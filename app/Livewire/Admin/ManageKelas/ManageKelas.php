<?php

namespace App\Livewire\Admin\ManageKelas;

use App\Models\ClassRoom;
use Livewire\Component;

class ManageKelas extends Component
{
    public $ClassRooms;

    public function render()
    {
        return view('livewire.admin.manage-kelas.manage-kelas');
    }

    public function mount() {
        $this->ClassRooms = ClassRoom::where('teacher_id', null)->get();
    }
}
