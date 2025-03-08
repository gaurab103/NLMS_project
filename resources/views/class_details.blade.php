@include('nav_aside')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Details - {{ $class->course_name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .content-wrapper {
            margin-left: 260px;
            padding: 25px;
        }
        .subject-card {
            background: #f8f9fa;
            border-left: 4px solid #4093e7;
        }
    </style>
</head>
<body>
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">{{ $class->course_name }} - Details</h3>
                </div>
                <div class="card-body">
                    <h4>Subjects</h4>
                    <div class="row">
                        @foreach ($class->subjects as $subject)
                            <div class="col-md-4">
                                <div class="card subject-card mb-3">
                                    <div class="card-body">
                                        <h5>{{ $subject->name }}</h5>
                                        <p>Teacher: {{ $subject->teacher->Teacher_Name }}</p>
                                        <a href="{{ route('classes.subjects.show', [$class->id, $subject->id]) }}"
                                           class="btn btn-info btn-sm">View Details</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <h4 class="mt-4">Students</h4>
                    @if($class->students->isEmpty())
                        <p>No students enrolled.</p>
                    @else
                        <ul class="list-group">
                            @foreach($class->students as $student)
                                <li class="list-group-item">{{ $student->name }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <a href="{{ route('classes.index') }}" class="btn btn-secondary mt-3">Back to Classes</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
