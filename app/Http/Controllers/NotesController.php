<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\Subject;
use App\Models\Course; 

class NotesController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:courses,id',
            'subject_id' => 'required|exists:subjects,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'file' => 'nullable|file|max:2048'
        ]);

        $note = new Note([
            'title' => $request->title,
            'content' => $request->content,
            'subject_id' => $request->subject_id,
            'teacher_id' => auth()->guard('teacher')->id(),
        ]);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('notes', 'public');
            $note->file_path = $path;
        }

        $note->save();

        return redirect()->back()->with('success', 'Note uploaded successfully');
    }

    public function notes()
    {
        // Fetch all notes, no longer filtered by teacher_id
        $notes = Note::with(['subject', 'course'])->latest()->get();
    
        $courses = Course::all();
        $subjects = Subject::all();  // You can modify this if you want to filter subjects based on some criteria
    
        return view('notes', [
            'notes' => $notes,
            'courses' => $courses,
            'subjects' => $subjects,
            'active' => 'notes'
        ]);
    }
}
