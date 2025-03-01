<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Attendance extends Model
{
    // Specify the table name (Laravel assumes plural by default)
    protected $table = 'attendances';

    // If you're using timestamps in your table (created_at, updated_at)
    public $timestamps = true;  // This is actually optional as Laravel does this automatically

    // Specify the primary key if it's not the default 'id'
    protected $primaryKey = 'id';  // Optional, use only if your primary key is different

    // Define the fillable fields for mass assignment (this helps prevent mass-assignment vulnerabilities)
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
