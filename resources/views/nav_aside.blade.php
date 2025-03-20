<!-- nav_aside.blade.php -->
<aside class="sidebar" id="sidebar">
    <a href="{{ route('admin.dashboard') }}" id="dashboardLink">
        <i class="fas fa-tachometer-alt"></i> Dashboard
    </a>
    <a href="{{ route('students.index') }}" id="studentsLink">
        <i class="fas fa-user-graduate"></i> Manage Students
    </a>
    <a href="{{ route('teachers.index') }}" id="teachersLink">
        <i class="fas fa-chalkboard-teacher"></i> Manage Teachers
    </a>
    <a href="{{ route('admin.attendance') }}" id="attendanceLink">
        <i class="fas fa-calendar-check"></i> Attendance
    </a>
    <a href="{{ route('classes.index') }}" id="classLink">
        <i class="fa-solid fa-landmark"></i> Manage Class
    </a>
    <a href="{{ route('news.index') }}" id="newsLink">
        <i class="fas fa-newspaper"></i> News & Notices
    </a>
    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fas fa-sign-out-alt"></i> Logout
    </a>
    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</aside>

<nav class="header" id="mainHeader">
    <button class="btn btn-dark d-md-none" id="toggleSidebar" aria-label="Toggle Sidebar">
        <i class="fas fa-bars"></i>
    </button>
    <div class="logo">
        <img src="{{ asset('images/logo.png') }}" alt="Admin Logo" width="60">
    </div>
    <div class="search-bar">
        <i class="fas fa-search" id="searchIcon" role="button" aria-label="Search"></i>
        <input type="text" id="searchInput" placeholder="Search...">
    </div>
</nav>

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
        transition: left 0.3s ease;
        z-index: 1000;
    }
    .sidebar a {
        color: #ecf0f1;
        text-decoration: none;
        padding: 15px 20px;
        display: flex;
        align-items: center;
        font-size: 18px;
        border-left: 4px solid transparent;
        transition: all 0.3s ease;
    }
    .sidebar a i {
        margin-right: 10px;
    }
    .sidebar a:hover {
        background-color: #34495e;
        border-left: 4px solid #ffcc00;
        color: aliceblue;
        text-decoration: none;
    }
    .sidebar a.active {
        background-color: #4093e7;
        border-left: 4px solid #ffcc00;
    }
    .header {
        background-color: #ffcc00;
        padding: 15px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-radius: 8px;
        margin-left: 250px;
        transition: margin-left 0.3s ease;
    }
    .search-bar {
        display: flex;
        align-items: center;
        position: relative;
    }
    .search-bar input {
        display: none;
        border: none;
        border-radius: 20px;
        padding: 5px 10px;
        outline: none;
        transition: width 0.3s ease;
        font-size: 16px;
    }
    .search-bar input.active {
        display: block;
        width: 200px;
    }
    .search-bar i {
        cursor: pointer;
    }
    @media (max-width: 768px) {
        .sidebar {
            left: -250px;
            transition: left 0.3s ease;
        }
        .sidebar.visible {
            left: 0;
        }
        .header {
            margin-left: 0;
        }
    }
</style>

<script>
    // Define searchBar for the search functionality
    const searchBar = document.querySelector('.search-bar');

    // Sidebar toggle for mobile devices
    const toggleSidebar = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('sidebar');
    toggleSidebar.addEventListener('click', () => {
        sidebar.classList.toggle('visible');
    });

    // Highlight the active link based on current URL
    const currentPage = window.location.pathname;
    document.querySelectorAll('.sidebar a').forEach(link => {
        if (link.href.includes(currentPage)) {
            link.classList.add('active');
        }
    });

    // Search functionality: show/hide input on icon click
    const searchIcon = document.getElementById('searchIcon');
    const searchInput = document.getElementById('searchInput');
    searchIcon.addEventListener('click', function() {
        searchInput.classList.toggle('active');
        searchInput.focus();
    });

    // Hide search input when clicking outside
    document.addEventListener('click', function(event) {
        if (!searchBar.contains(event.target) && event.target !== searchIcon) {
            searchInput.classList.remove('active');
        }
    });

    // Optional: Close sidebar when a link is clicked on mobile
    document.querySelectorAll('.sidebar a').forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth <= 768) {
                sidebar.classList.remove('visible');
            }
        });
    });
</script>
