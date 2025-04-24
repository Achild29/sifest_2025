<?php

namespace App\Livewire\Admin\ManageAdmin;

use App\Enums\UserRole;
use App\Models\User;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\On;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class ManageAdmin extends Component
{
    public $admin, $user, $adminDeleted;
    public $nama, $email, $username;    

    #[On(['admin-updated', 'admin-created'])]
    public function mount() {
        $this->admin = User::where('role', UserRole::admin)
        ->where('id', '!=', Auth::id())
        ->get();
        $this->adminDeleted = User::onlyTrashed()
        ->where('role', UserRole::admin)
        ->where('id', '!=', Auth::id())
        ->get();
    }

    public function render()
    {
        return view('livewire.admin.manage-admin.manage-admin');
    }

    public function addUser() {
        $this->validate([
            'nama' => [
                'required',
                'regex:/^[a-zA-Z.,\s]+$/'
                ],
            'username' => [
                'required',
                'string',
                'regex:/^\S*$/u',
                'unique:users,username',
                'min:5'
                ],
            'email' => [
                'required',
                'email',
                'unique:users,email'
            ]
        ],[
            'nama.required' => 'Field Nama tidak boleh kosong',
            'nama.regex' => "Krakter yg dapat di input hanya titik (.) koma (,) kutip satu (') dan aplhabet",
            'username.required' => 'Field Username tidak boleh kosong',
            'username.string' => 'Username harus berupa string',
            'username.regex' => 'username tidak boleh mengandung karakter spasi',
            'username.unique' => 'username sudah pernah terdaftar',
            'username.min' => 'username minimal 5 karakter',
            'email.required' => 'Field Email tidak boleh kosong',
            'email.email' => 'alamat email tidak valid',
            'email.unique' => 'alamat email sudah pernah terdaftar'
        ]);

        DB::beginTransaction();
        try {
            User::factory()->create([
                'name' => $this->nama,
                'username' => $this->username,
                'email' => $this->email,
                'password' => Hash::make('password')

            ]);

            DB::commit();
            Flux::modal('add-user')->close();
            $this->reset(['nama', 'email', 'username']);
            Toaster::success('Data berhasil di tambahkan');
            $this->dispatch('admin-created');
        } catch (\Exception $e) {
            DB::rollBack();
            Toaster::error('Gagal menambahkan data: '.$e->getMessage());
        }
    }

    public function show($id) {
        $this->user = User::find($id);
        $this->nama = $this->user->name;
        $this->email = $this->user->email;
        $this->username = $this->user->username;
    }

    public function showReset($id) {
        $this->show($id);
        Flux::modal('reset-password')->show();
    }
   
    public function resetPassword() {
        DB::beginTransaction();
        try {
            $this->user->password = Hash::make('password');
            $this->user->save();

            DB::commit();
            Flux::modal('reset-password')->close();
            Toaster::success('Password: '.$this->user->name." berhasil di reset");
            $this->resetExcept('user', 'admin');
            $this->dispatch('admin-updated');
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }
    
    public function showConfirm($id) {
        $this->show($id);
        Flux::modal('delete-user')->show();
    }

    public function removeUser() {
        DB::beginTransaction();
        try {
            $this->user->delete();

            DB::commit();
            Flux::modal('delete-user')->close();
            Toaster::warning('Data berhasil dihapus');
            $this->dispatch('admin-updated');
        } catch (\Exception $e) {
            DB::rollBack();
            Toaster::error('Gagal Menghapus data: '.$e->getMessage());
        }
    }

    public function showRestore($id) {
        $this->user = User::withTrashed()->find($id);
        $this->nama = $this->user->name;
        Flux::modal('restore-user')->show();
    }

    public function restoreUser() {
        DB::beginTransaction();
        try {
            $this->user->restore();

            DB::commit();
            Flux::modal('restore-usert')->close();
            return redirect()->route('list.users')->info('Data berhasil di restore');
        } catch (\Exception $e) {
            DB::rollBack();
        }   
    }

    public function showConfirmDelete($id) {
        $this->user = User::withTrashed()->find($id);
        $this->nama = $this->user->name;
        $this->username = $this->user->username;
        $this->email = $this->user->email;
        Flux::modal('remove-user')->show();
    }

    public function deleteUser() {
        DB::beginTransaction();
        try {
            $this->user->forceDelete();

            DB::commit();
            Flux::modal('remove-user')->close();
            return redirect()->route('list.users')->info('Data berhasil di hapus secara permanent');
        } catch (\Exception $e) {
            DB::rollBack();
            Toaster::error('Gagal menghapus data: '.$e->getMessage());
        }
    }
}
