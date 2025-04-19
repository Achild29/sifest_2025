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

    public function store() {
        dd($this->nama, $this->nisn, $this->alamat, $this->wali_murid, $this->no_telp, $this->password);
    }
}
