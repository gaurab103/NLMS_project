<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\Subject;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class NotesController extends Controller
{
    public function teacherNotes()
    {
        $teacherId = Auth::guard('teacher')->id();
        $notes = Note::with(['subject'])
                     ->where('teacher_id', $teacherId)
                     ->latest()
                     ->get();
        $courses = Course::whereHas('subjects', function ($query) use ($teacherId) {
            $query->where('teacher_id', $teacherId);
        })->get();

        return view('notesteacher', [
            'notes' => $notes,
            'courses' => $courses,
            'active' => 'notes'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:courses,id',
            'subject_id' => 'required|exists:subjects,id',
            'title' => 'required|string|max:255',
            'chapter_name' => 'required|string|max:255',
            'content' => 'required|string',
            'file' => 'nullable|file|max:2048|mimes:pdf,doc,docx'
        ]);

        $teacherId = Auth::guard('teacher')->id();

        // Check if the subject belongs to the teacher
        $subject = Subject::where('id', $request->subject_id)
                          ->where('teacher_id', $teacherId)
                          ->first();

        if (!$subject) {
            return back()->withErrors(['subject_id' => 'You are not authorized to add notes for this subject.'])->withInput();
        }

        // Ensure the subject's course matches the selected class
        if ($subject->course_id != $request->class_id) {
            return back()->withErrors(['class_id' => 'The selected class does not match the subject\'s class.'])->withInput();
        }

        $note = new Note([
            'title' => $request->title,
            'chapter_name' => $request->chapter_name,
            'content' => $request->content,
            'subject_id' => $request->subject_id,
            'teacher_id' => $teacherId,
        ]);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('notes', 'public');
            $note->file_path = $path;
        }

        $note->save();

        return redirect()->route('teacher.notes')->with('success', 'Note uploaded successfully');
    }
}
