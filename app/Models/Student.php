<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
    
    protected $fillable = [
        'id',
        'C_ID',
        'name',
        'Address',
        'Parent_Name',
        'Contact_No',
        'Email',
        'Stats'
    ];
}
