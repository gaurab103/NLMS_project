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
            margin-left: 0;
            overflow-y: 0;
            background-color: #f8f9fa;
        }
        .search {
            position: absolute;
            top: 20px;
            right: 10%;
        }

        /* Adjust search bar and button */
        .search form {
            display: flex;
            align-items: center;
        }

        .search .form-control {
            width: 200px;
            transition: width 0.3s ease-in-out;
        }

        /* Expand search bar when focused */
        .search .form-control:focus {
            width: 250px;
        }
        
        .box {
            border-radius: 25px;
            background: red;
            padding: 20px;
            margin-top: 50px;
            margin-left: 20%;
            width: 70%;
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
            margin: 30px 15%;
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
        
        .mobile-menu-btn {
            display: none;
            margin: 15px;
            background-color: #5e5d5d;
        }
        .back-btn {
            display: none;
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
                margin-left: 0;
        }
        .grid-container {
            margin: 30px 7%;
            width: 85%;
        }
        .search {
            position: relative;
            left: 20%;
        }
    }
    </style>
</head>
<body>
    @include('navteacher', ['active' => 'home'])

    <div class="search">    
        <form class="d-flex" role="search" onsubmit="event.preventDefault(); filterItems()">
            <input id="search-bar" class="form-control me-2" type="search" placeholder="Search by name" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        
    </div>
            
    <div class="box">
        <h1>Welcome Teacher</h1>
        <img src="{{ asset('images/teacherportal.png') }}" alt="Teacher">
    </div>
    <div class="grid-container">
        <div class="row">
            <div class="col-md-5 grid-item mx-auto" data-href="{{ route('teacher.attendance') }}">Attendance</div>
            <div class="col-md-5 grid-item mx-auto" data-href="{{ route('teacher.notes') }}">Notes</div>
        
            <div class="col-md-5 grid-item mx-auto" data-href="{{ route('assignments.index') }}">Assignment</div>
            <div class="col-md-5 grid-item mx-auto" data-href="{{ url('/teacher.news') }}">News</div>
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

    



<script>
    

    function closeSidebar() {
        const sidebar = document.querySelector('.section');
        const backButton = document.querySelector('.back-btn');
        sidebar.style.display = 'none';
        backButton.style.display = 'none';
    }
</script>
