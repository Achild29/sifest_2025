<?php

namespace App\Livewire\Admin\ManageTeacher;

use App\Enums\UserRole;
use App\Models\Teacher;
use App\Models\User;
use Flux\Flux;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class ManageTeacherModal extends Component
{
    public $nama, $nip, $email, $alamat, $no_telp;
    public $idUser;

    public function render()
    {
        return view('livewire.admin.manage-teacher.manage-teacher-modal');
    }

    public function validasi(?User $user) {
        return $this->validate([
            'nama' => [
                'required',
                'regex:/^[a-zA-Z.,\s]+$/',
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore(optional($user)->id),
            ],
            'alamat' => 'required',
            'no_telp' => [
                'required',
                'digits_between:8,11',
                'regex:/^(?!08)/'
            ],
            'nip' => [
                'required',
                'digits:18',
                Rule::unique('teachers', 'nip')->ignore(optional($user)->id, 'user_id'),
            ]
        ],[
            'nama.required' => 'field Nama tidak boleh kosong',
            'nama.regex' => "Krakter yg dapat di input hanya titik (.) koma (,) kutip satu (') dan aplhabet",
            'email.required' => 'field Email tidak boleh kosong',
            'email.unique' => 'alamat email sudah pernah didaftarkan',
            'email.email' => 'alamat email tidak valid',
            'no_telp.required' => 'field no. telp tidak boleh kosong',
            'no_telp.digits_between' => "no. telp harus berupa angak, antara 9 hingga 11 (tanpa 08)",
            'no_telp.regex' => 'penulisan no. telp tidak boleh diawali dengan 08 dan harus angka',
            'nip.required' => 'field NIP tidak boleh kosong',
            'nip.digits' => 'NIP harus 18 digit dan berupa angka',
            'nip.unique' => 'NIP sudah pernah didaftarkan'
        ]);
    }

    public function store() {
        $this->validasi(null);
        DB::beginTransaction();
        try {
            $userCreate = User::factory()->create([
                'name' => $this->nama,
                'username' => $this->nip,
                'email' => $this->email,
                'password' => Hash::make('password'),
                'role' => UserRole::guru
            ]);
            $teacherCreate = Teacher::create([
                'user_id' => $userCreate->id,
                'nip' => $this->nip,
                'no_telp' => "08".$this->no_telp,
                'alamat' => $this->alamat
            ]);
            
            DB::commit();
            return redirect()->route('manage.teachers')->success('Berhasil menambahakn data');
        } catch (\Exception $e) {
            DB::rollBack();
            Toaster::error('Gagal menambahakan data: '. $e->getMessage());
        }
    }

    public function show($id) {
        $user = User::find($id);
        $this->idUser = $id;
        $this->nama = $user->name;
        $this->nip = $user->teacher->nip;
        $this->email = $user->email;
        $this->alamat = $user->teacher->alamat;
        $this->no_telp = substr($user->teacher->no_telp, 2);
    }

    #[On('update-teacher')]
    public function showEdit($id) {
        $this->show($id);
        Flux::modal('update-teacher')->show();
    }

    public function update() {
        $user = User::find($this->idUser);
        $teacher = User::find($this->idUser)?->teacher;

        $this->validasi($user);

        DB::beginTransaction();
        try {
            $user->name = $this->nama;
            $user->username = $this->nip;
            $user->email = $this->email;
            $user->save();

            $teacher->nip = $this->nip;
            $teacher->no_telp = "08".$this->no_telp;
            $teacher->alamat = $this->alamat;
            $teacher->save();

            DB::commit();

            return redirect()->route('manage.teachers')->success('Data berhasil di perbaharui');
        } catch (\Exception $e) {
            DB::rollBack();
            Toaster::error('Gagal memperbaharui data: '. $e->getMessage());
        }
    }

    public function resetPassword() {
        $user = User::find($this->idUser);

        DB::beginTransaction();
        try {
            $user->password = Hash::make('password');
            $user->save();
            
            DB::commit();

            return redirect()->route('manage.teachers')->success("Password's $user->name berhasil direset ke default");
        } catch (\Exception $e) {
            DB::rollBack();
            Toaster::error('Gagal me-reset password: '.$e->getMessage());
        }
    }

    #[On('delete-teacher')]
    public function showConfirm($id) {
        $this->show($id);
        Flux::modal('delete-teacher')->show();
    }

    public function removeTeacher() {
        $teacher = User::find($this->idUser)?->teacher;
        
        DB::beginTransaction();
        try {
            $teacher->user->forceDelete();

            DB::commit();
            return redirect()->route('manage.teachers')->warning('Data berhasil di hapus');
            $this->reset();
            $this->dispatch('teacher-updated');
        } catch (\Exception $e) {
            DB::rollBack();
            Toaster::error('Gagal menghapus data: '. $e->getMessage());
        }
    }

    #[On('addNewTeacherModal')]
    public function addTeacher() {
        $this->reset();
        Flux::modal('create-teacher')->show();
    }
    
}
