<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Student extends Model
{
    use Notifiable;

    protected $guard = 'student';

    protected $fillable = [
        'name', 'Address', 'Parent_Name', 'Contact_No',
        'Email', 'C_ID', 'A_ID', 'Stats', 'Username', 'Password'
    ];

    protected $hidden = ['Password'];

    public function getAuthPassword()
    {
        return $this->Password;
    }
}
