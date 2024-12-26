<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Farmer Federation</title>
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      color: #fff;
      scroll-behavior: smooth;
    }

    nav {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 20px;
      background-color: green;
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    nav .logo {
      display: flex;
      align-items: center;
    }

    nav .logo img {
      height: 50px;
      width: 60px;
      border-radius: 50%;
      margin-right: 10px;
    }

    nav .menu {
      display: flex;
      gap: 20px;
    }

    nav .menu a {
      color: white;
      text-decoration: none;
      font-weight: bold;
    }

    nav .menu a:hover {
      text-decoration: underline;
    }

    .burger {
      display: none;
      flex-direction: column;
      cursor: pointer;
    }

    .burger div {
      width: 25px;
      height: 3px;
      background-color: white;
      margin: 4px 0;
    }

    /* Landing Section */
    .image-container {
      position: relative;
      width: 100%;
      min-height: 100vh;
      background: url('images/farm-background.jpg') no-repeat center center/cover; /* Change to your image */
    }

    .overlay-content {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      text-align: center;
      color: yellow;
    }

    .overlay-content img {
      border-radius: 50%;
      border: 2px solid rgb(252, 215, 8);
      padding: 5px;
      width: 200px;
      height: 200px;
    }

    /* Team Section */
    #Team {
      padding: 60px 20px;
      background-color: green;
    }

    .card-container {
      display: flex;
      justify-content: center;
      gap: 30px; /* Space between cards */
      flex-wrap: wrap; /* Allow cards to wrap to the next line */
    }

    .card {
      background: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
      text-align: center;
      width: 250px; /* Fixed width for cards */
      transition: transform 0.3s; /* Smooth transition for hover effect */
    }

    .card:hover {
      transform: scale(1.05); /* Scale up on hover */
    }

    .card img {
      width: 100%;
      height: auto;
      border-radius: 10px;
    }

    /* About Section */
    #about {
      max-width: 1000px; /* Set a max width for the about section */
      margin: 40px auto; /* Center the box with margin */
      background-color: rgba(255, 255, 255, 0.9); /* Light background for contrast */
      border-radius: 10px;
      box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
      transition: transform 0.3s; /* Smooth transition for hover effect */
    }

    #about:hover {
      transform: scale(1.02); /* Scale up on hover */
    }

    .section h2 {
      margin-bottom: 20px;
      color: black;
      justify-content: center;
    }

    .section p {
      color: #333;
      font-size: 18px;
      line-height: 1.6; /* Improved line height for readability */
    }

    @media (max-width: 768px) {
      .menu {
 display: none;
        flex-direction: column;
        position: absolute;
        top: 60px;
        right: 15px;
        background-color: green;
        padding: 10px;
        border-radius: 5px;
      }

      .menu.show {
        display: flex;
      }

      .burger {
        display: flex;
      }

      .card-container {
        flex-direction: column; /* Stack cards vertically on small screens */
        align-items: center;
      }

      .card {
        width: 100%; /* Full width for smaller screens */
      }
    }
  </style>
</head>

<body>
  <nav>
    <div class="logo">
      <img src="img/FARML.png" alt="Farmers Logo">
      <span style="color: white; font-size: 24px;">Farmers Federation</span>
    </div>
    <div class="burger">
      <div></div>
      <div></div>
      <div></div>
    </div>
    <div class="menu">
      <a href="#landing">Landing</a>
      <a href="#team">Team</a>
      <a href="#about">About</a>
      <a class="btn btn-light text-success fs-5" href="{{ route('login') }}"><i class="fas fa-user-plus me-2"></i>Log In</a>
      <a class="btn btn-light text-success fs-5" href="{{ route('register') }}"><i class="fas fa-user-plus me-2"></i>Sign up</a>
    </div>
  </nav>

  <div class="image-container" id="landing">
    <div class="overlay-content">
      <h1 style="color: black;">WELCOME TO</h1>
      <img src="img/FARML.png" alt="Farmer Logo" style="width: 300px; height:280px; ">
      <div>
        <p style="color: black;">Farmer's Federation.</p>
      </div>
    </div>
  </div>

  <div id="Team" class="section">
    <h1 class="sub-title text-white mb-4">Our Team</h1>
    <p class="text-white">Meet the masterly minds behind Farmer's Federation.</p>
    <div class="card-container">
      <!-- Team Member 1 -->
      <div class="col-md-3 mb-4">
<div class="card text-dark bg-light h-100">
  <img src="{{ asset('img/FORMAL.png') }}" alt="syren calibo" class="card-img-top img-fluid team-img">
  <div class="card-body">
    <h5 class="card-title">Syren D. Calibo</h5>
    <p class="card-text" style="text-align: justify;">
      <b>Syren D. Calibo</b> <br>
      Role: <i>Project Manager</i> <br>
      Email: <a href="mailto:syrencalibo922@gmail.com">syrencalibo922@gmail.com</a><br>
      Phone: <a href="tel:+639064687353">09064687353</a>
    </p>
  </div>
</div>
</div>
      <!-- Team Member 2 -->
      <div class="col-md-3 mb-4">
        <div class="card text-dark bg-light h-100">
          <img src="{{ asset('img/dave1.png') }}" alt="Dave Alquiza" class="card-img-top img-fluid team-img">
          <div class="card-body">
            <h5 class="card-title">Dave Alquiza</h5>
            <p class="card-text" style="text-align: justify;">
              <b>Dave Alquiza</b> <br>
              Role: <i>UI/UX Designer</i> <br>
              Email: <a href="mailto:markdaveAlquiza@gmail.com">markdaveAlquiza@gmail.com</a> <br>
              Phone: <a href="tel:(+63) 0000000000">0000000000000</a>
            </p>
          </div>
        </div>
      </div>
      <!-- Team Member 3 -->
      <div class="col-md-3 mb-4">
        <div class="card text-dark bg-light h-100">
          <img src="{{ asset('images/jardines.png') }}" alt="John Lloyd Jardines" class="card-img-top img-fluid team-img">
          <div class="card-body">
            <h5 class="card-title">Jake Bayron Orense</h5>
            <p class="card-text" style="text-align: justify;">
              <b>Jake Bayron Orense</b> <br>
              Role: <i>Computer Programmer</i> <br>
              Email: <a href="mailto:bayron@gmail.com">bayron@gmail.com</a> <br>
              Phone: <a href="tel:+630000000000">0000000000</a>
            </p>
          </div>

        </div>
      </div>
    </div>
  </div>

  <div class="section" id="about">
    <h2 class="text-center">About</h2>
    <div>
     
        <div class="card_a">
          <p style="text-align: justify; padding:20px;">A Farmer's Federation Management System is a digital platform designed to streamline and enhance the operations of farmer cooperatives and associations. This system provides tools to manage memberships, track resources transactions, monitor agricultural production, and facilitate communication among members. It simplifies administrative tasks like maintaining member profiles, recording resources distribution, and organizing meetings or events.</p>
        
          <p style="text-align: justify; padding:20px;">The Farmer's Federation Management System promotes sustainable agricultural practices, empowers farmers with better decision-making tools, and strengthens the overall community by fostering unity and growth among its members.</p>
        </div>
      </div>
    </div>
  </div>

  <script>
    const burger = document.querySelector('.burger');
    const menu = document.querySelector('.menu');

    burger.addEventListener('click', () => {
      menu.classList.toggle('show');
    });
  </script>

</body>
</html>