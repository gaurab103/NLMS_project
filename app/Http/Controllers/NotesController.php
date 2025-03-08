<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;

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
        try {
            $studentId = auth()->guard('student')->id();
            $notes = Note::select(['id', 'content', 'subject_id', 'created_at'])
                ->where('student_id', $studentId)
                ->get();
            return view('notes', compact('notes'));
        } catch (\Exception $e) {
            $notes = collect();
            return view('notes', compact('notes'))->with('error', 'Error loading notes: ' . $e->getMessage());
        }
    }
}
