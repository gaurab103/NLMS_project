<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Note;

class NotesController extends Controller
{
    public function notes()
    {
        try {
            $studentId = auth()->guard('student')->id();

            $notes = Note::select([
                'id',
                'content',
                'subject_id',
                'created_at'
            ])
            ->where('student_id', $studentId)
            ->get();

            return view('notes', compact('notes'));  

        } catch (\Exception $e) {
            $notes = collect(); 
            return view('notes', compact('notes'))->with('error', 'Error loading notes: ' . $e->getMessage());
        }
    }
}
