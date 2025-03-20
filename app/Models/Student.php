<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class Student extends Authenticatable
{
    use Notifiable;

    protected $table = 'students';

    protected $fillable = [
        'name', 'dob', 'Address', 'Parent_Name', 'Contact_No', 'Email', 'Stats', 'Username', 'Password', 'photo', 'C_ID'
    ];

    protected $hidden = ['Password'];
    protected $dates = ['dob'];
    protected $casts = [
        'dob' => 'date:Y-m-d',
    ];

    public function getAuthPassword()
    {
        return $this->Password;
    }

    // Photo URL accessor
    public function getPhotoUrlAttribute()
    {
        if ($this->photo) {
            return asset('storage/' . $this->photo);
        }
        return asset('images/default-user.png');
    }

    // Relationship to Course
    public function course()
    {
        return $this->belongsTo(Course::class, 'C_ID');
    }

    // Relationship to Attendance
    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'student_id');
    }

    // Relationship to Notes (Student can have many notes)
    public function notes()
    {
        return $this->hasMany(Note::class, 'student_id');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'student_subjects', 'student_id', 'subject_id');
    }
}
