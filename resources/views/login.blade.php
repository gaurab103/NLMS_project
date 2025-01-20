<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="view-transition" content="same-origin"/>
    <title>Login</title>  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body class="transition-fade">
  <div class="back">
    <a href="pannel">
      <img src="/images/pannel/icons8-back-100.png" alt="Back">
    </a>
  </div>
  <div class="card">
    <div class="logo-container">
      <img src="/images/pannel/logo.png" class="card-img-top" alt="Logo">
    </div>
    <form>
      <div class="form-group">
        <label for="exampleInputEmail1" class="label">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1" class="label">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
      </div>
      <div class="submit-btn">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>
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
          }, 400);
        });
      });
    });
  </script>
</body>
<style>
  body {
      background-color: #e4f1fe;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      font-family: 'Poppins', sans-serif;
  }
  body.transition-fade {
      opacity: 1;
      transition: opacity 0.5s ease-in-out;
  }
  body.is-animating {
      opacity: 0;
  }
  .card {
      width: 350px;
      padding: 20px;
      border: 1px solid #ddd;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      text-align: center;
      display: flex;
      flex-direction: column;
      align-items: center;
  }
  .logo-container {
      display: flex;
      justify-content: center;
      align-items: center;
      margin-bottom: 20px;
  }
  .card-img-top {
      height: 150px;
      width: 150px;
      object-fit: cover;
      border-radius: 10%;
      border: 2px solid black;
  }
  form {
      width: 100%;
  }
  .form-group {
      margin-bottom: 15px;
  }
  .label {
      margin-bottom: 5px;
      display: block;
      text-align: left;
      font-weight: bold;
  }
  .submit-btn {
      display: flex;
      justify-content: center;
      align-items: center;
      margin-top: 20px;
  }
  .back {
      position: absolute;
      top: 20px;
      left: 20px;
  }
  .back img {
      width: 50px; 
      height: 50px; 
      transition: transform 0.3s ease;
  }
  .back img:hover {
      transform: scale(1.2);
      cursor: pointer;
  }

  /* Media Queries for Mobile Responsiveness */
  @media (max-width: 768px) {
      .card {
          width: 90%;
          padding: 15px;
      }
      .card-img-top {
          height: 120px;
          width: 120px;
      }
      .label, .form-control, .btn {
          font-size: 0.9rem;
      }
  }
  @media (max-width: 480px) {
      .back img {
          width: 40px;
          height: 40px;
      }
      .card-img-top {
          height: 100px;
          width: 100px;
      }
      .label, .form-control, .btn {
          font-size: 0.8rem;
      }
      .submit-btn {
          margin-top: 15px;
      }
  }
</style>
</html>
