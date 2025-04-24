<?php

namespace App\Livewire\Admin\ManageKelas;

use App\Enums\UserRole;
use App\Models\ClassRoom;
use App\Models\User;
use Flux\Flux;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class ManageKelasAddTeacher extends Component
{
    public $teachers, $kelas, $teacherName, $teacherId;

    public function render()
    {
        return view('livewire.admin.manage-kelas.manage-kelas-add-teacher');
    }

    public function mount($id) {
        $this->kelas = ClassRoom::find($id);
        $this->teachers = User::where('role', UserRole::guru)
        ->whereHas('teacher', function ($q) {
            $q->doesntHave('classRooms');
        })->get();
    }

    public function showConfirm($id) {
        $this->teacherId = User::find($id);
        $this->teacherName = $this->teacherId->name;
        Flux::modal('add-teacher')->show();
    }

    public function assignTeacher() {
        DB::beginTransaction();
        try {
            $this->kelas->teacher_id = $this->teacherId->teacher->id;
            $this->kelas->save();

            DB::commit();
            return redirect()->route('admin.manage.kelas')
            ->success('berhasil menambahkan guru ke kelas');
        } catch (\Exception $e) {
            DB::rollBack();
            Toaster::error('Gagal menambahkan: '.$e->getMessage());
        }
    }
}
