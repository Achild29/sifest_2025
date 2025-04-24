<?php

namespace App\Livewire\Admin\Settings;

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
    public $nama, $username, $email, $old_password, $password_new, $password_conf;
    protected $user;

    public function render()
    {
        return view('livewire.admin.settings.settings-modal');
    }

    #[On('user-updated')]
    public function mount() {
        $this->user = $this->getUser();
        $this->nama = $this->user->name;
        $this->username = $this->user->username;
        $this->email = $this->user->email;
    }

    public function updateUsername() {
        $this->user = $this->getUser();
        $this->validate([
            'username' => [
                'required',
                'string',
                'regex:/^\S*$/u',
                Rule::unique('users', 'username')->ignore(optional($this->user)->id)
            ],
        ],[
            'username.required' => 'field Tidak boleh kosong',
            'username.unique' => 'username sudah ada, silahkan pilih username lain',
            'username.regex' => 'username tidak boleh mengandung karakter spasi'
        ]);

        DB::beginTransaction();
        try {
            $this->user->username = $this->username;
            $this->user->save();

            DB::commit();
            Toaster::success('Data berhasil di perbaharui');
            Flux::modal('edit-username')->close();
            $this->reset();
            $this->dispatch('user-updated');
        } catch (\Exception $e) {
            DB::rollBack();
            Toaster::error('Gagal edit: '.$e->getMessage());
        }
    }
    
    public function updateNama() {
        $this->user = $this->getUser();
        $this->validate([
            'nama' => [
                'required',
                'regex:/^[a-zA-Z.,\s]+$/'
            ]
        ],[
            'nama.required' => 'field wajib di isi',
            'nama.regex' => "Krakter yg dapat di input hanya titik (.) koma (,) kutip satu (') dan aplhabet"
        ]);
        DB::beginTransaction();
        try {
            $this->user->name = $this->nama;
            $this->user->save();

            DB::commit();
            Flux::modal('edit-nama')->close();
            Toaster::success('Data berhasil di perbaharui');
            $this->reset();
            $this->dispatch('user-updated');
        } catch (\Exception $e) {
            DB::rollBack();
            Toaster::error('Gagal memperbaharui data: '.$e->getMessage());
        }
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
            'email.unique' => 'alamat email sudah pernah terdaftar'
        ]);

        DB::beginTransaction();
        try {
            $this->user->email = $this->email;
            $this->user->save();

            DB::commit();
            Flux::modal('edit-email')->close();
            Toaster::success('Data berhasil di perbaharui');
            $this->reset();
            $this->dispatch('user-updated');
        } catch (\Exception $e) {
            DB::rollBack();
            Toaster::error('Gagal memperbaharui data: '.$e->getMessage());
        }
    }

    public function resetPassword() {
        $this->user = $this->getUser();
        DB::beginTransaction();
        try {
            $this->user->password = Hash::make('password');
            $this->user->save();

            DB::commit();
            Flux::modal('edit-reset')->close();
            $this->reset();
            return redirect(route('logout'));
        } catch (\Exception $e) {
            DB::rollBack();
            Toaster::error('Gagal me-reset password: '.$e->getMessage());
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
            $this->user->password = $this->password_new;
            $this->user->save();

            DB::commit();
            Flux::modal('edit-password')->close();
            Toaster::info('Password berhasil di update');
            $this->reset();
            $this->dispatch('user-updated');
        } catch (\Exception $e) {
            DB::rollBack();
            Toaster::error('Gagal merubah password: '.$e->getMessage());
        }
        
    }

    public function deleteAccount() {
        $this->user = $this->getUser();

        DB::beginTransaction();
        try {
            Auth::logout();
            $this->user->delete();
            
            session()->invalidate();
            session()->regenerateToken();

            DB::commit();
            return redirect()->route('login')->info('Akun berhasil di hapus');
            $this->reset();
        } catch (\Exception $e) {
            DB::rollBack();
            Toaster::error('Gagal menghapus Akun: '.$e->getMessage());
        }
    }

    protected function getUser() {
        return $this->user = User::find(Auth::user()->id);
    }
}
