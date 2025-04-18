<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'student_id',
        'class_room_id',
        'tanggal',
        'jam_masuk',
        'jam_pulang',
        'status',
        'message',
        'scanned_masuk_by',
        'scanned_pulang_by'
    ];

    public function student() {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function clasRoom() {
        return $this->belongsTo(ClassRoom::class, 'class_room_id', 'id');
    }

    public function scannedMasukBy() {
        return $this->belongsTo(Teacher::class, 'scanned_masuk_by', 'id');
    }

    public function scannedPulangBy() {
        return $this->belongsTo(Teacher::class, 'scanned_pulang_by', 'id');
    }
}
