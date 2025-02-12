<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Contact Us | MARIS</title>
  <link rel="apple-touch-icon" sizes="180x180" href="../assets/dist/img/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../assets/dist/img/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../assets/dist/img/favicon-16x16.png">
  <link rel="manifest" href="dist/img/site.webmanifest">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
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
              <a href="<?php echo base_url('home/aboutus') ?>" class="nav-link">
                <i class="far fa-address-card nav-icon"></i>
                <p>About us</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('home/contactus') ?>" class="nav-link active">
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
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Contact us</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="card card-success card-outline">
          <div class="card-body row">
            <div class="col-12 text-center d-flex align-items-center justify-content-center">
              <div class="">
                <h2>Borongan City<br><small><strong>City Agriculture Office</strong></small></h2>
                <p class="lead mb-5">3F Borongan City Hall building, Cardona cor.<br>Victoria Street, Purok E
                  (Poblacion), Borongan, Philippines, 6800
                </p>
                <p class="text-muted">Contacts<br>
                  <i class="fas fa-phone-alt"></i>: 0968-656-9143<br>
                  <i class="fab fa-facebook"></i>: Borongan CAO<br>
                  <i class="fab fa-viber"></i>: Borongan@CAO<br>
                  <i class="fas fa-envelope"></i>: borongan.CAO@gmail.com
                </p>
              </div>
            </div>
          </div>
        </div>

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

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
  <!-- AdminLTE App -->
  <script src="../assets/dist/js/adminlte.min.js"></script>
</body>

</html>