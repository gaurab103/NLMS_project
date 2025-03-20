@include('nav_aside')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Details - {{ $class->course_name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .content-wrapper { margin-left: 260px; padding: 25px; }
        .subject-card { background: #f8f9fa; border-left: 4px solid #4093e7; transition: all 0.2s; }
        .subject-card:hover { background: #e9ecef; }
    </style>
</head>
<body>
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0"><i class="fas fa-landmark me-2"></i>{{ $class->course_name }} - Details</h3>
                </div>
                <div class="card-body">
                    <h4><i class="fas fa-book me-2"></i>Subjects</h4>
                    @if($class->subjects->isEmpty())
                        <p>No subjects added yet.</p>
                    @else
                        <div class="row">
                            @foreach ($class->subjects as $subject)
                                <div class="col-md-4">
                                    <div class="card subject-card mb-3">
                                        <div class="card-body">
                                            <h5>{{ $subject->name }}</h5>
                                            <p>Teacher: {{ $subject->teacher->Teacher_Name }}</p>
                                            <a href="{{ route('classes.subjects.show', [$class->id, $subject->id]) }}"
                                               class="btn btn-info btn-sm">
                                                <i class="fas fa-eye me-2"></i>View Details
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <h4 class="mt-4"><i class="fas fa-users me-2"></i>Students</h4>
                    @if($class->students->isEmpty())
                        <p>No students enrolled.</p>
                    @else
                        <ul class="list-group">
                            @foreach($class->students as $student)
                                <li class="list-group-item">{{ $student->name }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <a href="{{ route('classes.index') }}" class="btn btn-secondary mt-3">
                        <i class="fas fa-arrow-left me-2"></i>Back to Classes
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
