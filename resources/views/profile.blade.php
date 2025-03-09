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
                    <p><strong>Date of Birth:</strong> {{ $student->dob }}</p>
                    <p><strong>Address:</strong> {{ $student->Address }}</p>
                    <p><strong>Parent's Name:</strong> {{ $student->Parent_Name }}</p>
                    <p><strong>Contact Number:</strong> {{ $student->Contact_No }}</p>
                    <p><strong>Course:</strong> {{ $student->courses->course_name ?? 'N/A' }}</p>
                    <p><strong>Profile Photo:</strong> <img src="{{ $student->photo_url }}" alt="Student Photo" class="img-thumbnail" width="150"></p>
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
