<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';
    protected $table = 'admins';

    protected $fillable = [
        'Admin_Name', 'Email', 'Username', 'Password'
    ];

    protected $hidden = ['Password'];

    public function getAuthPassword()
    {
        return $this->Password;
    }
}
