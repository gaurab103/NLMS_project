<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Student Profile</h1>

        @if(isset($student))
            <div class="card mt-3">
                <div class="card-body">
                    <p><strong>Name:</strong> {{ $student->name }}</p>
                    <p><strong>Email:</strong> {{ $student->Email }}</p>
                </div>
            </div>
        @elseif(isset($error))
            <div class="alert alert-danger">{{ $error }}</div>
        @else
            <div class="alert alert-warning">No student data available</div>
        @endif
    </div>
</body>
</html>
