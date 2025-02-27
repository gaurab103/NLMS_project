<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{
    use Notifiable;

    protected $table = 'students';
    protected $fillable = [
        'name', 'dob', 'Address', 'Parent_Name', 'Contact_No',
        'Email', 'C_ID', 'A_ID', 'Stats', 'Username', 'Password', 'photo'
    ];

    // Note: The Password field is no longer hidden so it can be displayed in the table.
    // protected $hidden = ['Password'];

    protected $dates = ['dob'];
    protected $casts = [
        'dob' => 'date:Y-m-d',
    ];

    public function getAuthPassword()
    {
        return $this->Password;
    }

    public function getPhotoUrlAttribute()
    {
        return $this->photo
            ? asset('storage/' . $this->photo)
            : asset('images/default-user.png');
    }

    public function course()
    {
        return $this->belongsTo(\App\Models\Course::class, 'C_ID');
    }

    public function getFormattedDobAttribute()
    {
        return $this->dob ? $this->dob->format('d M Y') : 'N/A';
    }
}
