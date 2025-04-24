<?php

namespace App\Livewire\Guru\ManageKelas;

use App\Enums\UserRole;
use App\Models\ClassRoom;
use App\Models\User;
use Flux\Flux;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class ManageKelasAddStudents extends Component
{
    public $kelas, $murid, $nama, $nisn, $siswa;

    public function render()
    {
        return view('livewire.guru.manage-kelas.manage-kelas-add-students');
    }

    public function mount($id) {
        $this->kelas = ClassRoom::find($id);
        $this->murid = User::where('role', UserRole::siswa)
        ->whereHas('student', function ($query) {
            $query->whereNull('kelas_id');
        })
        ->with('student')
        ->get();
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
