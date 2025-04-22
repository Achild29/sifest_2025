<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'user_id',
        'nisn',
        'alamat',
        'nama_wali_murid',
        'kelas_id',
        "no_telp_wali",
        'qr_path'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function classRoom() {
        return $this->belongsTo(ClassRoom::class, 'kelas_id', 'id');
    }

    public function attandances() {
        return $this->hasMany(Attendance::class);
    }
}
