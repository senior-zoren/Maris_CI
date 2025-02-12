<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User Profile | MARIS</title>
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
  <!-- sweetAlert2 -->
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.1/assets/dist/sweetalert2.min.css" rel="stylesheet">
  <style>
    .profile-user-img {
      width: 320px;
      height: 320px;
      object-fit: cover;
      border-radius: 50%;
    }
  </style>
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
                  <a href="fisherDashPage.php" class="nav-link">
                    <i class="nav-icon fas fa-ship"></i>
                    <p>Fisher's Monitoring Page</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="farmerDashPage.php" class="nav-link">
                    <i class="nav-icon fas fa-cube"></i>
                    <p>Farmer's Monitoring Page</p>
                  </a>
                </li>
              </ul>
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
              <h1>User Profile</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-3">
              <div class="card card-success card-outline">
                <div class="card-body box-profile">
                  <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle"
                      src="<?= isset($userDetails['image_path']) ? $userDetails['image_path'] : base_url('assets/images/default.jpg'); ?>"
                      alt="User profile picture">
                  </div>

                  <h3 class="profile-username text-muted text-center">
                    <?= isset($userDetails['user_type']) ? ucfirst($userDetails['user_type']) : ''; ?> |
                    <?= ucfirst($userDetails['age']); ?>
                  </h3>

                  <p class="text-muted text-center"></p>
                </div>
              </div>
            </div>

            <div class="col-md-9">
              <div class="card card-pink card-outline">
                <div class="card-header">
                  <h3 class="card-title">Information</h3>
                </div>

                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <strong><i class="fas fas fa-user mr-1"></i> Name</strong>
                        <p class="text-muted">
                          <?= isset($userDetails['f_name']) ? $userDetails['f_name'] : ''; ?>
                          <?= isset($userDetails['m_name']) ? $userDetails['m_name'] : ''; ?>
                          <?= isset($userDetails['l_name']) ? $userDetails['l_name'] : ''; ?>
                          <?= isset($userDetails['suffix']) ? $userDetails['suffix'] : ''; ?>
                        </p>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <strong><i class="fas fa-calendar mr-1"></i> Birhtdate</strong>
                        <p class="text-muted"><?= date("F j, Y", strtotime($userDetails['age'])); ?></p>
                      </div>
                    </div>
                  </div>

                  <hr>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <strong><i class="fas fa-venus-mars mr-1"></i> Gender</strong>
                        <p class="text-muted"><?= ucfirst($userDetails['gender']); ?></p>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Address</strong>
                        <p class="text-muted"><?= ($address); ?></p>
                      </div>
                    </div>
                  </div>

                  <hr>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <strong><i class="fas fa-phone mr-1"></i> Phone Number</strong>
                        <p class="text-muted"><?= $userDetails['cell_num']; ?></p>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <strong><i class="fas fa-at mr-1"></i> Email</strong>
                        <p class="text-muted"><?= $userDetails['email']; ?></p>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <a href="<?= base_url('logout') ?>" class="btn btn-outline-success btn-flat float-right"><i
                      class="fas fa-sign-out-alt"></i> Logout</a>
                </div>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-md-12">
              <div class="card card-white card-outline">
                <div class="card-header p-2">
                  <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#logs1" data-toggle="tab">Personal Activity
                        Logs</a>
                    </li>
                  </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane" id="logs1">
                      <div class="card-body table-responsive p-0" style="max-height: 550px; overflow-y: auto;">
                        <!-- Adjusted height here -->
                        <!-- table -->
                        <table class="table table-head-fixed text-nowrap text-striped" id="logsTable">
                          <!-- Added ID for targeting -->
                          <thead>
                            <tr>
                              <th>User</th>
                              <th>Activity</th>
                              <th>Description</th>
                              <th>Date and Time</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php if (!empty($logs)): ?>
                              <?php foreach ($logs as $log): ?>
                                <tr>
                                  <td><?= htmlspecialchars($log['user']); ?></td>
                                  <td><?= htmlspecialchars($log['activity']); ?></td>
                                  <td><?= htmlspecialchars($log['description']); ?></td>
                                  <td><?= htmlspecialchars($log['date']); ?></td>
                                </tr>
                              <?php endforeach; ?>
                            <?php else: ?>
                              <tr>
                                <td colspan="4">No logs found</td>
                              </tr>
                            <?php endif; ?>
                          </tbody>
                        </table>
                      </div>
                      <!-- Pagination Links -->
                      <div id="paginationLinks">
                        <ul class="pagination justify-content-end">
                          <?php if ($current_page > 1): ?>
                            <li class="page-item"><a class="page-link" href="?page=1">&laquo;&laquo;</a></li>
                            <li class="page-item"><a class="page-link" href="?page=<?= $current_page - 1; ?>">&laquo;</a>
                            </li>
                          <?php endif; ?>

                          <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <li class="page-item <?= $i == $current_page ? 'active' : ''; ?>">
                              <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
                            </li>
                          <?php endfor; ?>

                          <?php if ($current_page < $total_pages): ?>
                            <li class="page-item"><a class="page-link" href="?page=<?= $current_page + 1; ?>">&raquo;</a>
                            </li>
                            <li class="page-item"><a class="page-link"
                                href="?page=<?= $total_pages; ?>">&raquo;&raquo;</a></li>
                          <?php endif; ?>
                        </ul>
                      </div>

                    </div>
                    <!-- /.tab-pane -->
                  </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
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
  <!-- sweetALert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.1/assets/dist/sweetalert2.all.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../assets/dist/js/adminlte.js"></script>
  <script>
    $(document).ready(function () {
      // Handle click on pagination links
      $('#paginationLinks').on('click', 'a', function (e) {
        e.preventDefault();  // Prevent default link behavior
        var page = $(this).data('page');  // Get the page number from the clicked link

        // Perform AJAX request to fetch new table data
        $.ajax({
          url: '/agriculturist/user_profile',
          type: 'GET',
          data: { page: page },  // Pass the page number
          success: function (response) {
            // Update the table content with the new data
            $('#logsTable tbody').html($(response).find('#logsTable tbody').html());
            // Update the pagination links
            $('#paginationLinks').html($(response).find('#paginationLinks').html());
          }
        });
      });
    });

  </script>
</body>

</html>