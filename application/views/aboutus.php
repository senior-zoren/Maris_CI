<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>About Us | MARIS</title>
  <link rel="apple-touch-icon" sizes="180x180" href="../assets/dist/img/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../assets/dist/img/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../assets/dist/img/favicon-16x16.png">
  <link rel="manifest" href="../assets/dist/img/site.webmanifest">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../assets/aboutus.css">
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="../assets/dist/img/DAlogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-light-olive elevation-4">
      <!-- Brand Logo -->
      <a href="#" class="brand-link bg-white">
        <img src="../assets/dist/img/DAlogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
          style="opacity: .8">
        <span class="brand-text font-weight-dark" style="color: #28a745; font-size: 1.1em;">Borongan </span>
        <small><span class="brand-text font-weight-dark" style="color: #e83e8c; font-size: 0.87em;">City
            Agriculture</span></small>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column nav-legacy nav-child-indent" data-widget="treeview"
            role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="/" class="nav-link">
                <i class="fas fa-home nav-icon"></i>
                <p>Home</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('home/aboutus') ?>" class="nav-link active">
                <i class="far fa-address-card nav-icon"></i>
                <p>About us</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('home/contactus') ?>" class="nav-link">
                <i class="far fa-envelope nav-icon"></i>
                <p>Contact us</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('home/faq') ?>" class="nav-link">
                <i class="far fa-question-circle nav-icon"></i>
                <p>FAQ's</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('home/feedback') ?>" class="nav-link">
                <i class="far fa-thumbs-up nav-icon"></i>
                <p>Feedback</p>
              </a>
            </li>
          </ul>
        </nav>
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">About Us</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="col-12 text-center d-flex align-items-center justify-content-center">
            <div class="">
              <h2>Borongan City<br><small><strong>City Agriculture Office</strong></small></h2><br>
              <h5><strong>Mandate</strong></h5>
              <p class="text-muted">Ensure the delivery of basic services and the provision of adequate facilities
                relative to agriculture services (Section 41.c.1 of RA 9394, Charter of the City of Borongan)</p>
              <hr>
              <h5><strong>Mission</strong></h5>
              <p class="text-muted">To deliver basic services and provide adequate facilities to local farmers and
                fisherfolk and contirbute to the development of the economy sector of the City of Borongan</p>
              <hr>
              <h5><strong>Vission</strong></h5>
              <p class="text-muted">A food secure Borongan City with enterprising farmers and fisherfolk living
                prosperously with their families above the poverty threshold.</p>
              <hr>
              <h5><strong>City Agriculture Office Administrative Chart</strong></h5>
              <img src="../assets/dist/img/orgchart.png" alt="About Us Image" style="max-width: 100%; height: auto;" />
            </div>
          </div>
        </div>
      </section>
    </div>
    <footer class="main-footer">
      <div class="float-right d-none d-sm-block"><b>Version</b> 1.4.0</div>
      <strong>Copyright &copy; 2024 <a href="/">MARIS</a>.</strong> All rights reserved.
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="../assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- bs-custom-file-input -->
  <script src="../assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../assets/dist/js/adminlte.min.js"></script>
  <!-- Page specific script -->
  <script>
    $(function () {
      bsCustomFileInput.init();
    });
  </script>
</body>

</html>