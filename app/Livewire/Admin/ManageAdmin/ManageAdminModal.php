<?php

namespace App\Livewire\Admin\ManageAdmin;

use App\Models\User;
use Flux\Flux;
use Livewire\Attributes\On;
use Livewire\Component;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Masmerise\Toaster\Toaster;

class ManageAdminModal extends Component
{
    public $user;
    public $nama, $email, $username, $role; 

    public function render()
    {
        $faker = Faker::create('id_ID');
        return view('livewire.admin.manage-admin.manage-admin-modal', [
            'faker' => $faker
        ]);
    }

    #[On('addUser')]
    public function showFormAddUser() {
        $this->reset();
        Flux::modal('add-user')->show();
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
            return redirect()->route('manage.admin')->success('Data berhasil di tambahkan');
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

    #[On('showReset')]
    public function showResetForm($id) {
        $this->show($id);
        Flux::modal('reset-password')->show();
    }

    public function resetPassword() {
        DB::beginTransaction();
        try {
            $this->user->password = Hash::make('password');
            $this->user->save();

            DB::commit();
            return redirect()->route('manage.admin')->success('Password: '.$this->user->name." berhasil di reset");
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }

    #[On('showRestore')]
    public function showRestoreForm($id) {
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
            return redirect()->route('manage.admin')->info('Data berhasil di restore');
        } catch (\Exception $e) {
            DB::rollBack();
        }   
    }

    #[On('showConfirmDelete')]
    public function showConfirmDelete($id) {
        $this->user = User::withTrashed()->find($id);
        // dd($this->user);
        $this->role = $this->user->role;
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
            return redirect()->route('manage.admin')->info('Data berhasil di hapus secara permanent');
        } catch (\Exception $e) {
            DB::rollBack();
            Toaster::error('Gagal menghapus data: '.$e->getMessage());
        }
    }
}
