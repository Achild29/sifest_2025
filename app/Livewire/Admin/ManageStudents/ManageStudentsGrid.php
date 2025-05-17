<?php

namespace App\Livewire\Admin\ManageStudents;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ManageStudentsGrid extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $search = '';

    public function render()
    {
        $data = User::where('role', UserRole::siswa->value)
            ->where('name', 'like', '%'.$this->search.'%')
            ->orWhereHas('student', function (Builder $query) {
                $query->where('username', 'like', '%'.$this->search.'%')
                ->orWhereHas('classRoom', function (Builder $q) {
                    $q->where('name', 'like', '%'.$this->search.'%');
                });
            })
            ->paginate(3);
        
        return view('livewire.admin.manage-students.manage-students-grid', [
            'siswa' => $data
        ]);
    }

    public function searchFocus() {
        $this->resetPage();
    }

    public function showEdit($id) {
        $this->dispatch('update-student', $id);
    }

    public function showConfirmDelete($id) {
        $this->dispatch('delete-student', $id);
    }
}
