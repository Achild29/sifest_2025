<?php

namespace App\Livewire\Guru;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Settings extends Component
{
    public $nama, $email, $no_telp, $alamat, $nip;

    public function render()
    {
        return view('livewire.guru.settings');
    }

    #[On('guru-updated')]
    public function mount() {
        $user = User::find(Auth::user()->id);
        $this->nama = $user->name;
        $this->email = $user->email;
        $this->no_telp = $user->teacher->no_telp;
        $this->alamat = $user->teacher->alamat;
        $this->nip = $user->teacher->nip;
    }
}
