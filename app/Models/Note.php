<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $table = 'notes';

    protected $fillable = [
        'student_id',
        'content',
        'created_at',
        'updated_at',
    ];
}
