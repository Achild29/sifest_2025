<?php

namespace App\Livewire\Guru\ManageKelas;

use App\Enums\UserRole;
use App\Models\ClassRoom;
use App\Models\User;
use Flux\Flux;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

class ManageKelasAddStudents extends Component
{
    use WithPagination, WithoutUrlPagination;
    
    public $kelas, $nama, $nisn, $siswa;
    public $users;
    public $search = '';

    public function render()
    {
        $data = User::where('role', UserRole::siswa)
            ->whereHas('student', function (Builder $query) {
                $query->whereNull('kelas_id');
            })->whereAny([
                'name',
                'username'
            ],'like', '%'.$this->search.'%')
            ->paginate(6);
        return view('livewire.guru.manage-kelas.manage-kelas-add-students', [
            'murid' => $data
        ]);
    }

    public function searchFocus() {
        $this->resetPage();
    }

    public function mount($id) {
        $this->kelas = ClassRoom::find($id);
        $this->users = User::where('role', UserRole::siswa)
            ->whereHas('student', function (Builder $query) {
                $query->whereNull('kelas_id');
            })->get();
    }

    public function showConfirm($id) {
        $this->siswa = User::find($id);
        $this->nama = $this->siswa->name;
        $this->nisn = $this->siswa->student->nisn;
        Flux::modal('add-students')->show();
    }

    public function addStudent() {
        DB::beginTransaction();
        try {
            $this->siswa->student->kelas_id = $this->kelas->id;
            $this->siswa->student->save();

            DB::commit();
            Flux::modal('add-student')->close();
            return redirect()->route('add.students.kelas', $this->kelas->id)
            ->success('Siswa: '.$this->siswa->name.' berhasil ditambakan ke kelas '.$this->kelas->name);
        } catch (\Exception $e) {
            DB::rollBack();
            Toaster::error('Eror menambahkan:'.$e->getMessage());
        }
    }
}
