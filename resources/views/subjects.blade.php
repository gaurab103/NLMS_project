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
        <h1>Your Subjects in {{ $courses->implode('course_name', ', ') }}</h1>

        <!-- Display error message if any -->
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Check if there are subjects to display -->
        @if($subjects->isNotEmpty())
            @foreach($subjects as $subject)
                <div class="card mb-3">
                    <div class="card-header">
                        <h3>{{ $subject->name }}</h3>
                    </div>
                    <div class="card-body">
                        <!-- Displaying all subject data -->
                        <ul class="list-group">
                            @foreach($subject->getAttributes() as $key => $value)
                                @if($key != 'file_path') <!-- Skip file_path to display later if necessary -->
                                    <li class="list-group-item">
                                        <strong>{{ ucwords(str_replace('_', ' ', $key)) }}:</strong> 
                                        {{ $value }}
                                    </li>
                                @endif
                            @endforeach
                        </ul>

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
                You have no subjects in your courses.
            </div>
        @endif
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
