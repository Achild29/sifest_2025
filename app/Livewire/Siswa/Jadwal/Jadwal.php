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
    public  $kelasId, $guruId, $user, $kelas, $guru;


    public function render()
    {
        $data = Schedule::where('kelas_id', $this->kelasId)
            ->where('teacher_id', $this->guruId)->
            whereAny([
                'tanggal'
            ], 'like', '%'. $this->bulan .'%')->paginate(31);;
        return view('livewire.siswa.jadwal.jadwal',[
            'schedules' => $data 
        ]);
    }

    public function mount() {
        $this->user = User::find(Auth::user()->id);
        $this->kelasId = $this->user->student->classRoom?->id ?? '';
        $this->kelas = ClassRoom::find($this->kelasId);
        $this->guru = $this->kelas?->teacher?->user?->name;
        $this->guruId = $this->user->student->classRoom?->teacher->id ?? '';
    }

    public function searchFocus() {
        $this->resetPage();
    }
}
