<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatInteraction extends Model
{
    protected $fillable = ['question', 'answer', 'teacher_id'];

    public function teacher() {
        return $this->belongsTo(Teacher::class);
    }
}
