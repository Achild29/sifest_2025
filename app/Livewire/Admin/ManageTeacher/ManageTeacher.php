<?php

namespace App\Livewire\Admin\ManageTeacher;

use App\Enums\UserRole;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class ManageTeacher extends Component
{

    public $teachers;

    public function render()
    {
        return view('livewire.admin.manage-teacher.manage-teacher');
    }

    #[On(['teacher-created', 'teacher-updated'])]
    public function mount() {
        $this->teachers = User::where('role', UserRole::guru)
        ->with('teacher.classRooms')->get();
    }

    public function edit($id) {
        $this->dispatch('update-teacher', $id);
    }

    public function delete($id) {
        $this->dispatch('delete-teacher', $id);
    }    
}
