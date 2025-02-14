<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Teacher extends Authenticatable
{
    use Notifiable;

    protected $guard = 'teacher';

    protected $fillable = [
        'Teacher_Name', 'Subject', 'Email', 'Phone_Number',
        'Address', 'Username', 'Password', 'Status', 'A_ID'
    ];

    // Hide the password attribute when serializing
    protected $hidden = ['Password'];

    public function getAuthPassword()
    {
        return $this->Password;
    }

    // Mutator to automatically hash passwords
    public function setPasswordAttribute($value)
    {
        $this->attributes['Password'] = bcrypt($value);
    }
}
