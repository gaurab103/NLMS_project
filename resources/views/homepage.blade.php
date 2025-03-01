<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Shree Naragram Secondary School - Providing quality education since 1947">
    <title>Shree Naragram Secondary School</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --primary-color: rgb(255, 255, 255);
            --accent-color: rgb(255, 247, 24);
            --hover-color: rgb(255, 0, 0);
            --secondary-color: rgb(0, 0, 0);
            --light-gray: #f8f9fa;
            --text-dark: #333;
            --text-light: #f8f9fa;
            --box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #fbfbfd;
            color: var(--text-dark);
        }

        .section-padding {
            padding: 5rem 0;
        }

        /* Navbar Styles */
        .navbar {
            background: linear-gradient(135deg, var(--accent-color), var(--hover-color));
            padding: 0.8rem;
            transition: var(--transition);
            z-index: 1000;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .navbar-brand img {
            transition: transform 0.3s ease;
            border-radius: 50%;
            border: 2px solid white;
        }

        .navbar-brand img:hover {
            transform: scale(1.05);
        }

        .heading {
            text-decoration: none;
            font-weight: bold;
            color: black;
            font-size: x-large;
            text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.6);
        }

        .nav-link {
            color: var(--primary-color) !important;
            font-weight: 600;
            position: relative;
            padding: 0.5rem 1rem;
            margin: 0 0.2rem;
            transition: var(--transition);
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 50%;
            background-color: var(--primary-color);
            transition: var(--transition);
        }

        .nav-link:hover::after {
            width: 100%;
            left: 0;
        }

        .nav-link:hover {
            color: var(--accent-color) !important;
            transform: translateY(-2px);
        }

        .login-btn {
            background-color: transparent;
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            font-weight: 600;
            padding: 0.5rem 1.5rem;
            border-radius: 30px;
            transition: var(--transition);
        }

        .login-btn:hover {
            background-color: var(--primary-color);
            color: var(--hover-color);
            transform: translateY(-2px);
        }

        .login-btn a {
            color: inherit;
            text-decoration: none;
        }

        /* Carousel Styles */
        .carousel-container {
            position: relative;
        }

        .carousel-inner {
            border-radius: 0 0 2rem 2rem;
            overflow: hidden;
            box-shadow: var(--box-shadow);
            max-height: 85vh;
        }

        .carousel-inner img {
            height: 85vh;
            object-fit: cover;
            filter: brightness(0.7);
        }

        .carousel-caption {
            bottom: 20%;
            z-index: 10;
        }

        .typewriter {
            font-size: 2.5rem;
            font-weight: bold;
            color: white;
            text-align: center;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1050;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
            animation: fade-in 3s ease-in-out, float 6s ease-in-out infinite;
            width: 90%;
        }

        .explore-btn {
            background-color: var(--accent-color);
            color: var(--secondary-color);
            font-weight: 600;
            padding: 0.75rem 2rem;
            border-radius: 30px;
            border: none;
            margin-top: 1.5rem;
            transition: var(--transition);
            text-decoration: none;
            display: inline-block;
        }

        .explore-btn:hover {
            background-color: var(--hover-color);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translate(-50%, -60%);
            }

            to {
                opacity: 1;
                transform: translate(-50%, -50%);
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translate(-50%, -50%);
            }

            50% {
                transform: translate(-50%, -52%);
            }
        }

        /* About Us Section */
        #abus {
            background: linear-gradient(135deg, #fff, #f8f9fa);
            border-radius: 2rem;
            padding: 3.5rem;
            box-shadow: var(--box-shadow);
            margin-top: 5rem;
        }

        .principal-img {
            position: relative;
            max-width: 250px;
            margin: 0 auto;
        }

        .principal-img img {
            transition: transform 0.5s ease, box-shadow 0.5s ease;
            border: 5px solid var(--accent-color);
            max-width: 100%;
        }

        .principal-img:hover img {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .principal-img::after {
            content: "Principal";
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            background-color: var(--accent-color);
            color: var(--secondary-color);
            padding: 0.3rem 1.5rem;
            border-radius: 20px;
            font-weight: 600;
        }

        .school-info {
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: var(--transition);
        }

        .school-info:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .school-info p {
            margin-bottom: 1rem;
            border-bottom: 1px dashed rgba(0, 0, 0, 0.1);
            padding-bottom: 0.5rem;
        }

        .school-info p:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }

        /* Contact Us Section */
        .contact-title {
            margin-bottom: 3.5rem;
        }

        #cntus {
            display: flex;
            justify-content: center;
            padding: 4rem 2rem;
            background: linear-gradient(135deg, var(--accent-color), var(--hover-color));
            color: white;
            margin-bottom: 2%;
            border-radius: 2rem;
            box-shadow: var(--box-shadow);
        }

        .contact-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 2rem;
            border-radius: 1.5rem;
            text-align: center;
            transition: var(--transition);
        }

        .contact-card:hover {
            transform: translateY(-10px);
            background: rgba(255, 255, 255, 0.2);
        }

        #cntus .fa {
            font-size: 2.5rem;
            color: white;
            margin-bottom: 1.5rem;
            transition: transform 0.3s ease;
            background: rgba(0, 0, 0, 0.2);
            width: 70px;
            height: 70px;
            line-height: 70px;
            border-radius: 50%;
        }

        #cntus .contact-card:hover .fa {
            transform: scale(1.2);
            background: var(--accent-color);
            color: var(--secondary-color);
        }

        /* Get in Touch Section */
        .contact-section {
            background: white;
            padding: 3.5rem;
            border-radius: 2rem;
            box-shadow: var(--box-shadow);
        }

        form input,
        form textarea {
            border-radius: 1rem;
            padding: 1rem;
            border: 2px solid #eee;
            transition: var(--transition);
            font-family: 'Poppins', sans-serif;
        }

        form input:focus,
        form textarea:focus {
            box-shadow: 0 0 0 3px rgba(255, 247, 24, 0.2);
            border-color: var(--accent-color);
        }

        .submit-btn {
            background: linear-gradient(135deg, var(--accent-color), var(--hover-color));
            border: none;
            padding: 1rem 2rem;
            border-radius: 2rem;
            color: white;
            font-weight: 600;
            transition: var(--transition);
            margin-top: 1rem;
        }

        .submit-btn:hover {
            background: linear-gradient(135deg, var(--hover-color), var(--accent-color));
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 0, 0, 0.3);
        }

        iframe {
            border-radius: 1rem;
            box-shadow: var(--box-shadow);
            transition: var(--transition);
            width: 100%;
            height: 100%;
            min-height: 300px;
        }

        iframe:hover {
            transform: scale(1.02);
        }

        /* School Features */
        .features-section {
            padding: 5rem 0;
        }

        .feature-card {
            background: white;
            border-radius: 1.5rem;
            padding: 2rem;
            text-align: center;
            transition: var(--transition);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            font-size: 2.5rem;
            color: var(--hover-color);
            margin-bottom: 1.5rem;
            transition: var(--transition);
            background: rgba(255, 247, 24, 0.2);
            width: 80px;
            height: 80px;
            line-height: 80px;
            border-radius: 50%;
            margin: 0 auto 1.5rem;
        }

        .feature-card:hover .feature-icon {
            background: var(--hover-color);
            color: white;
            transform: rotateY(180deg);
        }

        /* Section Titles */
        .section-title {
            position: relative;
            display: inline-block;
            margin-bottom: 3rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        .section-title::after {
            content: '';
            position: absolute;
            width: 50%;
            height: 4px;
            background: linear-gradient(135deg, var(--accent-color), var(--hover-color));
            bottom: -10px;
            left: 25%;
            border-radius: 10px;
        }

        /* Footer */
        footer {
            background: var(--secondary-color);
            color: white;
            padding: 3rem 0 1.5rem;
            margin-top: 5rem;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            margin-bottom: 2rem;
        }

        .footer-logo {
            margin-bottom: 1rem;
        }

        .footer-links h4 {
            margin-bottom: 1.5rem;
            position: relative;
            display: inline-block;
        }

        .footer-links h4::after {
            content: '';
            position: absolute;
            width: 50%;
            height: 2px;
            background: var(--accent-color);
            bottom: -10px;
            left: 0;
        }

        .footer-links ul {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 0.5rem;
        }

        .footer-links a {
            color: #ccc;
            text-decoration: none;
            transition: var(--transition);
        }

        .footer-links a:hover {
            color: var(--accent-color);
            padding-left: 5px;
        }

        .social-icons {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .social-icons a {
            color: white;
            background: rgba(255, 255, 255, 0.1);
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: var(--transition);
        }

        .social-icons a:hover {
            background: var(--accent-color);
            color: var(--secondary-color);
            transform: translateY(-5px);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 1.5rem;
            text-align: center;
        }

        /* Back to Top Button */
        .back-to-top {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: linear-gradient(135deg, var(--accent-color), var(--hover-color));
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            cursor: pointer;
            z-index: 99;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            transition: var(--transition);
            opacity: 0;
            visibility: hidden;
        }

        .back-to-top.show {
            opacity: 1;
            visibility: visible;
        }

        .back-to-top:hover {
            background: linear-gradient(135deg, var(--hover-color), var(--accent-color));
            transform: translateY(-5px);
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .navbar-brand {
                margin-bottom: 1rem;
            }

            .heading {
                font-size: larger;
            }
        }

        @media (max-width: 768px) {
            .typewriter {
                font-size: 1.8rem;
            }

            .carousel-inner img {
                height: 60vh;
            }

            #abus,
            #cntus,
            .contact-section {
                padding: 2rem;
            }

            .section-padding {
                padding: 3rem 0;
            }

            .principal-img {
                margin-bottom: 2rem;
            }

            .feature-card {
                margin-bottom: 2rem;
            }

            .contact-card {
                margin-bottom: 1.5rem;
            }
        }

        @media (max-width: 576px) {
            .typewriter {
                font-size: 1.5rem;
            }

            .heading {
                font-size: medium;
            }

            .navbar-brand img {
                height: 40px !important;
                width: 40px !important;
            }
        }
    </style>
</head>

<body id="top">
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('images/logo/logo.png') }}" alt="Naragram Logo" style="height: 50px; width: 70px;">
                <span class="heading">Shree Naragram Secondary School</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a href="#top" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="#about" class="nav-link">About Us</a></li>
                    <li class="nav-item"><a href="#features" class="nav-link">Features</a></li>
                    <li class="nav-item"><a href="#contact" class="nav-link">Contact</a></li>
                    <li class="nav-item">
                        <a href="https://www.facebook.com/profile.php?id=100088714107555" target="_blank"
                            class="nav-link">
                            <i class="fab fa-facebook"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <button class="btn login-btn">
                            <a href={{ route('pannel') }}>NLMS Login</a>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Carousel -->
    <div class="carousel-container">
        <div id="schoolCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('images/logo/background.jpg') }}" class="d-block w-100" alt="School Building">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/logo/img.jpg') }}" class="d-block w-100" alt="Students in Classroom">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/logo/img3.jpg') }}" class="d-block w-100" alt="School Event">
                </div>
            </div>
            <div class="typewriter">
                Welcome To Shree Naragram Secondary School
                <br>
                <a href="#about" class="explore-btn">Explore More</a>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#schoolCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#schoolCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <!-- About Us Section -->
    <section id="about" class="section-padding">
        <div class="container">
            <div id="abus">
                <h2 class="text-center section-title">About Our School</h2>
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <div class="principal-img">
                            <img src="{{ asset('images/logo/sir.jpg') }}" class="img-fluid rounded-circle mb-4"
                                alt="Principal">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="school-info">
                            <p><strong>Principal:</strong> Mr. Kailash KC</p>
                            <p><strong>Established:</strong> 1947 AD (2004 BS)</p>
                            <p><strong>Affiliated to:</strong> National Examination Board (NEB)</p>
                            <p><strong>Education Program:</strong> Playground to Grade 10</p>
                            <p><strong>School Vision:</strong> To create a learning environment that fosters academic
                                excellence, personal development, and social responsibility.</p>
                            <p><strong>School Mission:</strong> To provide quality education that empowers students to
                                become responsible, productive, and compassionate citizens.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- School Features Section -->
    <section id="features" class="features-section">
        <div class="container">
            <h2 class="text-center section-title">Why Choose Us</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h4>Quality Education</h4>
                        <p>Our dedicated teachers ensure high-quality education with personalized attention to each
                            student.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <h4>Modern Curriculum</h4>
                        <p>We follow a comprehensive curriculum that focuses on both academic excellence and practical
                            skills.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-microscope"></i>
                        </div>
                        <h4>Well-Equipped Labs</h4>
                        <p>Our school provides modern laboratories for science, computer, and other practical subjects.
                        </p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <h4>Experienced Faculty</h4>
                        <p>Our teachers are well-qualified and experienced in their respective fields.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-futbol"></i>
                        </div>
                        <h4>Sports & Activities</h4>
                        <p>We encourage students to participate in various sports and extracurricular activities.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4>Community Engagement</h4>
                        <p>We actively engage with our community through various programs and social activities.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Us Section -->
    <section id="contact" class="section-padding">
        <div class="container contact-title">
            <h2 class="text-center section-title">Contact Us</h2>
        </div>

        <div id="cntus" class="container">
            <div class="row justify-content-center">
                <div class="col-md-4 mb-4">
                    <div class="contact-card">
                        <i class="fa fa-map-marker-alt"></i>
                        <h4>Our Location</h4>
                        <p>Budhiganga Municipality-1, Morang, Nepal</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="contact-card">
                        <i class="fa fa-envelope"></i>
                        <h4>Email Us</h4>
                        <p>naragramschool2004@gmail.com</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="contact-card">
                        <i class="fa fa-phone-alt"></i>
                        <h4>Call Us</h4>
                        <p>+977-21-420440</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container contact-section">
            <h3 class="text-center section-title">Get In Touch</h3>
            <div class="row">
                <div class="col-md-6">
                    <form id="contactForm" onsubmit="return validateForm()">
                        <div class="mb-3">
                            <input type="text" name="name" id="name" class="form-control"
                                placeholder="Your Name" required>
                        </div>
                        <div class="mb-3">
                            <input type="tel" name="mobile" id="mobile" class="form-control"
                                placeholder="Mobile Number" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" name="email" id="email" class="form-control"
                                placeholder="Email Address" required>
                        </div>
                        <div class="mb-3">
                            <textarea name="message" id="message" class="form-control" placeholder="Your Message" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn submit-btn w-100">
                            <i class="fas fa-paper-plane me-2"></i> Send Message
                        </button>
                    </form>
                </div>
                <div class="col-md-6 mt-4 mt-md-0">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2361.3817192879274!2d87.2774827087924!3d26.521317176786166!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39ef73b844fca2b5%3A0xc4b057eccd897060!2sShree%20Naragram%20Secondary%20School!5e1!3m2!1sen!2snp!4v1737782909920!5m2!1sen!2snp"
                        loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="School Location"></iframe>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="col-md-4 mb-4">
                    <div class="footer-logo">
                        <img src="{{ asset('images/logo/logo.png') }}" alt="Naragram Logo"
                            style="height: 60px; width: 60px; border-radius: 50%;">
                    </div>
                    <p>Shree Naragram Secondary School has been providing quality education to students since 1947, with
                        a commitment to excellence and holistic development.</p>
                    <div class="social-icons">
                        <a href="https://www.facebook.com/profile.php?id=100088714107555" target="_blank"><i
                                class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="col-md-3 mb-4 footer-links">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="#top">Home</a></li>
                        <li><a href="#about">About Us</a></li>
                        <li><a href="#features">Features</a></li>
                        <li><a href="#contact">Contact Us</a></li>
                        <li><a href={{ route('pannel') }}>NLMS Login</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4 footer-links">
                    <h4>School Hours</h4>
                    <ul>
                        <li>Sunday - Friday</li>
                        <li>10:00 AM - 4:00 PM</li>
                        <li>Saturday: Closed</li>
                        <li>Holidays: As per academic calendar</li>
                        <li><a href="#contact">Contact for more details</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 Shree Naragram Secondary School. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <a href="#top" class="back-to-top" id="backToTop">
        <i class="fas fa-arrow-up"></i>
    </a>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const navbar = document.querySelector('.navbar');
            const backToTop = document.getElementById('backToTop');

            if (window.scrollY > 50) {
                navbar.style.padding = '0.5rem';
                navbar.style.boxShadow = '0 2px 10px rgba(0,0,0,0.1)';
                backToTop.classList.add('show');
            } else {
                navbar.style.padding = '0.8rem';
                navbar.style.boxShadow = 'none';
                backToTop.classList.remove('show');
            }
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;

                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 70,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Form validation
        function validateForm() {
            const name = document.getElementById('name').value;
            const mobile = document.getElementById('mobile').value;
            const email = document.getElementById('email').value;
            const message = document.getElementById('message').value;

            // Basic validation
            if (name.trim() === '' || mobile.trim() === '' || email.trim() === '' || message.trim() === '') {
                alert('Please fill all the fields');
                return false;
            }

            // Email validation
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                alert('Please enter a valid email address');
                return false;
            }

            // Mobile validation - allow numerical values with optional country code
            const mobilePattern = /^[\d\s\+\-]{7,15}$/;
            if (!mobilePattern.test(mobile)) {
                alert('Please enter a valid mobile number');
                return false;
            }

            // If validation passes, show success message (in a real app, you'd submit to server)
            alert('Thank you for your message! We will get back to you soon.');
            document.getElementById('contactForm').reset();
            return false; // Prevent actual form submission for this demo
        }

        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        // Add animation to feature cards on scroll
        const observerOptions = {
            root: null,
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = 1;
                    entry.target.style.transform = 'translateY(0)';
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        document.querySelectorAll('.feature-card').forEach(card => {
            card.style.opacity = 0;
            card.style.transform = 'translateY(50px)';
            card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(card);
        });
    </script>
