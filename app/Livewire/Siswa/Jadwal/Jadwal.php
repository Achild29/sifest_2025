<?php

namespace App\Livewire\Siswa\Jadwal;

use App\Models\ClassRoom;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Jadwal extends Component
{
    use WithPagination, WithoutUrlPagination;

    public  $bulan = '';
    public  $kelas, $guru, $user;

    public function render()
    {
        $data = Schedule::where('kelas_id', $this->kelas->id)
            ->where('teacher_id', $this->guru->teacher->id)->
            whereAny([
                'tanggal'
            ], 'like', '%'. $this->bulan .'%')->paginate(31);;
        return view('livewire.siswa.jadwal.jadwal',[
            'schedules' => $data 
        ]);
    }

    public function mount() {
        $this->user = User::find(Auth::user()->id);
        $this->kelas = ClassRoom::find($this->user->student->classRoom->id);
        $this->guru = User::find($this->kelas->teacher->user_id);
    }

    public function searchFocus() {
        $this->resetPage();
    }
}
