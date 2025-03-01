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
        'Address', 'Username', 'Password', 'Status', 'A_ID', 'Photo'
    ];

    // Append the photo_url attribute for easy access in views.
    protected $appends = ['photo_url'];

    public function getPhotoUrlAttribute()
    {
        return $this->Photo
            ? asset('storage/' . $this->Photo)
            : asset('images/default-user.png');
    }
}
