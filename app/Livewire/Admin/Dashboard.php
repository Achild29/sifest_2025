<?php

namespace App\Livewire\Admin;

use App\Enums\UserRole;
use App\Models\User;
use Flux\Flux;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Dashboard extends Component
{
    public $guru, $admin, $siswa;

    public function render()
    {
        return view('livewire.admin.dashboard');
    }

    public function mount() {
        $this->guru = User::where('role', UserRole::guru)->get();
        $this->admin = User::where('role', UserRole::admin)->get();
        $this->siswa = User::where('role', UserRole::siswa)->get();
    }

    public function listUsers() {
        return redirect(route('list.users'));
    }

    public function manageTeachers() {
        return redirect(route('manage.teachers'));
    }

    public function manageStudents() {
        return redirect(route('manage.students'));
    }
}
