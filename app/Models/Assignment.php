<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Assignment extends Model
{
    protected $table = 'assignments';

    protected $fillable = [
        'student_id',
        'title',
        'description',
        'file_path', // Added file path for submissions
        'due_date',
        'created_at',
        'updated_at',
    ];

    /**
     * Copy the associated assignment file to a new location.
     *
     * @param string $newPath
     * @return bool
     */
    public function copyFile(string $newPath): bool
    {
        if (!$this->file_path || !Storage::exists($this->file_path)) {
            return false;
        }

        return Storage::copy($this->file_path, $newPath);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
