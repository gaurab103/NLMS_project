<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #f8f9fa;
            padding-top: 70px;
            transition: 0.3s;
        }
        .sidebar a {
            padding: 15px;
            text-decoration: none;
            font-size: 18px;
            color: #333;
            display: block;
            text-align: center;
            transition: 0.3s;
        }
        .sidebar a:hover {
            background-color: #007bff;
            color: white;
        }
        .sidebar .active {
            background-color: #007bff;
            color: white;
        }
        .navbar-brand img {
            height: 50px;
            margin-right: 10px;
        }
        @media (max-width: 768px) {
            .sidebar {
                left: -250px;
            }
            .sidebar.active {
                left: 0;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-warning">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="{{ asset('images/logo.png') }}" alt="Logo">
                Naragram LMS
            </a>
            <button class="navbar-toggler mobile-menu-btn" type="button" onclick="toggleSidebar()">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <div class="sidebar" id="sidebar">
        <a href="{{ route('teacher.dashboard') }}" class="{{ $active === 'home' ? 'active' : '' }}">
            <i class="fas fa-home"></i> Home
        </a>
        <a href="{{ route('teacher.attendance') }}" class="{{ $active === 'attendance' ? 'active' : '' }}">
            <i class="fas fa-clipboard-check"></i> Attendance
        </a>
        <a href="{{ route('teacher.notes') }}" class="{{ $active === 'notes' ? 'active' : '' }}">
            <i class="fas fa-file-alt"></i> Notes
        </a>
        <a href="{{ route('assignments.index') }}" class="{{ $active === 'assignments' ? 'active' : '' }}">
            <i class="fas fa-tasks"></i> Assignments
        </a>
        <a href="{{ route('teacher.news') }}" class="{{ $active === 'communication' ? 'active' : '' }}">
            <i class="fas fa-comments"></i> News
        </a>
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
        <form id="logout-form" action="{{ route('teacher.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        }
    </script>
</body>
</html>
