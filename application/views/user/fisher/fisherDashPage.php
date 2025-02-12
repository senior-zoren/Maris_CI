<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Fisherman Dashboard | MARIS</title>
  <link rel="apple-touch-icon" sizes="180x180" href="../assets/dist/img/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../assets/dist/img/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../assets/dist/img/favicon-16x16.png">
  <link rel="manifest" href="../assets/dist/img/site.webmanifest">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
  <!-- General Stylesheet -->
  <link rel="stylesheet" href="../assets/dist/css/calendar.css">
  <!-- <link rel="stylesheet" href="generalStylesheet.css"> -->
</head>

<body class="hold-transition sidebar-mini sidebar-collapse">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="../assets/dist/img/DAlogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-solid fa-bars"
              style="color: #28a745;"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="<?= base_url('agriculturist/fisher_dashboard') ?>" class="nav-link" style="color: #28a745;"><i class="fas fa-home mr-1"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link" href="<?= base_url('agriculturist/notifications') ?>">
            <i class="far fa-bell"></i>
            <span class="badge badge-success navbar-badge">
              <?= isset($unreadNotifications) ? $unreadNotifications : 0; ?>
            </span>
          </a>
        </li>
        <li class="nav-item dropdown user-menu">
          <a href="javascript:void(0)" class="nav-link dropdown-toggle" style="color: #28a745;" data-toggle="dropdown">
            <div>
              <img
                src="<?= isset($userDetails['image_path']) ? $userDetails['image_path'] : base_url('assets/images/default.jpg'); ?>"
                class="user-image img-fluid img-circle elevation-2" alt="User Image">
              <span
                class="d-none d-md-inline"><?= isset($userDetails['f_name']) ? $userDetails['f_name'] : ''; ?></span>
              <i class="fas fa-caret-down"></i>
            </div>
          </a>
          <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <!-- User image -->
            <li class="user-header bg-success">
              <img
                src="<?= isset($userDetails['image_path']) ? $userDetails['image_path'] : base_url('assets/images/default.jpg'); ?>"
                class="img-circle elevation-2" alt="User Image">
              <p>
                <?= isset($userDetails['f_name']) ? $userDetails['f_name'] : ''; ?>
                <?= isset($userDetails['l_name']) ? $userDetails['l_name'] : ''; ?>
                <small><?= isset($userDetails['user_type']) ? ucfirst($userDetails['user_type']) : ''; ?></small>
              </p>
            </li>
            <li class="user-body">
              <a href="<?= base_url('agriculturist/user_manual') ?>" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <span>User Manual</span>
              </a>
              <a href="<?= base_url('agriculturist/marine_compendium') ?>" class="nav-link">
                <i class="nav-icon fas fa-fish"></i>
                <span>Marinepedia</span>
              </a>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <a href="<?= base_url('agriculturist/user_profile') ?>" class="btn btn-default btn-flat">Profile</a>
              <a href="<?= base_url('logout') ?>" class="btn btn-default btn-flat float-right">Sign out</a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

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
          <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-child-indent" data-widget="treeview" role="menu"
            data-accordion="false">
            <li class="nav-item">
              <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-home"></i>
                <p>
                  Dashboard
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url('agriculturist/fisher_dashboard') ?>" class="nav-link active" onclick="loadDashboard('fisher')">
                    <i class="nav-icon fas fa-angle-right"></i>
                    <p>Fisher's Monitoring Page</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('agriculturist/farmer_dashboard') ?>" class="nav-link" onclick="loadDashboard('farmer')">
                    <i class="nav-icon fas fa-angle-right"></i>
                    <p>Farmer's Monitoring Page</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-user-cog"></i>
                <p>
                  Management
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url('agriculturist/fisher_registry') ?>" class="nav-link">
                    <i class="nav-icon fas fa-angle-right"></i>
                    <p>Register Fisher Profile</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('agriculturist/vessel_registry') ?>" class="nav-link">
                    <i class="nav-icon fas fa-angle-right nav-icon"></i>
                    <p>Register Fishing vessel</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('agriculturist/submit_catch_report') ?>" class="nav-link">
                    <i class="nav-icon fas fa-angle-right"></i>
                    <p>Submit Catch Report</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('agriculturist/fisher_info_hub') ?>" class="nav-link">
                <i class="nav-icon fas fa-solid fa-users"></i>
                <p>Fisher's Information Hub</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('agriculturist/fisher_catch_report') ?>" class="nav-link">
                <i class="nav-icon fas fa-chart-line"></i>
                <p>Marine Harvest Monitoring</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('agriculturist/vessel') ?>" class="nav-link">
                <i class="nav-icon fas fa-ship"></i>
                <p>Registered Fishing Vessel</p>
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
              <h1 class="m-0">Fisherman's Dashboard</h1>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-sm-6">
              <p><strong>Notice!</strong><br>
                Catch limit for the month/s of
                <?php
                echo isset($catchLimit['start_date'], $catchLimit['end_date'])
                  ? date("F j Y", strtotime($catchLimit['start_date'])) . " to " . date("F j Y", strtotime($catchLimit['end_date']))
                  : "N/A";
                ?>
                is
                <strong><?= 'Catch Limit: ' . (isset($catchLimit['catch_limit']) ? $catchLimit['catch_limit'] : 'N/A') . ' Kg'; ?></strong>.
              </p>
            </div>

          </div>
        </div>
      </div>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3><?= isset($fishermanCount) ? $fishermanCount : 0; ?></h3>

                  <p>Fisher's Information Hub</p>
                </div>
                <div class="icon">
                  <i class="fas fa-user-plus"></i>
                </div>
                <a href="<?= base_url('agriculturist/fisher_info_hub') ?>" class="small-box-footer">More info <i
                    class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3><?= isset($totalCatch) ? $totalCatch : 0; ?></h3>

                  <p>Marine Harvest Monitoring</p>
                </div>
                <div class="icon">
                  <i class="fas fa-chart-line"></i>
                </div>
                <a href="<?= base_url('agriculturist/fisher_catch_report') ?>" class="small-box-footer">More info <i
                    class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-pink">
                <div class="inner">
                  <!-- To Change -->
                  <h3><?= isset($marineSpeciesCount) ? $marineSpeciesCount : 0; ?></h3>

                  <p>Marine Life Compendium</p>
                </div>
                <div class="icon">
                  <i class="fas fa-fish"></i>
                </div>
                <a href="<?= base_url('agriculturist/marine_compendium') ?>" class="small-box-footer">More info <i
                    class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-pink">
                <div class="inner">
                  <h3><?= isset($vesselCount) ? $vesselCount : 0; ?></h3>

                  <p>Registered Fishing Vessel</p>
                </div>
                <div class="icon">
                  <i class="fas fa-chart-line"></i>
                </div>
                <a href="<?= base_url('agriculturist/vessel') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>
          <!-- /.row -->
        </div>
      </section>

      <!-- Calendar and Chart -->
      <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <section class="col-lg-3 connectedSortable">
              <!-- Calendar -->
              <div class="card card-success card-outline">
                <div class="card-header border-0">
                  <h3 class="card-title">
                    <i class="far fa-calendar-alt"></i>
                    Monthly Catch Report
                  </h3>
                  <!-- tools card -->
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                  <!-- /. tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body pt-0">
                  <!-- Custom Month-Only Calendar -->
                  <div id="calendar" style="width: 100%;">
                    <div id="calendar-header">
                      <button id="prev-year" class="btn btn-sm btn-light" onclick="changeYear(-1)">&#9664;</button>
                      <span id="year-display" class="font-weight-bold"></span>
                      <button id="next-year" class="btn btn-sm btn-light" onclick="changeYear(1)">&#9654;</button>
                    </div>
                    <div class="months-container" id="months-container"></div>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </section>

            <section class="col-lg-9 connectedSortable">
              <!-- Custom tabs (Charts with tabs)-->
              <div class="card card-pink card-outline">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-chart-line"></i>
                    Monthly Catch Report Chart
                  </h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="chart">
                    <canvas id="lineChart"
                      style="min-height: 316px; height: 316px; max-height: 500px; max-width: 100%;"></canvas>
                  </div>
                  <!-- /.card-body -->
                </div>
              </div>
            </section>
            <!-- /.row -->
          </div>
      </section>
    </div>
    <footer class="main-footer">
      <div class="float-right d-none d-sm-block"><b>Version</b> 1.4.0</div>
      <strong>Copyright &copy; 2024 <a href="dashboard.php">MARIS</a>.</strong> All rights reserved.
    </footer>
  </div>
  <!-- jQuery -->
  <script src="../assets/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="../assets/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- ChartJS -->
  <script src="../assets/plugins/chart.js/Chart.min.js"></script>
  <!-- daterangepicker -->
  <script src="../assets/plugins/moment/moment.min.js"></script>
  <script src="../assets/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../assets/dist/js/adminlte.js"></script>
  <!-- Page Specific Script -->
  <script src="../assets/dist/js/agriculturist_calendar.js" defer></script>
</body>

</html>