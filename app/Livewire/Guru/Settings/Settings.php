<?php

namespace App\Livewire\Guru\Settings;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Masmerise\Toaster\Toaster;

class Settings extends Component
{
    use WithFileUploads;
    
    public $nama, $email, $no_telp, $alamat, $nip;
    public $photo;

    public function render()
    {
        return view('livewire.guru.settings.settings');
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

    public function changePhoto() {
        $this->validate([
            'photo' => [
                'required',
                'image',
                'max:10240'
            ]
        ],[
            'photo.required' => 'Untuk mengganti photo diperlukan photo baru, harap pilih photo',
            'photo.image' => 'File harus berupa gambar',
            'photo.max' => 'File maksimal adalah 10mb'
        ]);

        if (!is_null(Auth::user()->profil_path)) {
             $pathLama = 'storage/assets/profile_pictures/' . Auth::user()->profil_path;
             if (File::exists($pathLama)) {
                File::delete($pathLama);
             }
        }


        $nameFiles = now()->timestamp .'-'. Auth::user()->username . '.' . $this->photo->extension();
        $this->photo->storePubliclyAs('assets/profile_pictures', $nameFiles, 'public');

        $user = User::find(Auth::user()->id);
        DB::beginTransaction();
        try {
            $user->profil_path = $nameFiles;
            $user->save();
            DB::commit();
            return redirect()->route('settings')->success('Data Berhasil di ubah');
        } catch (\Exception $e) {
            DB::rollBack();
            Toaster::error('Gagal : '.$e->getMessage());
        }
    }
}
