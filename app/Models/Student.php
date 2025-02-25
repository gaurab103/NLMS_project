<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class Student extends Authenticatable
{
    use Notifiable;

    protected $guard = 'student';

    protected $fillable = [
        'name',
        'dob',
        'photo',
        'Address',
        'Parent_Name',
        'Contact_No',
        'Email',
        'C_ID',
        'A_ID',
        'Stats',
        'Username',
        'Password'
    ];

    protected $hidden = ['Password'];

    protected $casts = [
        'dob' => 'date',
    ];

    public function getAuthPassword()
    {
        return $this->Password;
    }

    public function getPhotoUrlAttribute()
    {
        return $this->photo
            ? asset('storage/'.$this->photo)
            : asset('images/default-user.png');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'C_ID');
    }
    public function getFormattedDobAttribute()
    {
        return $this->dob->format('d M Y');
    }
}
