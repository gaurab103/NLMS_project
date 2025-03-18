@include('nav_aside')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject->name }} - Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .content-wrapper { margin-left: 260px; padding: 25px; }
    </style>
</head>
<body>
    <div class="content-wrapper">
        <div class="container">
            <h1>{{ $subject->name }} - Subject Details</h1>
            <!-- Check if teacher is assigned, if not, show fallback message -->
            <p>Teacher: {{ $subject->teacher ? $subject->teacher->Teacher_Name : 'Teacher not assigned' }}</p>
            <p>Description: {{ $subject->description ?? 'No description provided.' }}</p>

            <h3>Notes</h3>
            @if($subject->notes->count() > 0)
                <ul class="list-group">
                    @foreach($subject->notes as $note)
                        <li class="list-group-item">
                            <strong>{{ $note->title }}</strong> - {{ $note->content }}
                            <br>
                            <small>Posted by: {{ $note->teacher ? $note->teacher->Teacher_Name : 'Unknown Teacher' }} on {{ $note->created_at->format('M d, Y') }}</small>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>No notes posted for this subject.</p>
            @endif

            <h3 class="mt-4">Assignments</h3>
            @if($subject->assignments->count() > 0)
                @foreach($subject->assignments as $assignment)
                    <div class="card mb-3">
                        <div class="card-header">
                            {{ $assignment->title }} - Due: {{ $assignment->due_date->format('M d, Y') }}
                        </div>
                        <div class="card-body">
                            <p>{{ $assignment->description }}</p>
                            <h5>Submissions</h5>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Student Name</th>
                                        <th>Status</th>
                                        <th>Submitted At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($subject->course->students as $student)
                                        @php
                                            $submission = $assignment->submissions->where('student_id', $student->id)->first();
                                        @endphp
                                        <tr>
                                            <td>{{ $student->name }}</td>
                                            <td>{{ $submission ? 'Submitted' : 'Not Submitted' }}</td>
                                            <td>{{ $submission ? $submission->submitted_at->format('M d, Y') : '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            @else
                <p>No assignments posted for this subject.</p>
            @endif

            <!-- Back to Class Button -->
            <a href="{{ route('student.dashboard', $subject->course_id) }}" class="btn btn-secondary mt-3">Back to Dashboard</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
