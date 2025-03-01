<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Subject;

class SubjectController extends Controller
{
    /**
     * Display the list of subjects for the logged-in student.
     *
     * @return \Illuminate\View\View
     */
    public function subjects()
    {
        try {
            // Get the logged-in student's ID
            $studentId = auth()->guard('student')->id(); // Assuming you're using a custom guard for the student

            // Fetch the subjects associated with the logged-in student
            $subjects = Subject::where('student_id', $studentId)
                ->get(); // Fetch subjects for the logged-in student

            return view('subjects', compact('subjects')); // Pass subjects to the view

        } catch (\Exception $e) {
            // Handle any errors
            $subjects = collect(); // Empty collection
            return view('subjects', compact('subjects'))->with('error', 'Error loading subjects: ' . $e->getMessage());
        }
    }
}

