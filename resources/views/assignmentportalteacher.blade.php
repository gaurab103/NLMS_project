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
        .card{
            margin-left: 15%;
            margin-right: 15%;
        }
        .std button{
            color: white;
            border-radius: 5px;
            stroke: white;
            width: 150px;
            background-color: red;
            margin-top: 1%;
            margin-left: 45%;
        }
        button:hover{
            background-color: rgb(141, 3, 3);
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
                <img src="{{ asset('images/logo.png') }}" alt="Logo">
                <a class="navbar-brand" href="#">Naragram Learning Management System</a>
            </div>
        </div>
    </header>
    <button class="btn btn-primary mobile-menu-btn" onclick="toggleSidebar()">☰</button>
    <div class="section">
        <button class="back-btn" onclick="closeSidebar()"><</button>
        <a href="{{ route('teacher.dashboard')}}" aria-label="Home">Home</a>
        <a href="#" aria-label="Attendance">Attendance</a>
        <a href="{{route('teacher.notes') }}" aria-label="Notes">Notes</a>
        <a  aria-label="Assignments" style="background-color: #007bff; color:white;">Assignments</a>
        <a href="#" aria-label="Communication">Communication</a>
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
      <i class="fas fa-sign-out-alt"></i> Logout
    </a>
    <!-- Hidden logout form -->
    <form id="logout-form" action="{{ route('teacher.logout') }}" method="POST" style="display: none;">
      @csrf
    </form>
    </div>
    <div class="container">
        <div class="header text-center">
            <h1>Assignment Portal</h1>
        </div>
            <nav class="nav justify-content-center">
                <a class="nav-link" href="#" onclick="showCreateAssignment()">Add Assignment</a>
                <a class="nav-link" href="#" onclick="showViewAssignments()">View Submissions</a>
            </nav>
        </div>
        <!-- Create Assignment Section -->
        <div id="create-assignment" class="card">
            <div class="card-header text-white" style="background-color: red;">Create Assignment</div>
            <div class="card-body">
                <form id="assignment-form">
                    <div class="mb-3">
                        <label for="class" class="form-label">Class</label>
                        <select class="form-select" id="class" required>
                            <option value="">Select Class</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject</label>
                        <input type="text" class="form-control" id="subject" placeholder="Enter Subject" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Assignment Description</label>
                        <textarea class="form-control" id="description" rows="3" placeholder="Enter assignment details..." required></textarea>
                    </div>
                    <button type="submit" class="btn" style="background-color: red; color:white">Save Assignment</button>
                </form>
            </div>
        </div>

        <!-- View Assignments Section -->
        <div id="view-assignments" class="card d-none">
            <div class="card-header bg-success text-white">Submitted Assignments</div>
            <div class="card-body">
                <div id="submitted-assignments">
                    <!-- Submitted Assignments will appear here -->
                </div>
            </div>
        </div>
    </div>
    <div class="std">
    <button onclick="window.location.href='/assignmentportalstudent.html'">view as student</button>
</div>

    
    <script>
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
         // Show create assignment section
         function showCreateAssignment() {
            document.getElementById('create-assignment').classList.remove('d-none');
            document.getElementById('view-assignments').classList.add('d-none');
        }

        // Show view assignments section
        function showViewAssignments() {
            document.getElementById('create-assignment').classList.add('d-none');
            document.getElementById('view-assignments').classList.remove('d-none');
            loadSubmittedAssignments();
        }

        // Mock data for submitted assignments
        const submittedAssignments = [
            { student: 'John Doe', assignment: 'Math Homework', class: '8' },
            { student: 'Jane Smith', assignment: 'Science Project', class: '9' },
            { student: 'Alice Johnson', assignment: 'History Essay', class: '10' }
        ];

        // Function to load submitted assignments
        function loadSubmittedAssignments() {
            const container = document.getElementById('submitted-assignments');
            container.innerHTML = '';
            submittedAssignments.forEach(submission => {
                const card = document.createElement('div');
                card.className = 'card mb-3';
                card.innerHTML = `
                    <div class="card-body">
                        <h5 class="card-title">Student: ${submission.student}</h5>
                        <p class="card-text">Assignment: ${submission.assignment}</p>
                        <p class="card-text">Class: ${submission.class}</p>
                    </div>
                `;
                container.appendChild(card);
            });
        }

        // Save assignment
        document.getElementById('assignment-form').addEventListener('submit', event => {
            event.preventDefault();
            alert('Assignment saved successfully!');
            document.getElementById('assignment-form').reset();
        });

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
