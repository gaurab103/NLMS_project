<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Navbar Example</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
    body {
      margin: 0;
      font-family: sans-serif;
    }

    .navbar {
      background-color: yellow;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);

          }

    .nav-link {
      color: rgb(78, 62, 123) !important;
    }

    .nav-link:hover {
      color: #007BFF !important;
    }

    .social-icons .fa {
      font-size: 16px;
    }

    .typewriter {
      font-size: 30px;
      font-weight: bold;
      color: black;
      text-align: center;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 1050;
      animation: typewriter 3s steps(40) 1s 1 normal both;
    }

    @keyframes typewriter {
      from {
        width: 0;
      }
      to {
        width: 100%;
      }
    }

    .carousel-item img {
      object-fit: cover;
      opacity: 0.8;
    }

    .header {
      text-align: center;
      color: white;
    }

    .header-content {
      position: relative;
      z-index: 2;
      top: 50%;
      transform: translateY(-50%);
    }

    .contact-card i {
      font-size: 40px;
      color: #D500F9;
    }

    .btn a {
      color: black;
      text-decoration: none;
    }

    .btn a:hover {
      color: white;
    }
   
  </style>
</head>

<body>
  <nav class="navbar">
    <div class="container">
      <a class="navbar-brand" href="index.html">
        <img src="./images/logo/logo.png.jpg" alt="Naragram" style="height: 40px; width: 60px;">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a href="index.html" class="nav-link">Home</a></li>
          <li class="nav-item"><a href="#abus" class="nav-link">About Us</a></li>
          <li class="nav-item"><a href="#cntus" class="nav-link">Contact Us</a></li>
          <li class="nav-item"><a href="https://www.facebook.com/profile.php?id=100088714107555" target="_blank" class="nav-link"><i class="fa fa-facebook"></i></a></li>
          <li class="nav-item"><button class="btn btn-outline-primary"><a href="pannel">Login</a></button></li>
        </ul>
      </div>
    </div>
  </nav>

  <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="./images/logo/background.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="./images/logo/img.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="./images/logo/img3.jpg" class="d-block w-100" alt="...">
      </div>
    </div>
    <div class="typewriter">Welcome To Shree Naragram Secondary School</div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
<hr>
  <section id="abus" class="container my-5">
    <h2>Shree Naragram Secondary School</h2>
    <div class="row align-items-center">
      <div class="col-md-4">
        <img src="./images/logo/sir.jfif" class="img-fluid rounded" alt="Principal">
      </div>
      <div class="col-md-8">
        <p><strong>Principal:</strong> Mr. Kailash KC</p>
        <p><strong>Established:</strong> 1947 AD (2004 BS)</p>
        <p><strong>Affiliated to:</strong> National Examination Board (NEB)</p>
        <p><strong>Education Program:</strong> Playground to Grade 10</p>
        <p><strong>Courses Offered:</strong> Ten (+2) Management and Education</p>
        <p><strong>Salient Features:</strong> Library, Sports, Labs, Scholarships, etc.</p>
      </div>
    </div>
  </section>
  <hr>

  <section id="cntus" class="contact-section text-center my-5">
    <h2>Contact Us</h2>
    <p>Send us your questions and feedback!</p>
    <div class="row justify-content-center">
      <div class="col-md-4 contact-card">
        <i class="fa fa-map-marker"></i>
        <h4>Location</h4>
        <p>Budhiganga Municipality-1, Tankisinuwary, Morang, Nepal</p>
      </div>
      <div class="col-md-4 contact-card">
        <i class="fa fa-envelope"></i>
        <h4>Email</h4>
        <p>naragramschool2004@gmail.com</p>
      </div>
      <div class="col-md-4 contact-card">
        <i class="fa fa-phone"></i>
        <h4>Phone</h4>
        <p>+977-21-420440</p>
      </div>
    </div>
  </section>
<hr>
  <section class="container my-5">
    <h3>Contact Form</h3>
    <div class="row">
      <div class="col-md-6">
        <form>
          <input type="text" name="name" class="form-control mb-3" placeholder="Name" required>
          <input type="tel" name="mobile" class="form-control mb-3" placeholder="Mobile Number" required>
          <input type="email" name="email" class="form-control mb-3" placeholder="Email Address" required>
          <textarea name="message" class="form-control mb-3" placeholder="Message" rows="4" required></textarea>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
      <div class="col-md-6">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3569.962913477244!2d87.28006300000004!3d26.52131719999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39ef73b844fca2b5%3A0xc4b057eccd897060!2sShree%20Naragram%20Secondary%20School!5e0!3m2!1sen!2snp!4v1733458789952!5m2!1sen!2snp"  width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"> </script>
</body>

</html>