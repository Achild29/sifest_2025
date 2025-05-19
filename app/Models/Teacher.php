<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable=[
        'user_id',
        'nip',
        'no_telp',
        'alamat'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function classRooms() {
        return $this->hasMany(ClassRoom::class, 'teacher_id');
    }

    public function scannedMasukAttendaces() {
        return $this->hasMany(Attendance::class, 'scanned_masuk_by');
    }

    public function scannedPulangAttendaces() {
        return $this->hasMany(Attendance::class, 'scanned_pulang_by');
    }

    public function moduls() {
        return $this->hasMany(Modul::class);
    }

    public function chatInteractions() {
        return $this->hasMany(ChatInteraction::class);
    }

    public function schedules() {
        return $this->hasMany(Schedule::class);
    }
}
