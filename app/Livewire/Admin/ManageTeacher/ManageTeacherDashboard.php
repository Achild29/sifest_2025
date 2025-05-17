<?php

namespace App\Livewire\Admin\ManageTeacher;

use App\Enums\UserRole;
use App\Models\User;
use Livewire\Component;

class ManageTeacherDashboard extends Component
{
    public $isGridView = true;
    public $jumlahSiswa;

    public function render()
    {
        return view('livewire.admin.manage-teacher.manage-teacher-dashboard');
    }
    public function mount() {
        $this->jumlahSiswa = User::where('role', UserRole::guru->value)->count();
    }

    public function addNewTeacher() {
        $this->dispatch('addNewTeacherModal');
    }
}
