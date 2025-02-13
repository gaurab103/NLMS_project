<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shree Naragram Secondary School</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    :root {
      --primary-color: #4e3e7b;
      --accent-color: #ffd700;
      --hover-color: #6a5699;
    }

    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background-color: #fbfbfd;
    }

    .navbar {
      background: linear-gradient(135deg, var(--accent-color), #ffe44d);
      padding: 0.8rem;
      transition: all 0.3s ease;
    }

    .navbar-brand img {
      transition: transform 0.3s ease;
    }

    .navbar-brand img:hover {
      transform: scale(1.05);
    }

    .nav-link {
      color: var(--primary-color) !important;
      font-weight: 600;
      position: relative;
      padding: 0.5rem 1rem;
      margin: 0 0.2rem;
      transition: all 0.3s ease;
    }

    .nav-link::after {
      content: '';
      position: absolute;
      width: 0;
      height: 2px;
      bottom: 0;
      left: 50%;
      background-color: var(--primary-color);
      transition: all 0.3s ease;
    }

    .nav-link:hover::after {
      width: 100%;
      left: 0;
    }

    .nav-link:hover {
      color: var(--hover-color) !important;
      transform: translateY(-2px);
    }

    .carousel-inner {
      border-radius: 0 0 2rem 2rem;
      overflow: hidden;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .carousel-inner img {
      height: 85vh;
      object-fit: cover;
      filter: brightness(0.8);
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
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
      animation: fade-in 3s ease-in-out, float 6s ease-in-out infinite;
    }

    @keyframes fade-in {
      from { opacity: 0; transform: translate(-50%, -60%); }
      to { opacity: 1; transform: translate(-50%, -50%); }
    }

    @keyframes float {
      0%, 100% { transform: translate(-50%, -50%); }
      50% { transform: translate(-50%, -52%); }
    }

    #abus {
      background: linear-gradient(135deg, #fff, #f8f9fa);
      border-radius: 2rem;
      padding: 3rem;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }

    #abus img {
      transition: transform 0.5s ease, box-shadow 0.5s ease;
      border: 5px solid var(--accent-color);
    }

    #abus img:hover {
      transform: scale(1.05) rotate(5deg);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    #cntus {
      background: linear-gradient(135deg, var(--primary-color), var(--hover-color));
      color: white;
      padding: 3rem;
      border-radius: 2rem;
      margin: 4rem 0;
    }

    #cntus .fa {
      font-size: 2rem;
      color: var(--accent-color);
      margin-bottom: 1rem;
      transition: transform 0.3s ease;
    }

    #cntus .col-md-4:hover .fa {
      transform: scale(1.2);
    }

    .contact-section {
      background: white;
      padding: 3rem;
      border-radius: 2rem;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }

    .btn-outline-primary {
      border-color: var(--primary-color);
      color: var(--primary-color);
      transition: all 0.3s ease;
    }

    .btn-outline-primary:hover {
      background-color: var(--primary-color);
      border-color: var(--primary-color);
      transform: translateY(-2px);
    }

    .btn-outline-primary a {
      color: inherit;
      text-decoration: none;
    }

    form input,
    form textarea {
      border-radius: 1rem;
      padding: 1rem;
      border: 2px solid #eee;
      transition: all 0.3s ease;
    }

    form input:focus,
    form textarea:focus {
      box-shadow: 0 0 0 3px rgba(78, 62, 123, 0.2);
      border-color: var(--primary-color);
    }

    .btn-primary {
      background-color: var(--primary-color);
      border: none;
      padding: 1rem 2rem;
      border-radius: 1rem;
      transition: all 0.3s ease;
    }

    .btn-primary:hover {
      background-color: var(--hover-color);
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(78, 62, 123, 0.3);
    }

    iframe {
      border-radius: 1rem;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease;
    }

    iframe:hover {
      transform: scale(1.02);
    }

    footer {
      background: linear-gradient(135deg, var(--primary-color), var(--hover-color));
      color: white;
      padding: 1.5rem 0;
      text-align: center;
      margin-top: 4rem;
    }

    .section-title {
      position: relative;
      display: inline-block;
      margin-bottom: 3rem;
    }

    .section-title::after {
      content: '';
      position: absolute;
      width: 50%;
      height: 3px;
      background: var(--accent-color);
      bottom: -10px;
      left: 25%;
    }

    @media (max-width: 768px) {
      .typewriter {
        font-size: 1.8rem;
      }

      .carousel-inner img {
        height: 60vh;
      }

      #abus, #cntus {
        padding: 2rem;
      }
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="{{ asset('images/logo/logo.png') }}" alt="Naragram" style="height: 50px; width: 70px;">
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
              <a href={{route('pannel')}}>NLMS Login</a>
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
    <h2 class="text-center section-title">Shree Naragram Secondary School</h2>
    <div class="row align-items-center">
      <div class="col-md-4 text-center">
        <img src="{{ asset('images/logo/sir.jpg') }}" class="img-fluid rounded-circle mb-4" alt="Principal">
      </div>
      <div class="col-md-8">
        <div class="school-info">
          <p><strong>Principal:</strong> Mr. Kailash KC</p>
          <p><strong>Established:</strong> 1947 AD (2004 BS)</p>
          <p><strong>Affiliated to:</strong> National Examination Board (NEB)</p>
          <p><strong>Education Program:</strong> Playground to Grade 10</p>
        </div>
      </div>
    </div>
  </section>

  <section id="cntus" class="container">
    <h2 class="text-center section-title">Contact Us</h2>
    <div class="row justify-content-center text-center">
      <div class="col-md-4">
        <i class="fa fa-map-marker"></i>
        <p>Budhiganga Municipality-1, Morang, Nepal</p>
      </div>
      <div class="col-md-4">
        <i class="fa fa-envelope"></i>
        <p>naragramschool2004@gmail.com</p>
      </div>
      <div class="col-md-4">
        <i class="fa fa-phone"></i>
        <p>+977-21-420440</p>
      </div>
    </div>
  </section>

  <section class="container contact-section">
    <h3 class="text-center section-title">Get In Touch</h3>
    <div class="row">
      <div class="col-md-6">
        <form>
          <input type="text" name="name" class="form-control mb-3" placeholder="Name" required>
          <input type="tel" name="mobile" class="form-control mb-3" placeholder="Mobile Number" required>
          <input type="email" name="email" class="form-control mb-3" placeholder="Email Address" required>
          <textarea name="message" class="form-control mb-3" placeholder="Message" rows="4" required></textarea>
          <button type="submit" class="btn btn-primary w-100">Send Message</button>
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
  <script>
    window.addEventListener('scroll', () => {
      const navbar = document.querySelector('.navbar');
      if (window.scrollY > 50) {
        navbar.style.padding = '0.5rem';
        navbar.style.boxShadow = '0 2px 10px rgba(0,0,0,0.1)';
      } else {
        navbar.style.padding = '0.8rem';
        navbar.style.boxShadow = 'none';
      }
    });
  </script>
</body>

</html>
