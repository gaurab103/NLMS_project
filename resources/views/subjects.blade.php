<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subject Details</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Your Subjects</h1>

        <!-- Display error message if any -->
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Check if there are subjects to display -->
        @if($subjects->isNotEmpty())
            @foreach($subjects as $subject)
                <div class="card">
                    <div class="card-header">
                        <h3>{{ $subject->Name }} {{ $subject->code }}</h3>
                    </div>
                    <div class="card-body">
                        {{-- <p><strong>Name:</strong> {{ $subject->Name }}</p> --}}
                        <p><strong>Created on:</strong> {{ $subject->created_at->format('M d, Y h:i A') }}</p>
                        <p><strong>Last updated:</strong> {{ $subject->updated_at->format('M d, Y h:i A') }}</p>

                        <!-- If there's an attached file, provide a link to download -->
                        @if($subject->file_path)
                            <p>
                                <strong>Attachment:</strong>
                                <a href="{{ Storage::url($subject->file_path) }}" class="btn btn-primary btn-sm" target="_blank">Download Attachment</a>
                            </p>
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <div class="alert alert-info">
                You have no subjects.
            </div>
        @endif
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
