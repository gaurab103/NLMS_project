<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="view-transition" content="same-origin">
    <script src="node_modules/swup/dist/swup.main.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Login</title>
    <style>
        body {
            background-color: #e4f1fe;
            display: flex;
            justify-content: center; /* Horizontal centering */
            align-items: center;    /* Vertical centering */
            flex-wrap: wrap;        /* Allow wrapping of cards for smaller screens */
            height: 100vh;
            margin: 0;
        }

        .card {
            width: 15rem;
            margin: 10px; /* Small gap between cards */
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease-in-out;
        }

        .card:hover {
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        .card img {
            width: 100%;
            height: auto;
            transition: transform 0.3s ease-in-out;
        }

        .card img:hover {
            transform: scale(1.1);
        }

        .card-body {
            padding: 10px;
            text-align: center;
        }

        .card-text {
            font-size: 1rem;
            color: #333;
        }

        a {
            text-decoration: none;
        }

        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }

        .marquee {
            display: flex;
            justify-content: center;
            overflow: hidden;
            width: 100%;
        }

        .marquee-content {
            display: inline-block;
            white-space: nowrap;
            animation: marquee 15s linear infinite;
        }

        @keyframes marquee {
            0% {
                transform: translateX(50%);
            }
         
        }

        @media (max-width: 768px) {
    .card {
        width: 12rem; /* Adjust card width for medium devices */
        margin: 8px 4px; /* Reduce vertical and horizontal gaps */
    }
}

            .card-text {
                font-size: 0.9rem;
            }

            footer {
                font-size: 0.8rem;
            }
        }

        @media (max-width: 480px) {
    .card {
        width: 10rem; /* Adjust card width for small devices */
        margin: 5px 2px; /* Further reduce gaps for smaller screens */
    }
}

            .card-text {
                font-size: 0.8rem;
            }

            footer {
                font-size: 0.7rem;
            }
        }
    </style>
</head>
<body class="transition-fade">

<a href="loginpage">
    <div class="card">
        <img src="/images/pannel/admin.jpg" class="card-img-top" alt="Admin">
        <div class="card-body">
            <p class="card-text">Login as ADMIN</p>
        </div>
    </div>
</a>
<a href="loginpage">
    <div class="card">
        <img src="/images/pannel/teacher.png" class="card-img-top" style="margin-top: 25px;" alt="Teacher">
        <div class="card-body">
            <p class="card-text">Login as Teacher</p>
        </div>
    </div>
</a>
<a href="loginpage">
    <div class="card">
        <img src="/images/pannel/students.png" class="card-img-top" style="margin-top: 26px;" alt="Student">
        <div class="card-body">
            <p class="card-text">Login as Student</p>
        </div>
    </div>
</a>

<footer>
    <div class="marquee">
        <div class="marquee-content">
            Naragram Learning Management System&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Naragram Learning Management System&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Naragram Learning Management System&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Naragram Learning Management System&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Naragram Learning Management System&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Naragram Learning Management System&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Naragram Learning Management System&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Naragram Learning Management System&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Naragram Learning Management System&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Naragram Learning Management System&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Naragram Learning Management System&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Naragram Learning Management System&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Naragram Learning Management System&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Naragram Learning Management System&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Naragram Learning Management System&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Naragram Learning Management System&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Naragram Learning Management System&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Naragram Learning Management System&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Naragram Learning Management System&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Naragram Learning Management System&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Naragram Learning Management System&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Naragram Learning Management System&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </div>
    </div>
</footer>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const anchors = document.querySelectorAll("a");
        const body = document.body;

        anchors.forEach(anchor => {
            anchor.addEventListener("click", event => {
                event.preventDefault();
                const href = anchor.getAttribute("href");

                body.classList.add("is-animating");

                setTimeout(() => {
                    window.location.href = href;
                }, 500);
            });
        });
    });
</script>
</body>
</html>
