<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';

    protected $fillable = [
        'name', 
        'Address', 
        'Parent_Name', 
        'Contact_No', 
        'Email', 
        'C_ID', 
        'A_ID', 
        'Stats',
    ];
    public $timestamps = false;
}
