<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    // Display the list of news notices
    public function index()
    {
        // Retrieve all notices, ordering newest first
        $notices = News::latest()->get();
        return view('news', compact('notices'));
    }

    // Store a new notice
    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:191',
            'content' => 'required|string',
        ]);

        News::create($request->all());

        return redirect()->route('news.index')
                         ->with('success', 'Notice added successfully!');
    }

    // Update an existing notice
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'   => 'required|string|max:191',
            'content' => 'required|string',
        ]);

        $notice = News::findOrFail($id);
        $notice->update($request->all());

        return redirect()->route('news.index')
                         ->with('success', 'Notice updated successfully!');
    }

    // Delete a notice
    public function destroy($id)
    {
        $notice = News::findOrFail($id);
        $notice->delete();

        return redirect()->route('news.index')
                         ->with('success', 'Notice deleted successfully!');
    }
    public function studentIndex()
{
    $notices = News::latest()->get();
    return view('studentnews', compact('notices'));
}

public function teacherIndex()
{
    $notices = News::latest()->get();
    return view('teachernews', compact('notices'));
}
}
