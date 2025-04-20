<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Settings extends Component
{
    public $nama, $username, $email;
    public function render()
    {
        return view('livewire.admin.settings');
    }

    #[On('user-updated')]
    public function mount() {
        $user = User::find(Auth::user()->id);
        $this->nama = $user->name;
        $this->username = $user->username;
        $this->email = $user->email;
    }
}
