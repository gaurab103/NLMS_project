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
        return $this->belongsTo(Course::class);  // Course relationship
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);  // Teacher relationship
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);  // Admin relationship
    }

    public function notes()
    {
        return $this->hasMany(Note::class);  // Notes relationship
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);  // Assignments relationship
    }
}
