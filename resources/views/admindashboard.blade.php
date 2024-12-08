<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <title>Responsive Admin Dashboard</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .sidebar {
            height: 100vh;
            width: 250px;
            background-color: #2c3e50;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 20px;
            overflow-y: auto;
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .sidebar.hidden {
            left: -250px;
            /* Hidden for smaller devices */
        }

        .sidebar a {
            color: #ecf0f1;
            text-decoration: none;
            padding: 15px 20px;
            display: block;
            font-size: 18px;
        }

        .sidebar a:hover {
            background-color: #34495e;
        }

        .main-content {
            margin-left: 250px;
            /* For larger devices */
            padding: 10px;
            transition: margin-left 0.3s ease;
        }

        .main-content.collapsed {
            margin-left: 0;
            /* For smaller devices */
        }

        .header {
            background-color: #ffcc00;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 8px;
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .grid-item {
            background-color: #ecf0f1;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .grid-item h3 {
            margin-top: 10px;
            font-size: 20px;
            color: #2c3e50;
        }

        .grid-item i {
            font-size: 40px;
            color: #34495e;
            margin-bottom: 10px;
        }

        @media (max-width: 768px) {
            .sidebar {
                left: -250px;
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>
    HEllo
    <aside class="sidebar" id="sidebar">
        <a href="{{route('admin')}}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="{{route('students')}}"><i class="fas fa-user-graduate"></i> Manage Students</a>
        <a href="{{route('teachers')}}"><i class="fas fa-chalkboard-teacher"></i> Manage Teachers</a>
        <a href="{{route('attendance')}}"><i class="fas fa-calendar-check"></i> Attendance</a>
        <a href="{{route('news')}}"><i class="fas fa-newspaper"></i> News & Notices</a>
        <a href="#logout" onclick="logout()"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </aside>
    <div class="main-content" id="mainContent">
        <div class="header">
            <button class="btn btn-dark d-md-none" id="toggleSidebar">
                <i class="fas fa-bars"></i>
            </button>
            <div class="logo">
                <img src="{{ asset('images/logo.png') }}" alt="Admin Logo" width="60">
            </div>
            <div class="search-bar">
                <i class="fas fa-search" id="searchIcon"></i>
                <input style="display:none;" type="text" id="searchInput" placeholder="Search..."
                    onkeyup="filterItems()">
            </div>
        </div>

        <div class="grid-container mt-4" id="dashboardGrid">
            <div class="grid-item" data-name="Manage Students">
                <i class="fas fa-user-graduate"></i>
                <h3>Manage Students</h3>
            </div>
            <div class="grid-item" data-name="Manage Teachers">
                <i class="fas fa-chalkboard-teacher"></i>
                <h3>Manage Teachers</h3>
            </div>
            <div class="grid-item" data-name="Attendance">
                <i class="fas fa-calendar-check"></i>
                <h3>Attendance</h3>
            </div>
            <div class="grid-item" data-name="News and Notices">
                <i class="fas fa-newspaper"></i>
                <h3>News & Notices</h3>
            </div>
            <div class="grid-item">
                <i class="fas fa-book"></i>
                <h3>Manage Subjects</h3>
            </div>
        </div>
    </div>

    <script>
        const toggleSidebar = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');

        toggleSidebar.addEventListener('click', () => {
            sidebar.classList.toggle('hidden');
            mainContent.classList.toggle('collapsed');
        });

        document.getElementById('searchIcon').addEventListener('click', function() {
            const searchInput = document.getElementById('searchInput');
            const searchIcon = document.getElementById('searchIcon');

            searchInput.style.display = 'block';
            searchIcon.style.display = 'none';
            searchInput.focus();
        });

        document.addEventListener('click', function(event) {
            const searchInput = document.getElementById('searchInput');
            const searchIcon = document.getElementById('searchIcon');
            if (event.target !== searchInput && event.target !== searchIcon) {
                searchInput.style.display = 'none';
                searchIcon.style.display = 'block';
            }
        });
    </script>

</body>

</html>
