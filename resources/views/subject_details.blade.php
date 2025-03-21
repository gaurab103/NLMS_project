@include('nav_aside')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject->name }} - Subject Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .content-wrapper { margin-left: 260px; padding: 25px; }
        .note-item { border-left: 4px solid #28a745; }
        .assignment-card { border-left: 4px solid #dc3545; }
    </style>
</head>
<body>
    <div class="content-wrapper">
        <div class="container">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0"><i class="fas fa-book-open me-2"></i>{{ $subject->name }} - Subject Details</h3>
                </div>
                <div class="card-body">
                    <p><strong>Teacher:</strong> {{ $subject->teacher->Teacher_Name ?? 'N/A' }}</p>
                    <p><strong>Description:</strong> {{ $subject->description ?? 'No description provided.' }}</p>

                    <h4><i class="fas fa-sticky-note me-2"></i>Notes</h4>
                    @if($subject->notes->count() > 0)
                        <ul class="list-group">
                            @foreach($subject->notes as $note)
                                <li class="list-group-item note-item mb-2">
                                    <strong>{{ $note->title }}</strong> - {{ $note->content }}
                                    @if($note->file_path)
                                        <br><a href="{{ Storage::url($note->file_path) }}" target="_blank">Download File</a>
                                    @endif
                                    <br>
                                    <small>Posted by: {{ $note->teacher->Teacher_Name ?? 'N/A' }} on {{ $note->created_at->format('M d, Y') }}</small>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>No notes posted for this subject.</p>
                    @endif

                    <h4 class="mt-4"><i class="fas fa-tasks me-2"></i>Assignments</h4>
                    @if($subject->assignments->count() > 0)
                        @foreach($subject->assignments as $assignment)
                            <div class="card assignment-card mb-3">
                                <div class="card-header">
                                    {{ $assignment->title }} - Due: {{ $assignment->due_date->format('M d, Y') }}
                                </div>
                                <div class="card-body">
                                    <p>{{ $assignment->description ?? 'No description.' }}</p>
                                    @if($assignment->file_path)
                                        <a href="{{ Storage::url($assignment->file_path) }}" target="_blank">Download File</a>
                                    @endif
                                    <h5 class="mt-3">Submissions</h5>
                                    <table class="table table-bordered">
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
                                                    <td>{{ $submission ? $submission->submitted_at->format('M d, Y H:i') : '-' }}</td>
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

                    <a href="{{ route('classes.show', $subject->course_id) }}" class="btn btn-secondary mt-3">
                        <i class="fas fa-arrow-left me-2"></i>Back to Class
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
