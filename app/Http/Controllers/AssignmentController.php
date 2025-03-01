<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Assignment;

class AssignmentController extends Controller
{
    public function assignments()
    {
        try {
            $studentId = auth()->guard('student')->id();

            $assignments = Assignment::select([
                'id',
                'title',
                'description',
                'file_path',
                'due_date',
                'created_at'
            ])
            ->where('student_id', $studentId)
            ->get();

            return view('assignments', compact('assignments'));  

        } catch (\Exception $e) {
            $assignments = collect(); 
            return view('assignments', compact('assignments'))->with('error', 'Error loading assignments: ' . $e->getMessage());
        }
    }
}
