<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $table = 'assignments';

    protected $fillable = [
        'student_id',
        'title',
        'description',
        'due_date',
        'created_at',
        'updated_at',
    ];
}
