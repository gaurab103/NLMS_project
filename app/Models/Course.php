<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['course_name', 'A_ID'];

    public function subjects()
    {
        return $this->hasMany(Subject::class, 'course_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'C_ID');
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }
}
