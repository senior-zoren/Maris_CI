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
  <!-- daterange picker -->
  <link rel="stylesheet" href="../assets/plugins/daterangepicker/daterangepicker.css">
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
          <a href="<?= base_url('agriculturist/fisher_dashboard') ?>" class="nav-link" style="color: #28a745;"><i
              class="fas fa-home mr-1"></i></a>
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
                  <a href="<?= base_url('agriculturist/submit_catch_report') ?>" class="nav-link active">
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

    <!-- content wrapper -->
    <div class="content-wrapper">
      <section class="content-header">
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Management | Manage Fisher Catch Report</h1>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="content">
        <div class="row">
          <div class="col-md-6">
            <div class="card card-success card-outline">
              <div class="card-header">
                <h3 class="card-title">Create Report</h3>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label for="fishermanSelect">Select Fisherman<span class="text-danger">*</span></label>
                  <select id="fishermanSelect" name="fishermanSelect" class="form-control select2 select2-success"
                    data-dropdown-css-class="select2-success" required>
                    <option value="">Select Fisherman</option>
                    <?php while ($fisher = $fisherResult->fetch_assoc()): ?>
                      <option value="<?= $fisher['fisher_id']; ?>">
                        <?= trim($fisher['f_name'] . ' ' . $fisher['l_name']); ?>
                      </option>
                    <?php endwhile; ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="speciesClassSelect">Select Species Class<span class="text-danger">*</span></label>
                  <select id="speciesClassSelect" name="species_class" class="form-control select2 select2-success"
                    data-dropdown-css-class="select2-success" required>
                    <option value="">Select Species Class</option>
                    <?php foreach ($speciesClasses as $class): ?>
                      <option value="<?= $class['class_id']; ?>">
                        <?= $class['class_name']; ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="speciesSelect">Select Species<span class="text-danger">*</span></label>
                  <select id="speciesSelect" name="species" class="form-control select2 select2-success"
                    data-dropdown-css-class="select2-success" required>
                    <option value="">Select Species</option>
                  </select>
                </div>

                <div class="form-group">
                  <button type="button" id="addItemButton" class="btn btn-secondary">Add Item</button>
                </div>
                <div class="form-group">
                  <table id="addedItemsTable" class="table table-bordered">
                    <thead style="text-align: center; vertical-align: middle;">
                      <tr>
                        <th>Species</th>
                        <th>Quantity (kg)</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody style="text-align: center; vertical-align: middle;">
                      <!-- Dynamic population -->
                    </tbody>
                  </table>
                </div>

                <div class="form-group">
                  <label for="equipments">Equipment on Use <span class="text-danger">*</span></label>
                  <div class="select2-success">
                    <select id="equipments" name="equipments[]" class="select2" multiple="multiple"
                      data-placeholder="Select a State" data-dropdown-css-class="select2-success" style="width: 100%">
                      <?php foreach ($equipments as $tools): ?>
                        <option value="<?= $tools['equipment_id']; ?>"><?= $tools['equipment']; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="distance">Fishing Distance Covered (NM)<span class="text-danger">*</span></label>
                      <input type="number" class="form-control" id="distance" name="distance"
                        placeholder="Enter distance covered" min="0" step="0.1">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="operationPeriod">Fishing Operation Period<span class="text-danger">*</span></label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="far fa-clock"></i></span>
                        </div>
                        <input type="text" class="form-control float-right" id="operationPeriod">
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card-footer">
                <button type="button" id="saveItemButton" class="btn btn-secondary swalDefaultSuccess float-right">Save
                  Items</button>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="card card-pink card-outline">
              <div class="card-header">
                <h3 class="card-title">Saved Report List</h3>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <table id="savedReportTable" class="table table-bordered">
                    <thead style="text-align: center; vertical-align: middle;">
                      <tr>
                        <th>Fisherman</th>
                        <th>Species</th>
                        <th>Quantity (kg)</th>
                        <th>Gears Used</th>
                        <th>Distance Covered (NM)</th>
                        <th>Operation Start</th>
                        <th>Operation End</th>
                      </tr>
                    </thead>
                    <tbody style="text-align: center; vertical-align: middle;">
                      <!-- Dynamic population -->
                    </tbody>
                  </table>
                </div>

                <div class="form-group">
                  <label for="date_of_catch">Date of Catch</label>
                  <input type="date" id="date_of_catch" name="date_of_catch" class="form-control" required>
                </div>

                <div class="form-group float-right">
                  <input type="checkbox" id="certify" required>
                  <label for="certify">I certify that the information provided is accurate.</label>
                </div>
              </div>
              <div class="card-footer">
                <button type="button" id="clearAllButton" class="btn btn-danger">Clear All</button>
                <button type="button" class="btn btn-success btn-submit swalDefaultSuccess float-right" disabled>Submit
                  Report</button>
              </div>
            </div>
          </div>
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
  <!-- Bootstrap 4 -->
  <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Select2 -->
  <script src="../assets/plugins/select2/js/select2.full.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="../assets/plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- InputMask -->
  <script src="../assets/plugins/moment/moment.min.js"></script>
  <script src="../assets/plugins/inputmask/jquery.inputmask.min.js"></script>
  <!-- date-range-picker -->
  <script src="../assets/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- AdminLTE App -->
  <script src="../assets/dist/js/adminlte.min.js"></script>
  <!-- Page Specific Script -->
  <script src="../assets/dist/js/fisherReport.js" defer></script>
</body>

</html>