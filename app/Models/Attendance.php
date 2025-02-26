<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendances'; 

    public $timestamps = true; 

    protected $primaryKey = 'id';  

    protected $fillable = [
        'Std_ID', 
        'A_ID', 
        'T_ID', 
        'status', 
        'created_at', 
        'updated_at'
    ];

    protected $hidden = [
    ];

    protected $dates = [
        'created_at', 
        'updated_at',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'Std_ID');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'T_ID');
    }
}
