<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class Teacher extends Authenticatable
{
    use Notifiable;

    protected $guard = 'teacher';

    protected $fillable = [
        'Teacher_Name', 'Subject', 'Email', 'Phone_Number',
        'Address', 'Username', 'Password', 'Status', 'A_ID', 'Photo'
    ];
    protected $appends = ['photo_url', 'all'];
    public function getPhotoUrlAttribute()
    {
        return $this->photo
            ? asset('storage/'.$this->photo)
            : asset('images/default-user.png');
    }
}
