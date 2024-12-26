<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Farmer')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="{{ asset('css/user/navuser.css') }}">
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">
    <div class="logo-container">
      <!-- Ensure the image path is correct -->
      <img src="{{ asset('iMG/FARMA.png') }}" alt="InventoryApp Logo" class="logo"> <!-- Change '.png' to 'logo.png' -->
    </div>
    <ul class="nav flex-column">
      
      <li class="nav-item">
        <a class="nav-link" href="{{ url('farmer/announcements/index') }}">
        <i class='bx bxs-bell-ring'></i><span class="nav-label">Announcements</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('user/register') }}">
        <i class='bx bxs-layer-plus'></i><span class="nav-label">Register Now</span>
        </a>
      </li>
      <!-- Logout button at the bottom -->
      <li class="nav-item" style="margin-top: 230px; border: 1px solid black; background-color: light-yellow; border-radius: 5px; padding: 5px; align-items: center; " >
    <a class="nav-link" href="{{ url('/') }}" style="color: yellow; text-decoration: none; font-weight: bold; margin-left:50px;">
        <i class='bx bx-log-out' style="margin-right: 15px; "></i> 
        <span class="nav-label">Logout</span>
    </a>
</li>

    </ul>
  </div>

  <!-- Burger Button (Mobile View) -->
  <button class="btn btn-primary d-block d-sm-none" id="burger-menu">
    <i class='bx bx-menu'></i>
  </button>

  <!-- Main Content -->
  <div class="main-content">
    @yield('content')
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Sidebar Toggle Script -->
  <script>
    document.getElementById('burger-menu').addEventListener('click', function() {
      document.querySelector('.sidebar').classList.toggle('open');
    });
  </script>
</body>
</html>