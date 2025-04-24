<?php

namespace App\Livewire\Guru\ManageKelas;

use App\Models\ClassRoom;
use App\Models\Student;
use App\Models\User;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class ManageKelasModal extends Component
{
    public $nama, $kelas, $jumlahMurid, $description;
    public $siswa;

    public function render()
    {
        return view('livewire.guru.manage-kelas.manage-kelas-modal');
    }
    
    public function addKelas() {
        $this->validate([
            'nama' => 'required|max:50',
            'description' => 'required|max:255'
        ],[
            'nama.required' => 'Field Tidak Boleh Kosong',
            'nama.max' => 'Nama kelas tidak boleh lebih dari 50 karakter',
            'description.required' => 'Field Tidak Boleh Kosong',
            'description.max' => 'Deskripsi Kelas tidak boleh lebih dari 255 Karakter'
        ]);

        DB::beginTransaction();
        try {
            ClassRoom::create([
                'teacher_id' => $this->getGuruId(),
                'name' => $this->nama,
                'description' => $this->description
            ]);

            DB::commit();
            Flux::modal('add-kelas')->close();
            $this->reset();
            $this->dispatch('kelas-created');
            Toaster::success('Kelas berhasil dibuat');
        } catch (\Exception $e) {
            DB::rollBack();
            Toaster::error('Gagal membuat kelas baru: '.$e->getMessage());
        }
    }

    #[On('delete-kelas')]
    public function showConfirm($id) {
        $this->kelas = ClassRoom::find($id);
        $this->jumlahMurid = Student::where('kelas_id', $id)->count();
        $this->nama = $this->kelas->name;
        Flux::modal('delete-kelas')->show();
    }

    public function deleteKelas() {
        DB::beginTransaction();
        try {
            $this->kelas->delete();
            DB::commit();

            Flux::modal('delete-kelas')->close();
            $this->reset();
            $this->dispatch('kelas-updated');
            Toaster::warning('Kelas berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            Toaster::error('Gagal menghapus Kelas: '.$e->getMessage());
        }
    }

    protected function getGuruId() {
        return User::find(Auth::user()->id)?->teacher->id;
    }
}
