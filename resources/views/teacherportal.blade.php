
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
         * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            margin-left: 250px;
            overflow-y: auto; /* Allow vertical scrolling */
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
        .box {
            border-radius: 25px;
            background: red;
            padding: 20px;
            margin-top: 50px;
            margin-left: 10%;
            width: 80%;
            height: 150px;  
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: white;
        }
        .box h1 {
            margin: 0;
            font-size: 24px;
        }
        .box img {
            height: 120px;
            width: auto;
            border-radius: 10px;
        }
        .grid-container {
            margin: 30px auto;
            width: 85%;
        }
        .grid-item {
            border: 2px solid #000000;
            border-radius: 10px;
            padding: 40px;
            text-align: center;
            background-color: rgb(255, 255, 255);
            color: #333;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .grid-item:hover {
            background-color: #b8b8b8d5;
            cursor: pointer;
        }
        .row + .row {
            margin-top: 20px; /* Spacing between rows */
        }
        .mobile-menu-btn {
            display: none; /* Hidden by default */
            margin: 15px ;
            background-color: #5e5d5d;
        }
        .back-btn {
            display: none; /* Hidden by default */
            margin: 15px;
            text-align: center;
            background-color: #5e5d5d;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
        }
        @media (max-width: 768px) {
            body {
                margin-left: 0; /* Remove sidebar margin on mobile */
            }
            .section {
                display: none; /* Hide sidebar by default */
            }
            .navbar .navbar-brand {
                font-size: 15px;
                font-weight: bold;
                margin-right: 25px;
            }
            .navbar form {
                width: 100%; /* Make the form take up full width */
                display: flex;
                justify-content: center;
                margin-top: 10px;
            }
            .navbar .form-control {
                width: 80%; /* Make the search input take up most of the space */
            }
            .mobile-menu-btn {
                display: block; /* Show button on small screens */
                margin-left: 3px;
            }
            .back-btn {
                display: block; /* Show back button on small screens */
               
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="navbar">
            <div class="container d-flex align-items-center justify-content-between">
                <img src="{{ asset('images/logo.png') }}" alt="Admin Logo" width="60">
                <a class="navbar-brand" href="#">Naragram Learning Management System</a>
                <form class="d-flex" role="search" onsubmit="event.preventDefault(); filterItems()">
                    <input id="search-bar" class="form-control me-2" type="search" placeholder="Search by name" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </header>
    <button class="btn btn-primary mobile-menu-btn" onclick="toggleSidebar()">☰</button>
    <div class="section">
        <button class="back-btn" onclick="closeSidebar()"><</button>
        <a href="#" aria-label="Home" style="background-color: #007bff; color:white;">Home</a>
        <a href="#" aria-label="Attendance">Attendance</a>
        <a href="{{ route('teacher.notes') }}" aria-label="Notes">Notes</a>
        <a href="{{ route('teacher.assignment') }}" aria-label="Assignments">Assignments</a>
        <a href="#" aria-label="Communication">Communication</a>
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
      <i class="fas fa-sign-out-alt"></i> Logout
    </a>
    <!-- Hidden logout form -->
    <form id="logout-form" action="{{ route('teacher.logout') }}" method="POST" style="display: none;">
      @csrf
    </form>

    
    </div>
    <div class="box">
        <h1>Welcome Teacher</h1>
        <img src="{{ asset('images/teacherportal.png') }}" alt="Teacher">
    </div>
    <div class="grid-container container">
        <div class="row">
            <div class="col-md-5 grid-item mx-auto" data-href="{{ url('/attendance') }}">Attendance</div>
            <div class="col-md-5 grid-item mx-auto" data-href="{{ route('teacher.notes') }}">Notes</div>
        </div>
        <div class="row">
            <div class="col-md-5 grid-item mx-auto" data-href="{{ route('teacher.assignment') }}">Assignment</div>
            <div class="col-md-5 grid-item mx-auto" data-href="{{ url('/communication') }}">Communication</div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.grid-item').forEach(item => {
            item.addEventListener('click', () => {
                const targetPage = item.getAttribute('data-href');
                if (targetPage) {
                    window.location.href = targetPage;
                }
            });
        });
        function toggleSidebar() {
            const sidebar = document.querySelector('.section');
            const backButton = document.querySelector('.back-btn');
            if (sidebar.style.display === 'block') {
                sidebar.style.display = 'none';
                backButton.style.display = 'none';
            } else {
                sidebar.style.display = 'block';
                backButton.style.display = 'block';
            }
        }

        function closeSidebar() {
            const sidebar = document.querySelector('.section');
            const backButton = document.querySelector('.back-btn');
            sidebar.style.display = 'none';
            backButton.style.display = 'none';
        }

        function filterItems() {
            const searchValue = document.getElementById("search-bar").value.toLowerCase();
            const gridItems = document.querySelectorAll(".grid-item");

            gridItems.forEach(item => {
                const itemName = item.textContent.toLowerCase();
                if (itemName.includes(searchValue)) {
                    item.style.display = "block";
                } else {
                    item.style.display = "none";
                }
            });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
