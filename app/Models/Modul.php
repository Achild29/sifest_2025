<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{
    protected $fillable = [
        'teacher_id',
        'class_room_id',
        'modul_path',
        'name',
        'extension'
    ];
    
    public function teacher() {
        return $this->belongsTo(Teacher::class);
    }

    public function classRoom() {
        return $this->belongsTo(ClassRoom::class);
    }
}
