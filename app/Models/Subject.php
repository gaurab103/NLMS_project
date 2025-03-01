<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Subject extends Model
{
    protected $table = 'subjects';

    protected $fillable = [
        'student_id',
        'name',
        'code',
        'file_path', 
        'created_at',
        'updated_at',
    ];

    /**
     * Copy the associated subject file to a new location.
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

    /**
     * Get the student associated with the subject.
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
