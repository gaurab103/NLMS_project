@include('nav_aside')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <title>Naragram LMS Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s ease;
        }

        .welcome-banner {
            background: linear-gradient(to right, #ff6f61, #f06292);
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 12px;
            margin: auto;
            margin-top: 20px;
            font-size: 28px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        .welcome-banner h3 {
            margin: 0;
            font-weight: bold;
        }

        .welcome-banner i {
            font-size: 50px;
            animation: bounce 1.5s infinite;
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .grid-item {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            transform: translateY(0);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .grid-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .grid-item i {
            font-size: 40px;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .grid-item a {
            font-size: 20px;
            color: #2c3e50;
            font-weight: bold;
        }
        .grid-item a:hover {
            text-decoration: none;
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes slideIn {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
            }

            .welcome-banner {
                flex-direction: column;
                text-align: center;
                font-size: 24px;
            }

            .welcome-banner i {
                margin-top: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="main-content" id="mainContent">
        <!-- Welcome Banner -->
        <div class="welcome-banner">
            <div class="welcome-text">
                <h2>Welcome, {{ Auth::guard('admin')->user()->Admin_Name }}</h2>
            </div>
            <i class="fas fa-user-shield welcome-icon"></i>
        </div>

        <!-- Dashboard Grid -->
        <div class="grid-container" id="dashboardGrid">
            <a href="{{ route('students.index') }}" class="grid-item">
                <i class="fas fa-user-graduate grid-icon"></i>
                <h3>Manage Students</h3>
            </a>

            <a href="{{ route('teachers.index') }}" class="grid-item">
                <i class="fas fa-chalkboard-teacher grid-icon"></i>
                <h3>Manage Teachers</h3>
            </a>

            <a href="{{ route('admin.attendance') }}" class="grid-item">
                <i class="fas fa-calendar-check grid-icon"></i>
                <h3>Attendance Tracking</h3>
            </a>

            <a href="{{ route('news.index') }}" class="grid-item">
                <i class="fas fa-newspaper grid-icon"></i>
                <h3>News & Notices</h3>
            </a>

            <a href="{{ route('class') }}" class="grid-item">
                <i class="fas fa-landmark grid-icon"></i>
                <h3>Class Management</h3>
            </a>
        </div>
    </div>

    <script>
        // function filterItems() {}
        // var filter = document.getElementById('searchInput').value.toLowerCase().trim();
        // var grid = document.getElementById('dashboardGrid');
        // var items = grid.getElementsByClassName('grid-item');
        // for (var i = 0; i < items.length; i++) {
        //     var item = items[i];
        //     var nameText = item.getAttribute('data-name').toLowerCase().trim();
        //     if (nameText.includes(filter)) {
        //         item.style.display = 'block';
        //     } else { item.style.display = 'none'; }
        // }
        // document.getElementById('searchInput').addEventListener('keyup', filterItems);
        // document.getElementById('searchInput').addEventListener('keyup', function() {
        //     var filter = document.getElementById('searchInput').value.toLowerCase().trim();
        //     var grid = document.getElementById('dashboardGrid');
        //     var items = grid.getElementsByClassName('grid-item');
        //     for (var i = 0; i < items.length; i++) {
        //         var item = items[i];
        //         var nameText = item.getAttribute('data-name').toLowerCase().trim(); if (nameText.includes(filter)) {
        //             item.style.display = 'block'; } else { item.style.display = 'none'; }
        //         }
        //     });
    </script>
</body>

</html>
