<?php

namespace App\Livewire\Admin;

use App\Enums\UserRole;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class ModalStudent extends Component
{
    public $nama, $nisn, $email, $alamat, $wali_murid, $no_telp;
    public function render()
    {
        return view('livewire.admin.modal-student');
    }

    public function store() {
        // dd($this->nama, $this->nisn, $this->alamat, $this->wali_murid, $this->no_telp, $this->password);
        $this->validate([
            "nama" => [
                'required',
                'regex:/^[a-zA-Z.,\s]+$/'
            ],
            "email" => "required|email|unique:users,email",
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
            "nisn" => "required|digits:10|unique:students,nisn"
        ],[
            "nama.required" => "field Nama tidak boleh kosong",
            "nama.regex" => "Krakter yg dapat di input hanya titik (.) koma (,) kutip satu (') dan aplhabet",
            "alamat.required" => "field Alamat tidak boleh kosong",
            "wali_murid.required" => "field Wali Murid tidak boleh kosong",
            "wali_murid.regex" => "field Wali Murid tidak boleh terdapat angka",
            "no_telp.required" => "field no. telp tidak boleh kosong",
            "no_telp.digits_between" => "no. telp harus berupa angak, antara 9 hingga 11 +  2 digit -> 08",
            "no_telp.regex" => "penulisan no. telp tidak boleh diawali dengan 08",
            "nisn.required" => "field NISN tidak boleh kosong",
            "nisn.digits" => "NISN harus 10 digit berupa angka",
            "email.required" => "field Email tidak boleh kosong",
            "email.email" => "alamat email tidak valid",
            "nisn.unique" => "nisn sudah pernah didaftarkan",
            "email.unique" => "alamat email sudah pernah didaftarkan"
        ]);

        try {
            DB::beginTransaction();
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
                "nama_wali_murid" => $this->wali_murid,
                "no_telp_wali" => "08" . $this->no_telp,
            ]);
            DB::commit();
            Toaster::success('Berhasil menambahkan data');
            $this->reset();
            $this->dispatch('student-created');
        } catch (\Exception $e) {
            DB::rollBack();
            Toaster::error('Gagal Menambahkan data: ' . $e->getMessage());
        }
    }
}
