<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{
    public function messages()
    {
        try {
            $studentId = auth()->guard('student')->id();

            if (!$studentId) {
                return redirect()->route('login')->with('error', 'Please log in to view messages.');
            }

            Log::info('Logged-in student ID: ' . $studentId);

            $messages = Message::where('student_id', $studentId) // Assuming a 'student_id' column exists in the messages table
                ->select('id', 'content', 'created_at', 'updated_at')
                ->get();

            Log::info('Messages retrieved: ', $messages->toArray());

            if ($messages->isEmpty()) {
                return view('messages', compact('messages'))->with('info', 'You have no messages.');
            }

            return view('messages', compact('messages'));

        } catch (\Exception $e) {
            Log::error('Error loading messages: ' . $e->getMessage());

            $messages = collect();
            return view('messages', compact('messages'))->with('error', 'Error loading messages: ' . $e->getMessage());
        }
    }
}
