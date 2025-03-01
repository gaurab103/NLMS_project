<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Message extends Model
{
    // The table associated with the model.
    protected $table = 'messages';

    // The attributes that are mass assignable.
    protected $fillable = [
        'student_id',
        'content',
        'sender',
        'file_path', // Added file path for attachments
        'created_at',
        'updated_at',
    ];

    /**
     * Copy the associated message file to a new location.
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
     * Get the student associated with the message.
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
