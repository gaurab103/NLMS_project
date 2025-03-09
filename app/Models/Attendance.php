<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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
    // Optionally, you can specify which attributes should be hidden in arrays (e.g., for API responses)
    protected $hidden = [
        // 'some_column',  // Add columns to hide from JSON output
    ];

    // If you have date fields, ensure that they are cast to a DateTime type
    protected $dates = [
        'date', // Add this line
        'created_at',
        'updated_at',
    ];
    // Example of relationships (if you want to link Attendance to other models like Student and Teacher)
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
