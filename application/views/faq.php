<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FAQ's | MARIS</title>
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
              <a href="<?php echo base_url('home/contactus') ?>" class="nav-link">
                <i class="far fa-envelope nav-icon"></i>
                <p>Contact us</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('home/faq') ?>" class="nav-link active">
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
              <h1>FAQ's</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-12" id="accordion">
            <div class="card card-success card-outline">
              <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                <div class="card-header">
                  <h4 class="card-title w-100">
                    1. What is MARIS?
                  </h4>
                </div>
              </a>
              <div id="collapseOne" class="collapse" data-parent="#accordion">
                <div class="card-body">
                  <i class="fas fa-circle" style="font-size: 5px; margin-right: 5px; vertical-align: middle;"></i>
                  Marine Activity Reporting Information System (MARIS) is a tool utilized by the City Agriculture Office
                  to metigate, control, and prevent overfishing within the local municipal water or jurisdiction.
                </div>
              </div>
            </div>
            <div class="card card-pink card-outline">
              <a class="d-block w-100" data-toggle="collapse" href="#collapseTwo">
                <div class="card-header">
                  <h4 class="card-title w-100">
                    2. Why is MARIS important?
                  </h4>
                </div>
              </a>
              <div id="collapseTwo" class="collapse" data-parent="#accordion">
                <div class="card-body">
                  <i class="fas fa-circle" style="font-size: 5px; margin-right: 5px; vertical-align: middle;"></i> This
                  will help the local authorities track fishing and aqua farming activities to metigate, control,
                  and prevent overfishing and to conserve marine resource.
                </div>
              </div>
            </div>
            <div class="card card-success card-outline">
              <a class="d-block w-100" data-toggle="collapse" href="#collapseThree">
                <div class="card-header">
                  <h4 class="card-title w-100">
                    3. What does MARIS do?
                  </h4>
                </div>
              </a>
              <div id="collapseThree" class="collapse" data-parent="#accordion">
                <div class="card-body">
                  <i class="fas fa-circle" style="font-size: 5px; margin-right: 5px; vertical-align: middle;"></i>
                  Tracks fishing and aqua farming activities.
                </div>
              </div>
            </div>
            <div class="card card-pink card-outline">
              <a class="d-block w-100" data-toggle="collapse" href="#collapseFour">
                <div class="card-header">
                  <h4 class="card-title w-100">
                    4. How do I submit a report?
                  </h4>
                </div>
              </a>
              <div id="collapseFour" class="collapse" data-parent="#accordion">
                <div class="card-body">
                  <i class="fas fa-circle" style="font-size: 5px; margin-right: 5px; vertical-align: middle;"></i>
                  Only agriculturist can submit a report.<br>
                  <i class="fas fa-circle" style="font-size: 5px; margin-right: 5px; vertical-align: middle;"></i>
                  To submit a report, the agriculturist must conduct a survey and collect fishing and aqua farming
                  reports.

                </div>
              </div>
            </div>
            <div class="card card-success card-outline">
              <a class="d-block w-100" data-toggle="collapse" href="#collapseFive">
                <div class="card-header">
                  <h4 class="card-title w-100">
                    5. Do I need an account to submit a report?
                  </h4>
                </div>
              </a>
              <div id="collapseFive" class="collapse" data-parent="#accordion">
                <div class="card-body">
                  <i class="fas fa-circle" style="font-size: 5px; margin-right: 5px; vertical-align: middle;"></i>
                  Yes, only agriculturists and administrators can submit a report.
                </div>
              </div>
            </div>
            <div class="card card-pink card-outline">
              <a class="d-block w-100" data-toggle="collapse" href="#collapseSix">
                <div class="card-header">
                  <h4 class="card-title w-100">
                    6. What information do I include in the report?
                  </h4>
                </div>
              </a>
              <div id="collapseSix" class="collapse" data-parent="#accordion">
                <div class="card-body">
                  <i class="fas fa-circle" style="font-size: 5px; margin-right: 5px; vertical-align: middle;"></i>
                  Fisherman's/Farmer's Name<br>
                  <i class="fas fa-circle" style="font-size: 5px; margin-right: 5px; vertical-align: middle;"></i>
                  Species<br>
                  <i class="fas fa-circle" style="font-size: 5px; margin-right: 5px; vertical-align: middle;"></i>
                  Quantity<br>
                  <i class="fas fa-circle" style="font-size: 5px; margin-right: 5px; vertical-align: middle;"></i>
                  For <strong>Fishermen</strong>, include equipments used, distance covered during the operation, and
                  duration of the operation.<br>
                  <i class="fas fa-circle" style="font-size: 5px; margin-right: 5px; vertical-align: middle;"></i>
                  For <strong>Aqua Farmers</strong>, include farming culture or method.<br>
                  <i class="fas fa-circle" style="font-size: 5px; margin-right: 5px; vertical-align: middle;"></i>
                  Date of Catch<br><br>
                  <p><strong>Notice!</strong><br>
                    If a fisherman exceeds the catch limit, they will receive an SMS notification warning them that they
                    have exceeded the catch limit along with their current total catch record. The City Agriculture
                    Office,
                    together with other authorities, will take appropriate actions and impose rightful and lawful
                    repercussions.</p>

                </div>
              </div>
            </div>
            <div class="card card-success card-outline">
              <a class="d-block w-100" data-toggle="collapse" href="#collapseSeven">
                <div class="card-header">
                  <h4 class="card-title w-100">
                    7. What is a Catch Limit?
                  </h4>
                </div>
              </a>
              <div id="collapseSeven" class="collapse" data-parent="#accordion">
                <div class="card-body">
                  <i class="fas fa-circle" style="font-size: 5px; margin-right: 5px; vertical-align: middle;"></i>
                  Catch limit is a tool to control the monthly catch for every fishermen. This is utilized to prevent
                  overfishing to effectively conserve local marine resource.
                </div>
              </div>
            </div>
            <div class="card card-pink card-outline">
              <a class="d-block w-100" data-toggle="collapse" href="#collapseEight">
                <div class="card-header">
                  <h4 class="card-title w-100">
                    8. Will my information be made public?
                  </h4>
                </div>
              </a>
              <div id="collapseEight" class="collapse" data-parent="#accordion">
                <div class="card-body">
                  <i class="fas fa-circle" style="font-size: 5px; margin-right: 5px; vertical-align: middle;"></i>
                  Your information such as <strong>Name, Age,</strong> and <strong>Catch or Harvest Records</strong>
                  will be displayed publicly. However your confidential information is protected by <strong>Republic Act
                    10173</strong> - Data Privacy Act of 2012 <span
                    style="display: inline-block; margin-left: 15px;">and therefore will be hidden from public
                    view.</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 mt-3 text-center">
            <p class="lead">
              <a href="contactus.php">Contact us</a>,
              if you have not found the right anwser or you have a other question?<br />
            </p>
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