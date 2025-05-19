<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'kelas_id',
        'teacher_id',
        'tanggal',
        'tanggal',
        'link'
    ];

    public function teacher() {
        return $this->belongsTo(Teacher::class);
    }

    public function classRoom() {
        return $this->belongsTo(ClassRoom::class);
    }
}
