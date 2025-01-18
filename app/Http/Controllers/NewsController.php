<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notice;

class NewsController extends Controller
{
    // Display the form and list of notices
    public function index()
    {
        $notices = Notice::all(); // Fetch all notices from the database
        return view('news', compact('notices'));
    }

    // Store new notice
    public function store(Request $request)
    {
        $notice = new Notice();
        $notice->title = $request->title;
        $notice->content = $request->content;
        $notice->save();

        return redirect()->route('news')->with('success', 'Notice added successfully!');
    }



    public function edit(Request $request, $id)
    {
        $notice = Notice::find($id);
        $notice->title = $request->title;
        $notice->content = $request->content;
        $notice->save();

        return redirect()->route('news')->with('success', 'Notice updated successfully!');
    }

    // Delete a notice
    public function destroy($id)
    {
        $notice = Notice::find($id);
        $notice->delete();

        return redirect()->route('news')->with('success', 'Notice deleted successfully!');
    }
}
