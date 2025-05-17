<?php

namespace App\Livewire\Admin\ManageAdmin;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ManageAdminDashboard extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $isActive = true;
    public $search = '';
    public $faker;

    public function render()
    {
        $data = User::where('role', UserRole::admin->value)
            ->where('id', '!=', Auth::id())
            ->whereAny([
                'name',
                'username'
            ], 'like', '%'.$this->search.'%')
            ->paginate(3);
        return view('livewire.admin.manage-admin.manage-admin-dashboard', [
            'users' => $data,
        ]);
    }

    public function searchFocus() {
        $this->resetPage();
    }

    public function showDeletedUser() {
        $this->isActive = false;
    }

    public function showActiveUser() {
        $this->isActive = true;
    }

    public function addUser() {
        $this->dispatch('addUser');
    }

    public function showReset($id) {
        $this->dispatch('showReset', $id);
    }
}
