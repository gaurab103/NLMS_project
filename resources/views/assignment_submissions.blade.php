<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment Submissions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin-left: 250px;
            overflow-y: auto;
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: yellow;
        }
        .navbar img {
            height: 70px;
            width: 80px;
        }
        .navbar .navbar-brand {
            margin-right: 34%;
            font-size: 1.5rem;
            font-weight: bold;
        }
        .section {
            height: 100vh;
            width: 250px;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            padding-top: 86px;
            background-color: whitesmoke;
        }
        .section a {
            padding: 15px;
            font-size: 18px;
            color: #333;
            display: block;
            text-decoration: none;
            text-align: center;
        }
        .section a:hover {
            color: white;
            background-color: #007bff;
            border-radius: 5px;
        }
        .card {
            margin-left: 15%;
            margin-right: 15%;
        }
        @media (max-width: 768px) {
            body {
                margin-left: 0;
            }
            .section {
                display: none;
            }
            .navbar .navbar-brand {
                font-size: 15px;
                margin-right: 25px;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="navbar">
            <div class="container d-flex align-items-center justify-content-between">
                <img src="{{ asset('images/logo.png') }}" alt="Logo">
                <a class="navbar-brand" href="#">Naragram Learning Management System</a>
            </div>
        </div>
    </header>

    <div class="section">
        <a href="{{ route('teacher.dashboard') }}">Home</a>
        <a href="#">Attendance</a>
        <a href="{{ route('teacher.notes') }}">Notes</a>
        <a href="{{ route('teacher.assignments.create') }}" style="background-color: #007bff; color:white;">Assignments</a>
        <a href="#">Communication</a>
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
        <form id="logout-form" action="{{ route('teacher.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>

    <div class="container">
        <div class="header text-center">
            <h1>Assignment Submissions</h1>
        </div>
        <nav class="nav justify-content-center">
            <a class="nav-link" href="{{ route('teacher.assignments.create') }}">Add Assignment</a>
            <a class="nav-link" href="{{ route('teacher.assignments.submissions') }}">View Submissions</a>
        </nav>

        <div class="mt-4">
            @forelse($assignments as $assignment)
                <div class="card mb-3">
                    <div class="card-header">
                        {{ $assignment->title }} - {{ $assignment->subject->name }} ({{ $assignment->course->course_name }})
                    </div>
                    <div class="card-body">
                        <h5>Submissions</h5>
                        @if($assignment->submissions->isEmpty())
                            <p>No submissions yet.</p>
                        @else
                            <ul class="list-group">
                                @foreach($assignment->submissions as $submission)
                                    <li class="list-group-item">
                                        {{ $submission->student->name }} - Submitted on {{ $submission->submitted_at->format('M d, Y') }}
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            @empty
                <p>No assignments created yet.</p>
            @endforelse
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
