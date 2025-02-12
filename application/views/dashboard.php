<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard | MARIS</title>
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
  <!-- Select2 -->
  <link rel="stylesheet" href="../assets/plugins/select2/css/select2.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../assets/plugins/daterangepicker/daterangepicker.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
  <!-- sweetAlert2 -->
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.1/../dist/sweetalert2.min.css" rel="stylesheet">
  <!-- Page Specific CSS -->
  <link rel="stylesheet" href="../assets/dist/css/dashboard.css">
</head>

<body style="background-color: #f4f4f4;">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="../assets/dist/img/DAlogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand navbar-white navbar-light">
      <a href="<?php echo base_url('/') ?>" class="brand-link bg-white">
        <img src="../assets/dist/img/DAlogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
          style="opacity: .8">
        <span class="brand-text font-weight-dark" style="color: #28a745; font-size: 1.1em;">Borongan </span>
        <small><span class="brand-text font-weight-dark" style="color: #e83e8c; font-size: 0.87em;">City
            Agriculture</span></small>
      </a>
      <!-- Right navbar links -->
    </nav>
    <!-- /.navbar -->

    <!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <a href="<?php echo base_url('/') ?>">
                <p class="float-sm-right" style="color: #000000; font-size: 1.40em;">
                  Go back to homepage <i class="fas fa-share fa-xs" style="color: #e83e8c; margin-left: 5px;"></i>
                </p>
              </a>
            </div>
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
    </div>
    <!-- /.content-header -->

    <!-- Small Boxes -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="far fa-user"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Registered Fisherman</span>
                <span class="info-box-number"><?php echo $counts['fisherman_count']; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- ./col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-pink"><i class="far fa-user"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Registered Aqua Farmer</span>
                <span class="info-box-number"><?php echo $counts['farmer_count']; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- ./col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="fas fa-ship"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Registered Fishing Vessel</span>
                <span class="info-box-number"><?php echo $counts['vessel_count']; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- ./col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-pink"><i class="fas fa-warehouse"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Registered Fishing Vessel</span>
                <span class="info-box-number"><?php echo $counts['farm_count']; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <section class="content">
          <div class="container-fluid">
            <h2 class="text-center display-4">Search for Fisherman/Farmer's Profile</h2>
            <div class="row">
              <div class="col-md-10 offset-md-1">
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label>Sort By:</label>
                      <select class="select2" id="sortBy" style="width: 100%;" onchange="filterTable()">
                        <option value="all" selected>All</option>
                        <option value="Fisherman">Fisherman</option>
                        <option value="Farmer">Farmer</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label>Order By:</label>
                      <select class="select2" id="orderBy" style="width: 100%;" onchange="filterTable()">
                        <option value="all" selected>All</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-15">
                  <div class="form-group">
                    <div class="input-group input-group-lg">
                      <input type="search" class="form-control form-control-lg" id="searchBox" onkeyup="filterTable()"
                        placeholder="Search Profile">
                      <div class="input-group-append">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <section class="content">
          <div class="container-fluid">
            <table class="table table-striped" id="dataTable">
              <thead style="text-align: center;">
                <tr>
                  <th>Profile Type</th>
                  <th>Reg. #</th>
                  <th>Name</th>
                  <th>Gender</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody style="text-align: center;">
                <?php foreach ($profiles as $profile): ?>
                  <tr data-type='<?php echo htmlspecialchars($profile['profile_type']); ?>'
                    data-gender='<?php echo htmlspecialchars($profile['gender']); ?>'>
                    <td><?php echo htmlspecialchars($profile['profile_type']); ?></td>
                    <td><?php echo htmlspecialchars($profile['reg_number']); ?></td>
                    <td>
                      <?php echo htmlspecialchars($profile['f_name'] . ' ' . $profile['m_name'] . ' ' . $profile['l_name'] . ' ' . $profile['suffix']); ?>
                    </td>
                    <td><?php echo htmlspecialchars($profile['gender']); ?></td>
                    <td>
                      <form
                        action='<?php echo ($profile['profile_type'] === 'Fisherman') ? base_url('home/viewFisher') : base_url('home/viewFarmer'); ?>'
                        method='get' style='display:inline;'>
                        
                        <input type='hidden'
                          name='<?php echo ($profile['profile_type'] === 'Fisherman') ? 'fisher_id' : 'farmer_id'; ?>'
                          value='<?php echo htmlspecialchars($profile['id']); ?>'>
                        <button type='submit' class='btn btn-success btn-sm'>View Record</button>
                      </form>

                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </section>

      </div>
    </section>

    <div class="wrapper">
      <footer class="footer">
        <div class="float-right d-none d-sm-block"><b>Version</b> 1.4.0</div>
        <strong>Copyright &copy; 2024 <a href="dashboard.php">MARIS</a>.</strong> All rights reserved.
      </footer>
    </div>
  </div>

  <!-- jQuery -->
  <script src="../assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="../assets/plugins/chart.js/Chart.min.js"></script>
  <!-- sweetALert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.1/../dist/sweetalert2.all.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="../assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="../assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <!-- Select2 -->
  <script src="../assets/plugins/select2/js/select2.full.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../assets/dist/js/adminlte.js"></script>
  <!-- Page Specific Script -->
  <script>
    $(function () {
      $('.select2').select2()

      $('#dataTable').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });

    function filterTable() {
      const sortBy = document.getElementById('sortBy').value.toLowerCase();
      const orderBy = document.getElementById('orderBy').value.toLowerCase();
      const searchQuery = document.getElementById('searchBox').value.toLowerCase();
      const rows = document.querySelectorAll('#dataTable tbody tr');

      rows.forEach(row => {
        const type = row.getAttribute('data-type').toLowerCase();
        const gender = row.getAttribute('data-gender').toLowerCase();
        const name = row.children[1].innerText.toLowerCase(); // Full Name column

        // Check filters
        const matchesSort = sortBy === 'all' || type === sortBy;
        const matchesOrder = orderBy === 'all' || gender === orderBy;
        const matchesSearch = name.includes(searchQuery);

        // Show/Hide rows
        if (matchesSort && matchesOrder && matchesSearch) {
          row.style.display = '';
        } else {
          row.style.display = 'none';
        }

      });
    }
  </script>
</body>

</html>