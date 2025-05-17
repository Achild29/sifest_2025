<?php

namespace App\Livewire\Admin\ManageStudents;

use App\Enums\UserRole;
use App\Helpers\QrCodeHelper;
use App\Models\Student;
use App\Models\User;
use Flux\Flux;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class ManageStudentsModal extends Component
{
    public $nama, $nisn, $email, $alamat, $wali_murid, $no_telp;
    public $idUser;

    public function render()
    {
        return view('livewire.admin.manage-students.manage-students-modal');
    }

    public function validasi(?User $user) {
        return  $this->validate([
            "nama" => [
                'required',
                'regex:/^[a-zA-Z.,\s]+$/'
            ],
            "email" => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore(optional($user)->id),
            ],
            "alamat" => "required",
            "wali_murid" => [
                'required',
                'regex:/^[a-zA-Z.,\'\s]+$/'
            ],
            "no_telp" => [
                'required',
                'digits_between:8,11',
                'regex:/^(?!08)/'
            ],
            "nisn" =>  [
                'required',
                'digits:10',
                Rule::unique('students', 'nisn')->ignore(optional($user)->id, 'user_id'),
            ],
        ],[
            "nama.required" => "field Nama tidak boleh kosong",
            "nama.regex" => "Krakter yg dapat di input hanya titik (.) koma (,) kutip satu (') dan aplhabet",
            "alamat.required" => "field Alamat tidak boleh kosong",
            "wali_murid.required" => "field Wali Murid tidak boleh kosong",
            "wali_murid.regex" => "field Wali Murid tidak boleh terdapat angka",
            "no_telp.required" => "field no. telp tidak boleh kosong",
            "no_telp.digits_between" => "no. telp harus berupa angak, antara 9 hingga 11 (tanpa 08)",
            "no_telp.regex" => "penulisan no. telp tidak boleh diawali dengan 08 dan harus angka",
            "nisn.required" => "field NISN tidak boleh kosong",
            "nisn.digits" => "NISN harus 10 digit berupa angka",
            "email.required" => "field Email tidak boleh kosong",
            "email.email" => "alamat email tidak valid",
            "nisn.unique" => "nisn sudah pernah didaftarkan",
            "email.unique" => "alamat email sudah pernah didaftarkan"
        ]);
    }

    #[On('add-new-student')]
    public function addStudent() {
        $this->reset();
        Flux::modal('create-student')->show();
    }

    public function store() {
        $this->validasi(null);
        DB::beginTransaction();
        try {
            $userCreate = User::factory()->create([
                "name" => $this->nama,
                "username" => $this->nisn,
                "email" => $this->email,
                "password" => Hash::make('password'),
                "role" => UserRole::siswa
            ]);
            $studentCreate = Student::create([
                "user_id" => $userCreate->id,
                "nisn" => $this->nisn,
                "alamat" => $this->alamat,
                "qr_path" => QrCodeHelper::generateQrCode($this->nisn),
                "nama_wali_murid" => $this->wali_murid,
                "no_telp_wali" => "08" . $this->no_telp,
            ]);
            DB::commit();
            return redirect()->route('manage.students')->success('Berhasil menambahkan data');
        } catch (\Exception $e) {
            DB::rollBack();
            Toaster::error('Gagal Menambahkan data: ' . $e->getMessage());
        }
    }

    public function show($id) {
        $user = User::find($id);
        $this->idUser = $id;
        $this->nama = $user->name;
        $this->email = $user->email;
        $this->nisn = $user->Student->nisn; // dd($user->username === $user->Student->nisn, $user->username, $user->Student->nisn); => true
        $this->alamat = $user->Student->alamat;
        $this->wali_murid = $user->Student->nama_wali_murid;
        $this->no_telp = substr($user->Student->no_telp_wali, 2);
    }

    #[On('update-student')]
    public function showEdit($id) {
        $this->show($id);
        Flux::modal('update-student')->show();
    }

    public function update() {
        $user = User::find($this->idUser);
        $student = User::find($this->idUser)?->Student;
        
        $this->validasi($user);
        
        DB::beginTransaction();
        try {
            $user->name = $this->nama;
            $user->username = $this->nisn;
            $user->email = $this->email;

            $user->save();

            $student->nisn = $this->nisn;
            $student->alamat = $this->alamat;
            $student->nama_wali_murid = $this->wali_murid;
            $student->no_telp_wali = "08". $this->no_telp;
            $student->save();

            DB::commit();

            return redirect()->route('manage.students')->success('Data berhasil di perbaharui');
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

            return redirect()->route('manage.students')->success("password's $user->name berhasil di reset ke Default");
        } catch (\Exception $e) {
            DB::rollBack();
            Toaster::error('Gagal mereset password: '. $e->getMessage());
        }
    }

    #[On('delete-student')]
    public function showConfirm($id) {
        $this->show($id);
        Flux::modal('delete-student')->show();
    }

    public function removeStudent() {
        $student = User::find($this->idUser)?->Student;

        if (!$student) {
            Toaster::error('Siswa tidak ada');
            return;
        }

        DB::beginTransaction();
        try {
            if ($student->qr_path &&
            Storage::disk('public')
            ->exists('qr_code/'.$student->qr_path)){
                Storage::disk('public')->delete('qr_code/'.$student->qr_path);
            }
            
            $student->user->forceDelete();

            DB::commit();

            return redirect()->route('manage.students')->warning('Data berhasil di hapus');
        } catch (\Exception $e) {
            DB::rollBack();
            Toaster::error('Gagal menghapus data: '. $e->getMessage());
        }
    }

}
