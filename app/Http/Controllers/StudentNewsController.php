<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\News;

class StudentNewsController extends Controller
{
    public function news()
    {
        try {
            // Get the logged-in student's ID
            $studentId = auth()->guard('student')->id();

            // Fetch the news associated with the student (you may want to modify the condition if needed)
            $news = News::select([
                'id',
                'title',
                'content',
                'created_at'
            ])
            ->where('student_id', $studentId) // If there's a student-specific news filter
            ->get();

            return view('studentnews', compact('news'));  

        } catch (\Exception $e) {
            // In case of an error, log and return a default empty collection
            $news = collect(); 
            return view('studentnews', compact('news'))->with('error', 'Error loading news: ' . $e->getMessage());
        }
    }
}
