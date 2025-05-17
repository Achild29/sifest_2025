<?php

namespace App\Livewire\Admin\ManageStudents;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class ManageStudentsTable extends Component
{
    use WithPagination;

    public $search;

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
            ->paginate(5);
        return view('livewire.admin.manage-students.manage-students-table',[
            'students' => $data
        ]);
    }

    public function searchFocus() {
        $this->resetPage();
    }

    public function showEdit($id) {
        $this->dispatch('update-student', $id);
    }

    public function showDelete($id) {
        $this->dispatch('delete-student', $id);
    }
}
