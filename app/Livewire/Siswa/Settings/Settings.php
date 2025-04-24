<?php

namespace App\Livewire\Siswa\Settings;

use App\Models\ClassRoom;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Settings extends Component
{
    public $nama, $email, $alamat, $nisn, $kelas, $wali, $no_telp_wali, $qr_code, $wali_kelas;

    public function render()
    {
        return view('livewire.siswa.settings.settings');
    }

    #[On('siswa-updated')]
    public function mount() {
        $user = User::find(Auth::user()->id);
        $this->nama = $user->name;
        $this->email = $user->email;
        $this->no_telp_wali = $user->student->no_telp_wali;
        $this->nisn = $user->student->nisn;
        $this->alamat = $user->student->alamat;
        $this->kelas = $user->student->classRoom->name;
        $this->wali = $user->student->nama_wali_murid;
        $this->qr_code = $user->student->qr_path;
        $idKelas = $user->student->classRoom->id;
        $this->wali_kelas = ClassRoom::find($idKelas);
    }
}
