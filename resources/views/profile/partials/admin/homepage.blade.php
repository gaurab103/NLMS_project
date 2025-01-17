<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Naragram Learning Management System</title>
    <style>
        body{
            background-color: rgb(240, 240, 240);
        }   
        .nav{
            display: flex;
            justify-content: space-around;
            align-items: center;
        }
        .nav ul{
            list-style: none;
        }
        .nav ul li{
            display: inline-block;
            padding: 10px;
        }
        .nav ul li a{
            text-decoration: none;
            color: black;
            font-size: 20px;
        }
        .slider-container{
            width: 100%;
            height: 500px;
            background-color: rgb(255, 255, 255);
            position: relative;
        }
        .slider{
            width: 100%;
            height: 100%;
            position: absolute;
            overflow: hidden;
        }
        .slide{
            width: 100%;
            height: 100%;
            position: absolute;
            transition: transform 1s ease-in-out;
        }
        .slide img{
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .prev, .next{
            position: absolute;
            top: 50%;
            width: auto;
            margin-top: -22px;
            padding: 16px;
            color: white;
            font-weight: bold;
            font-size: 18px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
            cursor: pointer;
        }
        .next{
            right: 0;
            border-radius: 3px 0 0 3px;
        }
        .prev:hover, .next:hover{
            background-color: rgba(0, 0, 0, 0.8);
        }
        .div-container{
            display: flex;
            justify-content: space-around;
            align-items: center;
        }
        .about-container, .news-container{
            width: 40%;
            height: 400px;
            background-color: rgb(255, 255, 255);
            border-radius: 10px;
        }
        .about-container img, .news-container img{
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .about-details, .news-details{
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 20px;
        }
        .about-details h1, .news-details h1{
            font-size: 30px;
            font-weight: bold;
        }
        .about-details button, .news-details button{
            padding: 10px 20px;
            background-color: rgb(0, 0, 0);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .about-details button:hover, .news-details button:hover{
            background-color: rgb(255, 255, 255);
        }
        @media (max-width: 768px){
            .slider-container{
                height: 300px;
            }
            .about-container, .news-container{
                width: 80%;
            }
            .about-details, .news-details{
                padding: 10px;
            }
            .about-details h1, .news-details h1{
                font-size: 20px;
            }
            .about-details button, .news-details button{
                padding: 5px 10px;
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
   <nav>
    <header>
        <img src="https://cdn.dribbble.com/users/1067988/screenshots/12667828/media/e0b9b7f8c1e6b6c4d3f5d1d5b2d6e7e8.png" alt="logo" width="200px" height="100px">
        <div class="nav">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact us</a></li>
                <li><a href="#">News</a></li>
                <li><a href=@route('login')>Login</a></li>
                <li><a href=@route('register')>Register</a></li>
            </ul>
        </div>
        <div class="slider-container">
            <div class="slider">
                <div class="slide">
                    <img src="https://cdn.dribbble.com/users/1067988/screenshots/12667828/media/e0b9b7f8c1e6b6c4d3f5d1d5b2d6e7e8.png" alt="slide">
                </div>
                <div class="slide">
                    <img src="https://cdn.dribbble.com/users/1067988/screenshots/12667828/media/e0b9b7f8c1e6b6c4d3f5d1d5b2d6e7e8.png" alt="slide">
                </div>
            
            <button class="prev">prev</button>
            <button class="next">next</button>
            </div>
        </div>
        <div class="div-container">
            <div class="about-container">
                <img src="https://cdn.dribbble.com/users/1067988/screenshots/12667828/media/e0b9b7f8c1e6b6c4d3f5d1d5b2d6e7e8.png" alt="about" width="200px" height="100px">
                <div class="about-details">
                    <h1>About Us</h1>
                    <button>Read More</button>
                </div>
            </div>
            <div class="news-container">
                <img src="https://cdn.dribbble.com/users/1067988/screenshots/12667828/media/e0b9b7f8c1e6b6c4d3f5d1d5b2d6e7e8.png" alt="news" width="200px" height="100px">
                <div class="news-details">
                    <h1>News</h1>
                    <button>Read More</button>
                </div>
            </div>
        </div>
    </header>
   </nav>
   <script>
    var slideIndex = 0;
    showSlides(slideIndex);

    function showSlides(n) {
      var i;
      var slides = document.getElementsByClassName("slide");
      var dots = document.getElementsByClassName("dot");
      if (n > slides.length) {slideIndex = 1}
      if (n < 1) {slideIndex = slides.length}
      for (i = 0; i < slides.length; i++) {
          slides[i].style.display = "none";
      }
      for (i = 0; i < dots.length; i++) {
          dots[i].className = dots[i].className.replace(" active", "");
      }
      slides[slideIndex-1].style.display = "block";
      dots[slideIndex-1].className += " active";
    }

    function plusSlides(n) {
      showSlides(slideIndex += n);
    }

    function currentSlide(n) {
      showSlides(slideIndex = n);
    }

    function plusSlides(n) {
      showSlides(slideIndex += n);
    }

    document.getElementById("prev").onclick = function() {plusSlides(-1);}
    document.getElementById("next").onclick = function() {plusSlides(1);}
   </script>
</body>
</html>