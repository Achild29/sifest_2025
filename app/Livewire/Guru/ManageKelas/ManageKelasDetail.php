<?php

namespace App\Livewire\Guru\ManageKelas;

use App\Enums\UserRole;
use App\Models\ClassRoom;
use App\Models\User;
use Flux\Flux;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class ManageKelasDetail extends Component
{
    public $kelas, $murid, $nama, $description;
    public $siswa, $namaSiswa;

    public function render()
    {
        return view('livewire.guru.manage-kelas.manage-kelas-detail');
    }

    public function mount($id) {
        $this->kelas = ClassRoom::find($id);
        $this->murid = User::where('role', UserRole::siswa)
        ->whereHas('student', function ($query) {
            $query->where('kelas_id', $this->kelas->id); 
        })->with('student')->get();
        $this->nama = $this->kelas->name;
        $this->description = $this->kelas->description;
    }

    public function updateNama() {
        $this->validate([
            'nama' => 'required|max:50',
        ],[
            'nama.required' => 'Field Tidak Boleh Kosong',
            'nama.max' => 'Nama kelas tidak boleh lebih dari 50 karakter',
        ]);

        DB::beginTransaction();
        try {
            $this->kelas->name = $this->nama;
            $this->kelas->save();

            DB::commit();
            return redirect()->route('detail.kelas', $this->kelas->id)->success('Data berhasil di update');
        } catch (\Exception $e) {
            DB::rollBack();
            Toaster::error('Gagal mengubah data: '.$e->getMessage());
        }
    }

    public function updateDeskripsi() {
        $this->validate([
            'description' => 'required|max:255'
        ],[
            'description.required' => 'Field Tidak Boleh Kosong',
            'description.max' => 'Deskripsi Kelas tidak boleh lebih dari 255 Karakter'
        ]);

        DB::beginTransaction();
        try {
            $this->kelas->description = $this->description;
            $this->kelas->save();

            DB::commit();
            return redirect()->route('detail.kelas', $this->kelas->id)->success('Data berhasil di update');
        } catch (\Exception $e) {
            DB::rollBack();
            Toaster::error('Gagal mengubah data: '.$e->getMessage());
        }
    }

    public function showConfirm($id) {
        $this->siswa = User::find($id);
        $this->namaSiswa = $this->siswa->name;
        Flux::modal('remove-student')->show();
    }

    public function removeStudent() {
        DB::beginTransaction();
        try {
            $this->siswa->student->kelas_id = null;
            $this->siswa->student->save();

            DB::commit();
            return redirect()->route('detail.kelas', $this->kelas->id)
            ->warning('Siswa berhasil dikeluarkan dari kelas');
        } catch (\Exception $e) {
            DB::rollBack();
            Toaster::error('Gagal Menghapus: '.$e->getMessage());
        }
    }

    public function addStudents() {
        return redirect()->route('add.students.kelas', $this->kelas->id);
    }
}
