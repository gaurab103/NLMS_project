<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Portal</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .box {
            padding: 20px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 20px;
            background-color: rgba(216, 225, 229, 0.3);
            box-shadow: 0px 4px 8px rgb(0, 0, 0, 0.1);
            transition: transform 0.2s ease;
        }

        .box:hover {
            transform: scale(1.05);
        }

        .box i {
            font-size: 40px;
            margin-bottom: 15px;
        }

        .d-flex {
            gap: 10px;
        }

        #insrch {
            display: none;
        }

        aside {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #ffffff;
            z-index: 1000;
            padding: 20px;
            box-shadow: 2px 0px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        aside ul {
            list-style: none;
            padding: 0;
        }

        aside ul li {
            margin: 15px 0;
            text-align: center;
        }

        aside ul li a {
            text-decoration: none;
            color: #000;
            font-size: 18px;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.2s ease;
            z-index: 1;
        }

        aside ul li a:hover {
            background-color: #ddd;
        }

        .logout {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            width: calc(100% - 40px);
            text-align: center;
        }

        .logout button {
            width: 100%;
            padding: 10px;
            background-color: #dc3545;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            transition: background-color 0.2s ease;
        }

        .logout button:hover {
            background-color: #c82333;
        }

        main {
            margin-left: 270px;
            transition: margin-left 0.3s ease;
        }

        a:hover {
            text-decoration: none;
        }

        header nav {
            height: 60px;
            padding: 0;
        }

        header nav .container-fluid {
            align-items: center;
        }

        header nav .navbar-brand img {
            max-height: 40px;
        }

        header nav input {
            height: 38px;
        }

        header nav button {
            height: 38px;
        }

        main div nav div {
            background-image:
                linear-gradient(to right, rgb(173, 80, 80), rgb(230, 12, 12), rgb(179, 42, 42)),
                url('{{ asset('pics/std.png') }}');
            background-size: cover, contain;
            background-position: left, right;
            background-repeat: no-repeat, no-repeat;
            background-blend-mode: overlay;
            height: 100px;
            border-radius: 10px;
        }

        /* Mobile Toggle Button Styles */
        .mobile-toggle {
            display: none;
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 1100;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 8px 12px;
            cursor: pointer;
        }

        .mobile-toggle i {
            font-size: 20px;
            color: #333;
        }

        /* Profile Page Styling */
        .container {
            max-width: 900px;
            margin-top: 20px;
        }

        .profile img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin-right: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        table th,
        table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        table th {
            background-color: #4CAF50;
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        aside .box {
            width: 100%;
            max-width: 250px;
            margin-bottom: 10px;
            padding: 0px;
            background-color: transparent;
        }

        aside .box h6 {
            font-size: 14px;
            display: inline;
        }

        aside .box i {
            font-size: 14px;
            display: inline;
        }

        /* Responsive Styles */
        @media (max-width: 900px) {
            .mobile-toggle {
                display: block;
            }

            aside {
                transform: translateX(-100%);
            }

            aside.open {
                transform: translateX(0);
            }

            main {
                margin-left: 0;
            }
        }

        @media (max-width: 768px) {
            aside .box {
                width: 100%;
                max-width: none;
            }
        }
    </style>
</head>

<body>
    <button class="mobile-toggle">
        <i class="fas fa-bars"></i>
    </button>

    <aside>
        <ul>
            <div class="col-md-4 box" data-title="Profile">
                <i class="fas fa-user"></i>
                <h6>Profile</h6>
            </div>
            <div class="col-md-4 box" data-title="Attendance">
                <i class="fas fa-calendar-check"></i>
                <h6>Attendance</h6>
            </div>
            <div class="col-md-4 box" data-title="Notes">
                <i class="fas fa-file-alt"></i>
                <h6>Notes</h6>
            </div>
            <div class="col-md-4 box" data-title="Assignments">
                <i class="fas fa-book"></i>
                <h6>Assignments</h6>
            </div>
            <div class="col-md-4 box" data-title="Subjects">
                <i class="fas fa-chalkboard-teacher"></i>
                <h6>Subjects</h6>
            </div>
            <div class="col-md-4 box" data-title="News">
                <i class="fas fa-newspaper"></i>
                <h6>News</h6>
            </div>
        </ul>
        <form action="{{ route('student.logout') }}" method="POST" class="inline">
            @csrf
            <div class="col-md-4 box">
                <button type="submit" class="btn btn-danger w-100">Logout</button>
            </div>
        </form>
    </aside>

    <main>
        <header>
            <nav class="navbar navbar-expand-lg bg-warning">
                <div class="container-fluid">
                    <a href="/" class="navbar-brand">
                        <img src="{{ asset('pics/logo.png') }}" alt="Logo">
                    </a>
                    <div class="d-flex">
                        <input id="insrch" type="search" class="form-control me-2" aria-label="Search"
                            style="display:none;">
                        <button id="btsrch" class="btn btn-outline-success" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    <div class="ml-auto">
                        <img id="studentPhoto" src="{{ Auth::guard('student')->user()->photo }}" alt="Student Photo"
                            style="height: 40px; width: 40px; border-radius: 50%;">
                    </div>
                </div>
            </nav>
        </header>

        <div>
            <nav class="navbar bg-body-tertiary">
                <div style="width: 800px;" class="container-fluid">
                    <a style="color: white;" class="navbar-brand" href="">
                        Welcome, {{ Auth::guard('student')->user()->name }}
                    </a>
                </div>
            </nav>
        </div>

        <div id="profileContent" class="container mt-4" style="display:none;"></div>

        <div id="contentRow" class="container mt-4">
            <div class="row">
                <div class="col-md-4 box" data-title="Profile">
                    <i class="fas fa-user"></i>
                    <h5>Profile</h5>
                </div>
                <div class="col-md-4 box" data-title="Attendance">
                    <i class="fas fa-calendar-check"></i>
                    <h5>Attendance</h5>
                </div>
                <div class="col-md-4 box" data-title="Notes">
                    <i class="fas fa-file-alt"></i>
                    <h5>Notes</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 box" data-title="Assignments">
                    <i class="fas fa-book"></i>
                    <h5>Assignments</h5>
                </div>
                <div class="col-md-4 box" data-title="Subjects">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <h5>Subjects</h5>
                </div>
                <div class="col-md-4 box" data-title="News">
                    <i class="fas fa-newspaper"></i>
                    <h5>News</h5>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Mobile Toggle Functionality
        document.querySelector('.mobile-toggle').addEventListener('click', function () {
            document.querySelector('aside').classList.toggle('open');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function (e) {
            const aside = document.querySelector('aside');
            const toggleBtn = document.querySelector('.mobile-toggle');

            if (window.innerWidth <= 900 &&
                aside.classList.contains('open') &&
                !aside.contains(e.target) &&
                !toggleBtn.contains(e.target)) {
                aside.classList.remove('open');
            }
        });

        // Search functionality
        document.getElementById('btsrch').addEventListener('click', function () {
            document.getElementById('insrch').style.display = "block";
            this.style.display = "none";
        });

        document.getElementById('insrch').addEventListener('blur', function () {
            document.getElementById('btsrch').style.display = "block";
            this.style.display = "none";
        });

        document.addEventListener('click', function (e) {
            const searchBox = document.getElementById('insrch');
            const searchBut = document.getElementById('btsrch');
            const isClickout = !searchBox.contains(e.target) && !searchBut.contains(e.target);

            if (isClickout) {
                searchBox.value = "";
                searchBox.style.display = "none";
                searchBut.style.display = "block";

                document.querySelectorAll('.box').forEach(function (box) {
                    box.style.display = "block";
                });
            }
        });

        document.getElementById('insrch').addEventListener('keyup', function () {
            var srch = this.value.toLowerCase();
            var boxes = document.querySelectorAll('.box');
            boxes.forEach(function (box) {
                var title = box.getAttribute('data-title').toLowerCase();
                box.style.display = title.includes(srch) ? 'block' : 'none';
            });
        });

        // Navigation functionality
        document.querySelectorAll('.box[data-title="Profile"], aside [data-title="Profile"]').forEach(element => {
            element.addEventListener('click', () => {
                showSectionContent('profile', '/student/profile');
                if (window.innerWidth <= 900) {
                    document.querySelector('aside').classList.remove('open');
                }
            });
        });

        document.querySelectorAll('.box[data-title="Attendance"]').forEach(box => {
            box.addEventListener('click', () => {
                showSectionContent('attendance', '/student/attendance');
                if (window.innerWidth <= 900) {
                    document.querySelector('aside').classList.remove('open');
                }
            });
        });

        document.querySelectorAll('.box[data-title="Notes"]').forEach(box => {
            box.addEventListener('click', () => {
                showSectionContent('notes', '/student/notes');
                if (window.innerWidth <= 900) {
                    document.querySelector('aside').classList.remove('open');
                }
            });
        });

        document.querySelectorAll('.box[data-title="Assignments"]').forEach(box => {
            box.addEventListener('click', () => {
                showSectionContent('assignments', '/student/assignments');
                if (window.innerWidth <= 900) {
                    document.querySelector('aside').classList.remove('open');
                }
            });
        });

        document.querySelectorAll('.box[data-title="Subjects"]').forEach(box => {
            box.addEventListener('click', () => {
                showSectionContent('subjects', '{{ route('student.subject') }}');
                if (window.innerWidth <= 900) {
                    document.querySelector('aside').classList.remove('open');
                }
            });
        });

        document.querySelectorAll('.box[data-title="News"]').forEach(box => {
            box.addEventListener('click', () => {
                showSectionContent('news', '{{ route('student.news') }}');
                if (window.innerWidth <= 900) {
                    document.querySelector('aside').classList.remove('open');
                }
            });
        });

        function showSectionContent(section, url) {
            document.getElementById('contentRow').style.display = 'none';
            const profileContent = document.getElementById('profileContent');
            profileContent.style.display = 'block';

            fetch(url)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.text();
                })
                .then(htmlContent => {
                    profileContent.innerHTML = htmlContent;
                })
                .catch(error => {
                    console.error(`Error fetching ${section} content:`, error);
                    profileContent.innerHTML =
                        `<p>Error loading ${section} content. Please try again later.</p>`;
                });
        }
    </script>
</body>

</html>
