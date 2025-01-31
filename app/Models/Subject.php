<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subjects';

    protected $fillable = [
        'student_id',
        'name',
        'code',
        'created_at',
        'updated_at',
    ];
}
