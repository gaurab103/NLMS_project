<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* General Styles */
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
            display: block; /* Always visible on large screens */
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
        .card-header {
            font-size: 1.5rem;
            text-align: center;
        }
        /* Sidebar and back button styles */
        .mobile-menu-btn, .back-btn {
            display: none; /* Hidden by default */
            margin: 15px;
            background-color: #5e5d5d;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
        }

        /* Show the sidebar button and back button only on mobile */
        @media (max-width: 768px) {
            body {
                margin-left: 0; /* Remove sidebar margin on mobile */
            }
            .section {
                display: none; /* Hide sidebar by default on mobile */
            }
            .mobile-menu-btn {
                display: block; /* Show menu button on small screens */
                margin-left: 3px;
            }
            .navbar .navbar-brand {
                font-size: 15px;
                font-weight: bold;
                margin-right: 25px;
            }
            .back-btn {
                display: block; /* Show back button on small screens */
            }
        }

        /* Hide mobile button and back button on large screens */
        @media (min-width: 769px) {
            .mobile-menu-btn {
                display: none; /* Hide menu button on large screens */
            }
            .back-btn {
                display: none; /* Hide back button on large screens */
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="navbar">
            <div class="container d-flex align-items-center justify-content-between">
                <img src="/image/IMG_5209-removebg-preview.png" alt="Logo">
                <a class="navbar-brand" href="#">Naragram Learning Management System</a>
            </div>
        </div>
    </header>
    
    <!-- Mobile menu button -->
    <button class="btn btn-primary mobile-menu-btn" onclick="toggleSidebar()">☰</button>

    <!-- Sidebar Section -->
    <div class="section">
        <!-- Back Button for Mobile -->
        <button class="back-btn" onclick="closeSidebar()">&#60;</button>
        <a href="{{route ('teacher.dashboard')}}" aria-label="Home">Home</a>
        <a href="#" aria-label="Attendance">Attendance</a>
        <a href="#" aria-label="Attendance" style="background-color: #007bff; color:white;">Notes</a>
        <a href="{{route ('teacher.assignment')}}" aria-label="Assignment">Assignments</a>
        <a href="#" aria-label="Communication">Communication</a>
    </div>

    <div class="container">
        <div class="header text-center">
            <h1>Notes</h1>
        </div>
        <nav class="nav justify-content-center">
            <a class="nav-link" href="#" onclick="showTeacherNotes()">Add Notes</a>
            <a class="nav-link" href="#" onclick="showStudentNotes()">View Notes</a>
        </nav>
        
        <!-- Teacher's Notes Section -->
        <div id="teacher-notes" class="card d-none">
            <div class="card-header bg-primary text-white">Upload Teacher's Notes</div>
            <div class="card-body">
                <form id="teacher-notes-form">
                    <div class="mb-3">
                        <label for="note-title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="note-title" placeholder="Enter note title" required>
                    </div>
                    <div class="mb-3">
                        <label for="note-file" class="form-label">Upload File</label>
                        <input type="file" class="form-control" id="note-file" required>
                    </div>
                    <button type="submit" class="btn btn-success">Upload Notes</button>
                </form>
            </div>
        </div>

        <!-- Student's Notes Section -->
        <div id="student-notes" class="card">
            <div class="card-header bg-success text-white">View Notes</div>
            <div class="card-body">
                <div id="available-notes">
                    <!-- Notes will appear here -->
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle the visibility of Teacher and Student notes
        function showTeacherNotes() {
            document.getElementById('teacher-notes').classList.remove('d-none');
            document.getElementById('student-notes').classList.add('d-none');
        }

        function showStudentNotes() {
            document.getElementById('teacher-notes').classList.add('d-none');
            document.getElementById('student-notes').classList.remove('d-none');
            loadStudentNotes();
        }

        // Mock data for student notes
        const notes = [
            { title: 'Math Slides', file: 'math_slides.pdf' },
            { title: 'Science Document', file: 'science_notes.docx' },
            { title: 'History PPT', file: 'history_presentation.pptx' }
        ];

        // Function to load and display student notes
        function loadStudentNotes() {
            const container = document.getElementById('available-notes');
            container.innerHTML = '';
            notes.forEach(note => {
                const card = document.createElement('div');
                card.className = 'card mb-3';
                card.innerHTML = `
                    <div class="card-body">
                        <h5 class="card-title">${note.title}</h5>
                        <p class="card-text">Click below to download the file.</p>
                        <a href="/path/to/${note.file}" class="btn btn-primary" download>Download ${note.file}</a>
                    </div>
                `;
                container.appendChild(card);
            });
        }

        // Handle note upload by the teacher
        document.getElementById('teacher-notes-form').addEventListener('submit', function(event) {
            event.preventDefault();
            const title = document.getElementById('note-title').value;
            const file = document.getElementById('note-file').files[0];
            if (title && file) {
                alert(`Note titled "${title}" uploaded successfully!`);
                document.getElementById('teacher-notes-form').reset();
                // Optionally, update the student notes section or backend here
            } else {
                alert('Please fill in both fields.');
            }
        });

        // Toggle sidebar visibility
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
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
