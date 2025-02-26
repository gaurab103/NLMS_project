<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $table = 'notes';  

    protected $fillable = [
        'content',  
        'subject_id', 
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class); 
    }
}

