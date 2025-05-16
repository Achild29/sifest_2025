<?php

namespace App\Livewire\Siswa\Materi;

use App\Models\Modul;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Materi extends Component
{
    use WithPagination;

    public $search = '';
    public $user;
    public $modul;

    public function render()
    {
        $data = Modul::where('class_room_id', $this->getKelasId())
            ->where('name', 'like', '%'.$this->search.'%')
            ->paginate(3);
        return view('livewire.siswa.materi.materi', [
            'moduls' => $data
        ]);
    }

    public function mount() {
        $this->user = User::find(Auth::user()->id);
        $this->modul = Modul::where('class_room_id', $this->getKelasId())->count();
    }

    private function getKelasId() {
        return Auth::user()->student->kelas_id;
    }
}
