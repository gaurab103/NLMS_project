<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Note extends Model
{
    protected $table = 'notes';  

    protected $fillable = [
        'content',  
        'subject_id', 
        'file_id', // Reference to the file in the attendance DB
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class); 
    }

    /**
     * Copy the associated file from the attendance database.
     *
     * @param string $newPath
     * @return bool
     */
    public function copyFileFromAttendance(string $newPath): bool
    {
        $fileRecord = DB::connection('attendance')->table('files')->find($this->file_id);

        if (!$fileRecord || !Storage::exists($fileRecord->file_path)) {
            return false; // File doesn't exist
        }

        return Storage::copy($fileRecord->file_path, $newPath);
    }
}
