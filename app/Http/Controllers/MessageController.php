<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;

class MessageController extends Controller
{
    public function messages()
    {
        try {
            $studentId = auth()->guard('student')->id();

            $messages = Message::select([
                'id',
                'content',
                'sender',
                'file_path',
                'created_at',
                'updated_at'
            ])
            ->where('student_id', $studentId)
            ->get();

            return view('messages', compact('messages'));

        } catch (\Exception $e) {
            $messages = collect(); 
            return view('messages', compact('messages'))->with('error', 'Error loading messages: ' . $e->getMessage());
        }
    }
}
