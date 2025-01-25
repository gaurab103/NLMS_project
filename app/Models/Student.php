<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{
    use Notifiable;

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
        'Username',
        'Password',
    ];

    protected $hidden = ['Password'];

    public function getAuthPassword()
    {
        return $this->Password;
    }

    public $timestamps = false;
}
