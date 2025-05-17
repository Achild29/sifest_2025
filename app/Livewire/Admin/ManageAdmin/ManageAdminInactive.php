<?php

namespace App\Livewire\Admin\ManageAdmin;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ManageAdminInactive extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $search = '';

    public function render()
    {
        $data = User::onlyTrashed()
            ->where('role', UserRole::admin)
            ->where('id', '!=', Auth::id())
            ->whereAny([
                'name',
                'username'
            ], 'like', '%'.$this->search.'%')
            ->paginate(3);
            
        return view('livewire.admin.manage-admin.manage-admin-inactive', [
            'users' => $data
        ]);
    }

    public function searchFocus() {
        $this->resetPage();
    }

    public function showRestore($id) {
        $this->dispatch('showRestore', $id);
    }

    public function showConfirmDelete($id) {
        $this->dispatch('showConfirmDelete', $id);
    }
}
