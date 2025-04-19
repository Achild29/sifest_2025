<?php

namespace App\Livewire\Admin;

use App\Enums\UserRole;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class ManageStudent extends Component
{
    public $students;
    public function render()
    {
        return view('livewire.admin.manage-student');
    }

     #[On(['student-created', 'student-updated'])]
    public function mount() {
        $this->students = User::where('role', UserRole::siswa->value)->get();
    }

    public function edit($id) {
        $this->dispatch('update-student', $id);
    }

    public function delete($id) {
        $this->dispatch('delete-student', $id);
    }
}
