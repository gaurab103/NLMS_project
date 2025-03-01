<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>NLMS Portal</title>
    <style>
        :root {
            --primary-color: #3A2B5E;
            --accent-color: #FFC107;
            --background-1: #F8F9FA;
            --background-2: #E9ECEF;
        }

        body {
            min-height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            overflow-x: hidden;
            background: linear-gradient(135deg, var(--background-1), var(--background-2));
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .logo-container {
            background: rgba(255,255,255,0.9);
            padding: 1.5rem;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            margin: 2rem 0;
            animation: logoEntrance 0.8s ease;
        }

        .school-logo {
            height: 90px;
            filter: drop-shadow(0 2px 4px rgba(58,43,94,0.2));
        }

        @keyframes logoEntrance {
            from { transform: translateY(-50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .cards-container {
            display: flex;
            justify-content: center;
            gap: 2rem;
            flex-wrap: wrap;
            padding: 2rem;
            max-width: 1200px;
            width: 100%;
        }

        .login-card {
            width: 280px;
            background: white;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 6px 20px rgba(0,0,0,0.08);
            position: relative;
        }

        .login-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.12);
        }

        .card-image {
            height: 180px;
            position: relative;
            overflow: hidden;
            background: var(--primary-color);
        }

        .card-image img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 1.5rem;
            transition: transform 0.3s ease;
        }

        .login-card:hover .card-image img {
            transform: scale(1.05);
        }

        .card-body {
            padding: 1.5rem;
            text-align: center;
            background: white;
        }

        .card-title {
            font-size: 1.3rem;
            color: var(--primary-color);
            margin: 0;
            font-weight: 600;
            position: relative;
        }

        .card-title::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 40px;
            height: 3px;
            background: var(--accent-color);
            transition: width 0.3s ease;
        }

        .login-card:hover .card-title::after {
            width: 80px;
        }

        .marquee-container {
            position: fixed;
            bottom: 0;
            width: 100%;
            background: var(--primary-color);
            padding: 12px 0;
            overflow: hidden;
        }

        .marquee-content {
            display: inline-block;
            white-space: nowrap;
            animation: marqueeScroll 20s linear infinite;
            color: white;
            font-size: 1rem;
            font-weight: 500;
            padding-left: 100%;
        }

        .marquee-text {
            display: inline-block;
            padding-right: 40px;
        }

        .marquee-text::after {
            content: "•";
            margin: 0 20px;
            color: var(--accent-color);
        }

        @keyframes marqueeScroll {
            0% { transform: translateX(0); }
            100% { transform: translateX(-100%); }
        }

        @media (max-width: 768px) {
            .cards-container {
                padding: 1rem;
                gap: 1.5rem;
            }

            .login-card {
                width: 260px;
            }

            .logo-container {
                padding: 1rem;
                margin: 1.5rem 0;
            }

            .school-logo {
                height: 80px;
            }
        }

        @media (max-width: 480px) {
            .login-card {
                width: 90%;
            }

            .card-image {
                height: 160px;
            }

            .card-title {
                font-size: 1.2rem;
            }
        }
    </style>
</head>

<body>
    <div class="logo-container">
        <img src="{{ asset('images/logo/logo.png') }}" alt="School Logo" class="school-logo">
    </div>

    <div class="cards-container">
        <a href="{{ route('admin.login') }}" class="login-card">
            <div class="card-image">
                <img src="/images/pannel/admin.jpg" alt="Admin">
            </div>
            <div class="card-body">
                <h3 class="card-title">Admin Portal</h3>
            </div>
        </a>

        <a href="{{ route('teacher.login') }}" class="login-card">
            <div class="card-image">
                <img src="/images/pannel/teacher.png" alt="Teacher">
            </div>
            <div class="card-body">
                <h3 class="card-title">Teacher Portal</h3>
            </div>
        </a>

        <a href="{{ route('student.login') }}" class="login-card">
            <div class="card-image">
                <img src="/images/pannel/students.png" alt="Student">
            </div>
            <div class="card-body">
                <h3 class="card-title">Student Portal</h3>
            </div>
        </a>
    </div>

    <div class="marquee-container">
        <div class="marquee-content">
            <span class="marquee-text">Naragram Learning Management System</span>
            <span class="marquee-text">Naragram Learning Management System</span>
            <span class="marquee-text">Naragram Learning Management System</span>
            <span class="marquee-text">Naragram Learning Management System</span>
        </div>
    </div>

    <script>
        // Add hover class for mobile touch
        document.querySelectorAll('.login-card').forEach(card => {
            card.addEventListener('touchstart', () => {
                card.classList.add('hover');
                setTimeout(() => card.classList.remove('hover'), 500);
            });
        });
    </script>
</body>
</html>
