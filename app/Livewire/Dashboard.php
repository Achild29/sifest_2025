<?php

namespace App\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public $nama, $nisn, $email, $alamat, $wali_murid, $no_telp, $password;
    public function render()
    {
        return view('livewire.dashboard');
    }

}
