<?php

namespace App\Livewire\Guru\Jadwal;

use App\Models\ClassRoom;
use App\Models\Schedule;
use App\Models\User;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

class Jadwal extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $search = '';
    public $guru;
    public $kelas, $name, $link, $tanggal, $kegiatan;
    

    public function render()
    {
        $data = ClassRoom::with('students')
            ->where('teacher_id', User::find(Auth::user()->id)->teacher->id)
            ->whereAny([
                'name'
            ], 'like', '%'.$this->search.'%')
            ->paginate(5);
        return view('livewire.guru.jadwal.jadwal', [
            'classRooms' => $data
        ]);
    }

    public function mount() {
        $this->guru = $this->getTeacher();
    }

    public function searchFocus() {
        $this->resetPage();
    }

    public function gotoManageKelas() {
        return redirect(route('manage.kelas'));
    }

    public function addJadwal($id) {
        $this->kelas = ClassRoom::find($id);
        $this->name = $this->kelas->name;
        Flux::modal('addJadwal')->show();
    }

    public function storeJadwal() {
        $this->validate([
            'tanggal' => 'required',
            'kegiatan' => 'required',
            'link' => "required_if:kegiatan,online"
        ]);
        if (is_null($this->link)) {
            $this->link = '-';
        }
        
        DB::beginTransaction();
        try {
            Schedule::create([
                'kelas_id' => $this->kelas->id,
                'teacher_id' => $this->guru->id,
                'tanggal' => $this->tanggal,
                'kegiatan' => $this->kegiatan,
                'link' => $this->link
            ]);
            DB::commit();
            return redirect()->route('guru.jadwal')->success('Berhasil menambahkan jadwal');
        } catch (\Exception $e) {
            DB::rollBack();
            Toaster::error('Gagal: '.$e->getMessage());
        }
    }

    public function detailJadwal($id) {
        return redirect()->route('guru.jadwal.kelas', $id);
    }

    protected function getTeacher() {
        return User::find(Auth::user()->id)->teacher;
    }
}
