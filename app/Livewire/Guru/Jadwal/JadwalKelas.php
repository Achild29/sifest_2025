<?php

namespace App\Livewire\Guru\Jadwal;

use App\Models\ClassRoom;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class JadwalKelas extends Component
{

    use WithPagination, WithoutUrlPagination;

    public $kelas, $user;
    public $bulan = '';
    public $data;

    public function render()
    {
        $data = Schedule::where('kelas_id', $this->kelas->id)
            ->where('teacher_id', $this->user->id)->
            whereAny([
                'tanggal'
            ], 'like', '%'. $this->bulan .'%')->paginate(31);
        return view('livewire.guru.jadwal.jadwal-kelas', [
            'schedules' => $data,
        ]);
    }

    public function mount($id) {
        $this->user = User::find(Auth::user()->id)->teacher;
        $this->kelas = ClassRoom::find($id);
    }
}
