<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';

    protected $fillable = [
        'student_id',
        'content',
        'sender',
        'created_at',
        'updated_at',
    ];
}
