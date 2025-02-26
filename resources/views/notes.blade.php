<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Notes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .notes-container {
            max-width: 800px;
            margin: 0 auto;
        }
        .note-card {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 5px;
        }
        .no-notes {
            color: #666;
            text-align: center;
            font-style: italic;
        }
        .error-message {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="notes-container">
        <h1>My Notes</h1>

        <!-- Display error message if there is one -->
        @if(session('error'))
            <p class="error-message">{{ session('error') }}</p>
        @endif

        <!-- Display notes if available -->
        @if($notes->isEmpty())
            <p class="no-notes">You haven't created any notes yet.</p>
        @else
            @foreach($notes as $note)
                <div class="note-card">
                    <h2>{{ $note->title ?? 'Untitled Note' }}</h2>
                    <p>{{ $note->content ?? 'No content available for this note.' }}</p>
                    <small>Created on: {{ $note->created_at->format('M d, Y') }}</small>
                </div>
            @endforeach
        @endif

        <div>
            <a href="{{ route('student.dashboard') }}">Back to Home</a>
        </div>
    </div>
</body>
</html>
