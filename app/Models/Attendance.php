<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Attendance extends Model
{
    protected $table = 'attendance';
    protected $fillable = ['student_id', 'course_id', 'date', 'status'];

    // Proper date casting for Carbon
    protected $casts = [
        'date' => 'date:Y-m-d' // Cast to Carbon instance
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
