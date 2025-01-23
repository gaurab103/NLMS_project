
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* Add your styles here */
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
        <a href="{{ url('/notesteacher') }}" aria-label="Notes">Notes</a>
        <a href="{{ url('/assignmentportalteacher') }}" aria-label="Assignments">Assignments</a>
        <a href="#" aria-label="Communication">Communication</a>
    </div>
    <div class="box">
        <h1>Welcome Teacher</h1>
        <img src="{{ asset('image/png-transparent-man-holding-white-chalk-standing-n-removebg-preview.png') }}" alt="Teacher">
    </div>
    <div class="grid-container container">
        <div class="row">
            <div class="col-md-5 grid-item mx-auto" data-href="{{ url('/attendance') }}">Attendance</div>
            <div class="col-md-5 grid-item mx-auto" data-href="{{ url('/notesteacher') }}">Notes</div>
        </div>
        <div class="row">
            <div class="col-md-5 grid-item mx-auto" data-href="{{ url('/assignmentportalteacher') }}">Assignment</div>
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
