<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Messages</title>
    <!-- You can include Bootstrap or other styles here -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Your Messages</h1>

        <!-- Display error message if any -->
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Check if there are messages to display -->
        @if($messages->isEmpty())
            <div class="alert alert-info">
                You have no messages.
            </div>
        @else
            <div class="list-group">
                @foreach($messages as $message)
                    <div class="list-group-item">
                        <h5 class="mb-1">{{ $message->sender }}</h5>
                        <p class="mb-1">{{ $message->content }}</p>
                        <small>Sent on: {{ $message->created_at->format('M d, Y h:i A') }}</small>

                        <!-- If there's an attached file, provide a link to download -->
                        @if($message->file_path)
                            <br>
                            <a href="{{ Storage::url($message->file_path) }}" class="btn btn-primary btn-sm" target="_blank">Download Attachment</a>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- You can include Bootstrap JS here -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
