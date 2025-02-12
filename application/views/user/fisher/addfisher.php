<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Management | MARIS</title>
  <link rel="apple-touch-icon" sizes="180x180" href="../assets/dist/img/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../assets/dist/img/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../assets/dist/img/favicon-16x16.png">
  <link rel="manifest" href="../assets/dist/img/site.webmanifest">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../assets/plugins/select2/css/select2.min.css" />
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="../assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css" />
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
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
          <a class="nav-link" href="notificationPage.php">
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
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-home"></i>
                <p>
                  Dashboard
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url('agriculturist/fisher_dashboard') ?>" class="nav-link active">
                    <i class="nav-icon fas fa-angle-right"></i>
                    <p>Fisher's Monitoring Page</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('agriculturist/farmer_dashboard') ?>" class="nav-link">
                    <i class="nav-icon fas fa-angle-right"></i>
                    <p>Farmer's Monitoring Page</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-user-cog"></i>
                <p>
                  Management
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url('agriculturist/fisher_registry') ?>" class="nav-link active">
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
              <h1 class="m-0">Management | Add Fisherman Profile</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="card card-success card-outline">
            <div class="card-header">
              <h3 class="card-title">Profile Information</h3>
            </div>

            <!-- Form Content -->
            <form action="addProfilePage.php" method="POST">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="name">First Name <span class="text-danger">*</span></label>
                      <input type="text" class="form-control form-control-border" id="name" name="name"
                        placeholder="First Name">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="middlename">Middle Name <span class="text-danger">*</span></label>
                      <input type="text" class="form-control form-control-border" id="middlename" name="middlename"
                        placeholder="Middle Name">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="surname">Last Name <span class="text-danger">*</span></label>
                      <input type="text" class="form-control form-control-border" id="surname" name="surname"
                        placeholder="Last Name">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="suffix">Appellation</label>
                      <select class="form-control form-control-border" id="suffix" name="suffix">
                        <option value="" disabled selected>Suffix</option>
                        <option value="Jr.">Jr.</option>
                        <option value="Sr.">Sr.</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="birthdate">Birthdate <span class="text-danger">*</span></label>
                      <input type="date" class="form-control form-control-border" id="birthdate" name="birthdate"
                        placeholder="Enter Birthdate">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="gender">Gender <span class="text-danger">*</span></label>
                      <select class="form-control form-control-border" id="gender" name="gender">
                        <option value="" disabled selected>Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="phone">Phone Number <span class="text-danger">*</span></label>
                      <input type="text" class="form-control form-control-border" id="phone" name="phone"
                        pattern="09[0-9]{9}" maxlength="11" inputmode="numeric" placeholder="09XX-XXX-XXXX (11 digits)"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="port">Port <span class="text-danger">*</span></label>
                      <select class="form-control form-control-border select2 select2-success"
                        data-dropdown-css-class="select2-success" id="port" name="port">
                        <option value="" disabled selected>Select Port</option>
                        <?php foreach ($ports as $port): ?>
                          <option value="<?= $port['port_id']; ?>"><?= $port['port_name']; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="barangay">Barangay <span class="text-danger">*</span></label>
                      <select class="form-control form-control-border select2 select2-success"
                        data-dropdown-css-class="select2-success" id="barangay" name="barangay">
                        <option value="" disabled selected>Select Barangay</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="city">City <span class="text-danger">*</span></label>
                      <input type="text" class="form-control form-control-border" id="city" name="city" value="Borongan"
                        readonly>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="province">Province <span class="text-danger">*</span></label>
                      <input type="text" class="form-control form-control-border" id="province" name="province"
                        value="Eastern Samar" readonly>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-success swalDefaultSuccess float-right">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </section>
      <!-- /.content -->
    </div>
    <footer class="main-footer">
      <div class="float-right d-none d-sm-block"><b>Version</b> 1.4.0</div>
      <strong>Copyright &copy; 2024 <a href="dashboard.php">MARIS</a>.</strong> All rights reserved.
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="../assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Select2 -->
  <script src="../assets/plugins/select2/js/select2.full.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="../assets/plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../assets/dist/js/adminlte.min.js"></script>
  <!-- Page specific script -->
  <script src="../assets/dist/js/addfisherman.js" defer></script>
</body>

</html>