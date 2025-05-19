<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    protected $fillable = ['name', 'teacher_id', 'description'];

    public function teacher() {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
    }

    public function students() {
        return $this->hasMany(Student::class, 'kelas_id');
    }

    public function attendance() {
        return $this->hasMany(Attendance::class, 'class_room_id');
    }

    public function moduls() {
        return $this->hasMany(Modul::class);
    }

    public function schedules() {
        return $this->hasMany(Schedule::class);
    }
}
