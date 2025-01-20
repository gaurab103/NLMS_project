<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'Teacher_Name',
        'Subject',
        'Email',
        'Phone_Number',
        'Address',
        'Status',
    ];
}
