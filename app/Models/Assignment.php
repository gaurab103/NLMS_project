<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'file_path', 'due_date', 'max_marks',
        'subject_id', 'course_id', 'teacher_id'
    ];

    protected $casts = ['due_date' => 'datetime'];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function submissions()
    {
        return $this->hasMany(AssignmentSubmission::class);
    }
}
