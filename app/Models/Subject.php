<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'course_id', 'teacher_id', 'admin_id'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }
}
