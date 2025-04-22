<?php

namespace App\Livewire\Guru;

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
    public $email, $no_telp, $alamat;
    public $old_password, $password_new, $password_conf;
    protected $user;

    public function render()
    {
        return view('livewire.guru.settings-modal');
    }

    #[On('guru-updated')]
    public function mount() {
        $this->user = $this->getUser();
        $this->email = $this->user->email;
        $this->no_telp = substr($this->user->teacher->no_telp, 2);
        $this->alamat = $this->user->teacher->alamat; 
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
            'email.unique' => 'alamat email sudah pernah didaftarkan'
        ]);

        DB::beginTransaction();
        try {
            $this->user->email = $this->email;
            $this->user->save();

            DB::commit();
            Flux::modal('edit-email')->close();
            $this->reset();
            Toaster::success('Data berhasil diubah');
            $this->dispatch('guru-updated');
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }

    public function updateHp() {
        $this->user = $this->getUser();
        $this->validate([
            'no_telp' => [
                'required',
                'digits_between:8,11',
                'regex:/^(?!08)/'
            ]
        ],[
            'no_telp.required' => 'field Tidak boleh kosong',
            'no_telp.digits_between' => "no. telp harus berupa angak, antara 9 hingga 11 (tanpa 08)",
            'no_telp.regex' => 'penulisan no. telp tidak boleh diawali dengan 08 dan harus angka',
        ]);

        DB::beginTransaction();
        try {
            $this->user->teacher->no_telp = "08".$this->no_telp;
            $this->user->teacher->save();

            DB::commit();
            Flux::modal('edit-telp')->close();
            $this->reset();
            Toaster::success('Data berhasil di update');
            $this->dispatch('guru-updated');
        } catch (\Exception $e) {
            DB::rollBack();
            Toaster::error('gagal memperbaharui data: '.$e->getMessage());
        }
    }

    public function updateAlamat() {
        $this->user = $this->getUser();
        $this->validate([
            'alamat' => 'required'
        ],[
            'alamat.required' => 'field tidak boleh kosong'
        ]);

        DB::beginTransaction();
        try {
            $this->user->teacher->alamat = $this->alamat;
            $this->user->teacher->save();

            DB::commit();
            Flux::modal('edit-alamat')->close();
            $this->reset();
            $this->dispatch('guru-updated');
            Toaster::success('Data berhasil diupdate');
        } catch (\Exception $e) {
            DB::rollBack();
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
            $this->addError('oled_password', 'Password Lama salah');
            return;
        }

        DB::beginTransaction();
        try {
            $this->user->password = Hash::make($this->password_new);
            $this->user->save();

            DB::commit();
            Flux::modal('edit-password')->close();
            $this->reset();
            $this->dispatch('guru-updated');
            Toaster::success('Password berhasil diubah');
        } catch (\Exception $e) {
            DB::rollBack();
            Toaster::error('Gagal merubah data: '.$e->getMessage());
        }
    }
}
