<?php

namespace App\Livewire\Siswa\Settings;

use App\Models\User;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class SettingsModal extends Component
{
    public $email, $old_password, $password_new, $password_conf;
    protected $user;

    public function render()
    {
        return view('livewire.siswa.settings.settings-modal');
    }

    #[On('siswa-updated')]
    public function mount() {
        $this->user = $this->getUser();
        $this->email = $this->user->email;
    }

    protected function getUser() {
       return $this->user = User::find(Auth::user()->id);
    }

    public function updateEmail() {
        $this->user = $this->getUser();
        $this->validate([
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore(optional($this->user)->id)
            ]
        ],[
            'email.required' => 'field Tidak boleh kosong',
            'email.email' => 'alamat email tidak valid',
            'email.unique' => 'alamat email sudah pernah didaftarkan, silahkan pilih alamat email yg lain'
        ]);

        DB::beginTransaction();
        try {
            $this->user->email = $this->email;
            $this->user->save();

            DB::commit();
            Flux::modal('edit-email')->close();
            $this->reset();
            $this->dispatch('siswa-updated');
            Toaster::success('Alamat Email berhasil di ubah');
        } catch (\Exception $e) {
            DB::rollBack();
            Toaster::error('Gagal merubah data: '.$e->getMessage());
        }
    }

    public function updatePassword() {
        $this->user = $this->getUser();
        $this->validate([
            'old_password' => 'required',
            'password_new' => [
                'required',
                'min:8',
                'same:password_conf'
            ],
            'password_conf' => 'required|min:8'
        ],[
            'old_password.required' => 'field Tidak boleh kosong',
            'password_new.required' => 'field Tidak boleh kosong',
            'password_conf.required' => 'field Tidak boleh kosong',
            'password_new.min' => 'password minimal 8 karakter',
            'password_new.same' => 'password baru dan password konfirmasi harus sama',
            'password_conf.min' => 'password minimal 8 karakter dan password konfirmasi harus sama dengan password baru'
        ]);

        if (!Hash::check($this->old_password, $this->user->password)) {
            $this->addError('old_password', 'Password lama salah');
            return;
        }

        DB::beginTransaction();
        try {
            $this->user->password = Hash::make($this->password_new);
            $this->user->save();

            DB::commit();
            Flux::modal('edit-password')->close();
            $this->reset();
            $this->dispatch('siswa-updated');
            Toaster::success('Password berhasil di ubah');
        } catch (\Exception $e) {
            DB::rollBack();
            Toaster::error('Gagal: '.$e->getMessage());
        }
    }
}
