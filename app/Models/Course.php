<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['course_name', 'A_ID'];

    public function students()
    {
        return $this->hasMany(Student::class, 'C_ID');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'A_ID');
    }
}
