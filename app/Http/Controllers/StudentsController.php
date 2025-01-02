<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Log;


class StudentsController extends Controller
{
    public function index()
    {
        return view("layout");
    }
    public function profile()
    {
        try {
            $student = Student::select([
                'id', 
                'name', 
                'C_ID', 
                'A_ID', 
                'Address', 
                'Parent_Name', 
                'Contact_No', 
                'Email', 
                'Stats'
            ])
            ->where('id', 1)
            ->first();
        
        if (!$student) {
            return view('profile')->with('error', 'Student not found.');
        }
        
        return view('profile')->with('student', $student);
        
        } catch (\Exception $e) {
            Log::error('Error fetching student profile: ' . $e->getMessage());
            return view('profile', ['error' => 'Error loading student data. Please try again later.']);
        }
    }
    
}
