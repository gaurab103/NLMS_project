<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendances';

    protected $fillable = [
        'student_id',  // Match actual DB column
        'course_id',   // Match actual DB column
        'date',        // Add if exists in DB
        'status'
    ];
    // app/Models/Attendance.php
    protected $casts = [
        'date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
    // Optionally, you can specify which attributes should be hidden in arrays (e.g., for API responses)
    protected $hidden = [
        // 'some_column',  // Add columns to hide from JSON output
    ];

    // Define the relationship with the Student model
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    // Define the relationship with the Course model
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
