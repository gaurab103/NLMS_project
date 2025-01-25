<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shree Naragram Secondary School</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Arial', sans-serif;
      background-color: #f8f9fa;
    }

    .navbar {
      background: yellow;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .nav-link {
      color: #4e3e7b !important;
      font-weight: 600;
    }

    .nav-link:hover {
      color: #007BFF !important;
    }

    .carousel-inner img {
      height: 85vh;
      object-fit: cover;
    }

    .typewriter {
      font-size: 2rem;
      font-weight: bold;
      color: antiquewhite;
      text-align: center;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 1050;
      animation: fade-in 3s ease-in-out;
    }

    @keyframes fade-in {
      from {
        opacity: 0;
      }
      to {
        opacity: 1;
      }
    }

    #abus img {
      transition: transform 0.3s;
    }

    #abus img:hover {
      transform: scale(1.05);
    }

    #cntus .fa {
      font-size: 1.5rem;
      color: #007bff;
      margin-bottom: 10px;
    }

    .contact-section {
      background: #f9f9f9;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .btn-outline-primary a {
      color: #007bff;
      text-decoration: none;
    }

    .btn-outline-primary a:hover {
      color: white;
    }

    form input,
    form textarea {
      transition: box-shadow 0.3s;
    }

    form input:focus,
    form textarea:focus {
      box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
      border-color: #007bff;
    }

    iframe {
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    footer {
      background: #4e3e7b;
      color: white;
      padding: 10px 0;
      text-align: center;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="{{ asset('images/logo/logo.png') }}" alt="Naragram" style="height: 40px; width: 60px;">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a href="#" class="nav-link">Home</a></li>
          <li class="nav-item"><a href="#abus" class="nav-link">About Us</a></li>
          <li class="nav-item"><a href="#cntus" class="nav-link">Contact Us</a></li>
          <li class="nav-item">
            <a href="https://www.facebook.com/profile.php?id=100088714107555" target="_blank" class="nav-link">
              <i class="fa fa-facebook"></i>
            </a>
          </li>
          <li class="nav-item">
            <button class="btn btn-outline-primary">
              <a href="#">Login</a>
            </button>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="{{ asset('images/logo/background.jpg') }}" class="d-block w-100" alt="Background">
      </div>
      <div class="carousel-item">
        <img src="{{ asset('images/logo/img.jpg') }}" class="d-block w-100" alt="Image 1">
      </div>
      <div class="carousel-item">
        <img src="{{ asset('images/logo/img3.jpg') }}" class="d-block w-100" alt="Image 2">
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

  <section id="abus" class="container my-5">
    <h2 class="text-center">Shree Naragram Secondary School</h2>
    <div class="row align-items-center">
      <div class="col-md-4 text-center">
        <img src="{{ asset('images/logo/sir.jpg') }}" class="img-fluid rounded-circle" alt="Principal">
      </div>
      <div class="col-md-8">
        <p><strong>Principal:</strong> Mr. Kailash KC</p>
        <p><strong>Established:</strong> 1947 AD (2004 BS)</p>
        <p><strong>Affiliated to:</strong> National Examination Board (NEB)</p>
        <p><strong>Education Program:</strong> Playground to Grade 10</p>
      </div>
    </div>
  </section>

  <section id="cntus" class="contact-section text-center my-5">
    <h2>Contact Us</h2>
    <div class="row justify-content-center">
      <div class="col-md-4"><i class="fa fa-map-marker"></i> Budhiganga Municipality-1, Morang, Nepal</div>
      <div class="col-md-4"><i class="fa fa-envelope"></i> naragramschool2004@gmail.com</div>
      <div class="col-md-4"><i class="fa fa-phone"></i> +977-21-420440</div>
    </div>
  </section>

  <section class="container my-5">
    <h3 class="text-center">Contact Form</h3>
    <div class="row">
      <div class="col-md-6">
        <form>
          <input type="text" name="name" class="form-control mb-3" placeholder="Name" required>
          <input type="tel" name="mobile" class="form-control mb-3" placeholder="Mobile Number" required>
          <input type="email" name="email" class="form-control mb-3" placeholder="Email Address" required>
          <textarea name="message" class="form-control mb-3" placeholder="Message" rows="4" required></textarea>
          <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>
      </div>
      <div class="col-md-6">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2361.3817192879274!2d87.2774827087924!3d26.521317176786166!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39ef73b844fca2b5%3A0xc4b057eccd897060!2sShree%20Naragram%20Secondary%20School!5e1!3m2!1sen!2snp!4v1737782909920!5m2!1sen!2snp" width="100%" height="300" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </div>
  </section>

  <footer>
    <p>&copy; 2025 Shree Naragram Secondary School. All Rights Reserved.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
