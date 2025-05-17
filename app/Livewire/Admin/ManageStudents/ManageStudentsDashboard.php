<?php

namespace App\Livewire\Admin\ManageStudents;

use App\Enums\UserRole;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class ManageStudentsDashboard extends Component
{
    public $jumlahSiswa;
    public $isGridView= true;

    public function render()
    {
        return view('livewire.admin.manage-students.manage-students-dashboard');
    }

    public function mount() {
        $this->jumlahSiswa = User::where('role', UserRole::siswa->value)->count();
    }

    public function addStudent() {
        $this->dispatch('add-new-student');
    }

}
