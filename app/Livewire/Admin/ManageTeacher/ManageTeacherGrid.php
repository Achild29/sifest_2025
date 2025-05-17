<?php

namespace App\Livewire\Admin\ManageTeacher;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ManageTeacherGrid extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $search = '';

    public function render()
    {
        $data = User::where('role', UserRole::guru->value)
            ->where('name', 'like', '%'.$this->search.'%')
            ->orWhereHas('teacher', function (Builder $query) {
                $query->where('username', 'like', '%'.$this->search.'%')
                ->orWhereHas('classRooms', function (Builder $q) {
                    $q->where('name', 'like', '%'.$this->search.'%');
                });
            })
            ->paginate(3);
        return view('livewire.admin.manage-teacher.manage-teacher-grid', [
            'teachers' => $data
        ]);
    }

    public function searchFocus() {
        $this->resetPage();
    }

    public function showEdit($id) {
        $this->dispatch('update-teacher', $id);
    }

    public function showConfirmDelete($id) {
        $this->dispatch('delete-teacher', $id);
    }
}
