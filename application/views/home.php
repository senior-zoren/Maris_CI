<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MARIS</title>
  <link rel="apple-touch-icon" sizes="180x180" href="../assets/dist/img/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../assets/dist/img/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../assets/dist/img/favicon-16x16.png">
  <link rel="manifest" href="../assets/dist/img/site.webmanifest">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../assets/dist/css/login.css">
</head>

<body>
  <!-- Left side with background image -->
  <div class="background-section"></div>

  <div class="login-section">
    <div class="container">
      <div class="emblem1">
        <img src="../assets/dist/img/cityEmblem.png" alt="City Emblem">
      </div>
      <div class="emblem2">
        <img src="../assets/dist/img/DAlogo.png" alt="City Emblem">
      </div>
      <p><strong>Marine Activity Reporting Information System</strong><br><br>
        MARIS is a tool utilized by the <b>City Agriculture Office</b> to metigate, control, and prevent overfishing
        within
        the local municipal water jurisdiction.<br><br>Tracking marince activity such as fishing and aquatic farming is
        an important matter
        especially in our country, if marine activity is not tracked it will cause an imbalance to the ecosystem and
        deplete our local marine resources<br><br>Want to see your personal record?<br><br>
        <a href="<?php echo base_url('home/dashboard') ?>" class="btn btn-success">Click here!</a>
      </p>
    </div>

    <div class="login-box">
      <div id="overlay" onclick="hideLogin()"></div>
      <div class="login-logo">
        <b>MARIS</b> Login
      </div>
      <form id="loginForm" method="POST" action="<?php echo base_url('login') ?>">
        <div class="card-body login-card-body">
          <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
          <?php endif; ?>
          <div class="input-group mb-3">
            <input type="text" id="username" name="username" class="form-control form-control-border"
              placeholder="Username" required>
          </div>
          <div class="input-group mb-3">
            <input type="password" id="password" name="password" class="form-control form-control-border"
              placeholder="Password" oninput="handlePasswordInput()" required>
            <span id="togglePasswordIcon" class="fas fa-eye toggle-password" onclick="togglePassword()"></span>
          </div>

        </div>
        <button type="submit" class="btn btn-success float-right">LogIn</button>
      </form>
      <button type="submit" class="btn btn-secondary btn-sm float-left" onclick="hideLogin()">Home</button>
    </div>
  </div>

  <!-- Hamburger Menu Icon -->
  <button id="hamburgerMenu" class="hamburger-menu">
    <span class="fas fa-bars"></span>
  </button>

  <!-- Top menu container -->
  <div id="topMenuContainer" class="top-menu-container">
    <div class="top-menu">
      <a href="<?php echo base_url('home/aboutus') ?>">About</a>
      <a href="<?php echo base_url('home/contactus') ?>">Contact</a>
      <a href="<?php echo base_url('home/faq') ?>">FAQ's</a>
      <a href="<?php echo base_url('home/feedback') ?>">Feedback</a>
      <a href="<?php echo base_url('home/manual') ?>">Manual</a>
      <a href="#" onclick="showLogin()">MARIS Login</a>
    </div>
  </div>

  <!-- jQuery -->
  <script src="../assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../assets/dist/js/adminlte.js"></script>
  <!-- Page Specific Script -->
  <script src="../assets/dist/js/login.js"></script>
</body>

</html>