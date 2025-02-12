<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Catch Analytics and Records</title>
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
  <!-- DataTables -->
  <link rel="stylesheet" href="../assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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
              <a href="<?= base_url('agriculturist/fisher_catch_report') ?>" class="nav-link active">
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
              <h1 class="m-0">Marine Harvest Monitoring</h1>
              <p>This page highlights the general chart for the monthly recorded marine capture by the municipal
                <strong>Fishermen</strong>
              </p>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>

      <!-- Main content -->
      <section clas="content">
        <div class="container-fluid">
          <div class="card card-success card-outline">
            <div class="card-header">
              <h3 class="card-title">Recorded Marine Capture Chart</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="chart">
                <canvas id="lineChart" width="3000" height="1000"
                  style="display: block; box-sizing: border-box; height: 400px; width: 800px;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          <div class="card card-pink card-outline">
            <div class="card-header">
              <h3 class="card-title">Recorded Marine Capture List</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <!-- Year and Month Selection Dropdowns -->
              <div class="row">
                <div class="col-md-6">
                  <label for="yearSelect">Select Year:</label>
                  <select id="yearSelect" class="form-control select2 select2-success"
                    data-dropdown-css-class="select2-success">
                    <option value="">--Select Year--</option>
                    <?php
                    // You can generate the year options dynamically based on available data or a predefined range
                    $currentYear = date("Y");
                    for ($year = $currentYear; $year >= 2000; $year--) {
                      echo "<option value='{$year}'>{$year}</option>";
                    }
                    ?>
                  </select>
                </div>
                <div class="col-md-6">
                  <label for="monthSelect">Select Month:</label>
                  <select id="monthSelect" class="form-control select2 select2-primary"
                    data-dropdown-css-class="select2-success">
                    <option value="">--Select Month--</option>
                    <option value="01">January</option>
                    <option value="02">February</option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                  </select>
                </div>
              </div>
              <div class="my-2">
                <table id="savedReportTable" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Species</th>
                      <th>Quantity</th>
                      <th>Date of Catch</th>
                      <th>Date of Submission</th>
                    </tr>
                  </thead>
                  <tbody>
                        <?php
                        if (!empty($fisherCatches)) {
                          foreach ($fisherCatches as $catch) {
                            echo "<tr>
                                      <td>{$catch['species']}</td>
                                      <td>{$catch['gen_quantity']}</td>
                                      <td>{$catch['date_of_catch']}</td>
                                      <td>{$catch['date_of_submission']}</td>
                                  </tr>";
                          }
                        } else {
                          echo "<tr><td colspan='4'>No data available</td></tr>";
                        }
                        ?>
                  </tbody>
                </table>
                <!-- /.card-body -->
              </div>
            </div>
          </div>
          <!-- /.container fluid -->
        </div>
      </section>
    </div>
    <footer class="main-footer">
      <div class="float-right d-none d-sm-block"><b>Version</b> 1.4.0</div>
      <strong>Copyright &copy; 2024 <a href="dashboard.php">MARIS</a>.</strong> All rights reserved.
    </footer>
    <!-- /.content-wrapper -->
  </div>
  <!-- ./wrapper -->
  <!-- jQuery -->
  <script src="../assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Select2 -->
  <script src="../assets/plugins/select2/js/select2.full.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="../assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="../assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="../assets/plugins/jszip/jszip.min.js"></script>
  <script src="../assets/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="../assets/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="../assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="../assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="../assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- ChartJS -->
  <script src="../assets/plugins/chart.js/Chart.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../assets/dist/js/adminlte.js"></script>
  <!-- Page specific script -->
  <script>
    $(document).ready(function () {
      var lineChartCanvas = $('#lineChart').get(0).getContext('2d');

// Data passed from the controller
var totalData = <?= json_encode($monthly_catch_data); ?>;
var speciesChartData = <?= json_encode($species_chart_data); ?>;
var speciesNames = <?= json_encode(array_keys($species_chart_data)); ?>;

      var datasets = [
        {
          label: 'Total Catch',
          backgroundColor: 'rgba(40,167,69,0.9)',
          borderColor: 'rgba(40,167,69,0.8)',
          data: totalData,
          fill: false
        }
      ];

      // Add each species to the datasets
      var colors = ['rgba(255, 99, 132, 0.8)', 'rgba(54, 162, 235, 0.8)', 'rgba(255, 206, 86, 0.8)', 'rgba(75, 192, 192, 0.8)']; // Example colors
      var i = 0;

      for (var species_name in speciesChartData) {
        datasets.push({
          label: speciesNames[i] || 'Species ' + species_name,
          backgroundColor: colors[i % colors.length],
          borderColor: colors[i % colors.length],
          data: speciesChartData[species_name],
          fill: false
        });
        i++;
      }

      var lineChartData = {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        datasets: datasets
      };

      var lineChartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          xAxes: [{
            gridLines: { display: true }
          }],
          yAxes: [{
            gridLines: { display: true }
          }]
        }
      };

      var lineChart = new Chart(lineChartCanvas, {
        type: 'line',
        data: lineChartData,
        options: lineChartOptions
      });

      $(function () {
        var currentYear = new Date().getFullYear();

        var table = $("#savedReportTable").DataTable({
          "responsive": true,
          "lengthChange": false,
          "autoWidth": true,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });

        // Append the buttons to the table wrapper
        table.buttons().container().appendTo('#savedReportTable_wrapper .col-md-6:eq(0)');

        // Listen for year and month selection changes
        $("#yearSelect, #monthSelect").on("change", function () {
          var selectedYear = $("#yearSelect").val();
          var selectedMonth = $("#monthSelect").val();

          // Determine filter condition based on selected year and month
          var filterCondition = '';

          if (selectedYear && selectedMonth) {
            // If both year and month are selected, filter in 'YYYY-MM' format
            filterCondition = selectedYear + '-' + selectedMonth;
          } else if (selectedYear) {
            // If only year is selected, filter by year
            filterCondition = '^' + selectedYear;
          } else if (selectedMonth) {
            // If only month is selected, filter by current year and month
            filterCondition = '^' + currentYear + '-' + selectedMonth;
          }

          // Apply the filter condition to the Date of Catch column (index 3)
          if (filterCondition) {
            table.columns(2).search(filterCondition, true, false).draw();
          } else {
            // Reset search if no filter is selected
            table.columns(2).search('').draw();
          }
        });
      });

      $(document).ready(function () {
        // Initialize Select2 elements
        $(".select2").select2();
      });
    });
  </script>
</body>

</html>