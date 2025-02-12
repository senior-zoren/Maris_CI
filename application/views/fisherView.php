<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Profile Page - Fisher | MARIS</title>
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
  <!-- daterange picker -->
  <link rel="stylesheet" href="../assets/plugins/daterangepicker/daterangepicker.css" />
  <!-- DataTables -->
  <link rel="stylesheet" href="../assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
</head>
<style>
  .footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.5rem 1rem;
    background-color: #f8f9fa;
    /* Light background color */
    color: #6c757d;
    /* Text color */
    font-size: 1rem;
    border-top: 1px solid #dee2e6;
    /* Top border for separation */
    width: 100%;
    position: relative;
    bottom: 0;
  }

  .footer-wrapper {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    /* Pushes footer to the bottom of the page */
  }

  .content {
    flex: 1;
    /* Makes content take up remaining space */
  }

  .footer a {
    color: #007bff;
    /* Link color */
    text-decoration: none;
  }

  .footer a:hover {
    color: #0056b3;
    /* Darker link color on hover */
  }

  @media (max-width: 576px) {
    .float-right {
      display: none;
      /* Hides the version info on small screens */
    }
  }
</style>

<body>
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="../assets/dist/img/DAlogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand navbar-white navbar-light">
      <a href="#" class="brand-link bg-white">
        <img src="../assets/dist/img/DAlogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
          style="opacity: .8">
        <span class="brand-text font-weight-dark" style="color: #28a745; font-size: 1.1em;">Borongan </span>
        <small><span class="brand-text font-weight-dark" style="color: #e83e8c; font-size: 0.87em;">City
            Agriculture</span></small>
      </a>
      <a href="dashboard" class="nav-link" style="color: #e83e8c;"><i class="fas fa-reply mr-1"></i></a>
      <a href="/" class="nav-link" style="color: #e83e8c;"><i class="fas fa-home mr-1"></i></a>
    </nav>


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Fisherman's Record</h1>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Main Content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-success card-outline">
              <div class="card-header">
                <h3 class="card-title">Fisher Information</h3>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <strong><i class="fas fa-file-alt mr-1"></i> Reg. # </strong>
                      <p class="text-muted"><?= $fisher_number; ?></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <strong><i class="fas fa-venus-mars mr-1"></i> Gender</strong>
                      <p class="text-muted"><?= ucfirst($gender); ?></p>
                    </div>
                  </div>
                </div>

                <hr>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <strong><i class="fas fas fa-user mr-1"></i> Name</strong>
                      <p class="text-muted"><?= $f_name . ' ' . $m_name . ' ' . $l_name . ' ' . $suffix; ?></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <strong><i class="fas fa-map-marker-alt mr-1"></i> Address</strong>
                      <p class="text-muted">
                        <?= !empty($addressParts) ? implode(', ', $addressParts) : 'Address not available'; ?>
                      </p>
                    </div>
                  </div>
                </div>

                <hr>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <strong><i class="fas fa-calendar mr-1"></i> Birthdate</strong>
                      <p class="text-muted"><?= date("F j, Y", strtotime($age)); ?></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <strong><i class="fas fa-phone mr-1"></i> Phone Number</strong>
                      <p class="text-muted"><?= $cell_number; ?></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Chart Container -->
          <div class="col-md-12">
            <div class="card card-pink card-outline">
              <div class="card-header">
                <h1 class="card-title">
                  <strong><?= $f_name . ' ' . $m_name . ' ' . $l_name . ' ' . $suffix; ?></strong>'s Personal
                  Records
                </h1>

                <div class="card-tools">
                  <div class="input-group">
                    <button type="button" class="btn btn-default float-right" id="daterange-btn">
                      <i class="far fa-calendar-alt"></i> Date range picker
                      <i class="fas fa-caret-down"></i>
                    </button>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="my-4">
                  <canvas id="lineChart" width="3000" height="1000"
                    style="display: block; box-sizing: border-box; height: 400px; width: 800px;"></canvas>
                </div>
              </div>
            </div>
          </div>

          <!-- Catches Table -->
          <div class="col-md-12">
            <div class="card card-white card-outline">
              <div class="card-header">
                <h3 class="card-title">Marine Catches</h3>
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
                    <select id="monthSelect" class="form-control select2 select2-success"
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

                <!-- Table for Marine Catches -->
                <div class="my-2">
                  <table id="savedReportTable" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Fisherman</th>
                        <th>Species</th>
                        <th>Quantity</th>
                        <th>Date of Catch</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if (!empty($catches)) {
                        foreach ($catches as $catch) {
                          echo "<tr>
                                  <td>{$catch['first_name']} {$catch['last_name']}</td>
                                  <td>{$catch['species']}</td>
                                  <td>{$catch['quantity']}</td>
                                  <td>{$catch['date_of_catch']}</td>
                                </tr>";
                        }
                      } else {
                        echo "<tr><td colspan='4'>No logs found for this fisherman.</td></tr>";

                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>
  </div>
  <!-- Control Sidebar -->
  <div class="wrapper">
    <footer class="footer">
      <div class="float-right d-none d-sm-block"><b>Version</b> 1.4.0</div>
      <strong>Copyright &copy; 2024 <a href="dashboard.php">MARIS</a>.</strong> All rights reserved.
    </footer>
  </div>
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="../assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Select2 -->
  <script src="../assets/plugins/select2/js/select2.full.min.js"></script>
  <!-- InputMask -->
  <script src="../assets/plugins/moment/moment.min.js"></script>
  <!-- date-range-picker -->
  <script src="../assets/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="../assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="../assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
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

      // NOT FUNCTIONAL YET
      $(function () {
        //Date range as a button
        $("#daterange-btn").daterangepicker(
          {
            ranges: {
              Today: [moment(), moment()],
              Yesterday: [
                moment().subtract(1, "days"),
                moment().subtract(1, "days"),
              ],
              "Last 7 Days": [moment().subtract(6, "days"), moment()],
              "Last 30 Days": [moment().subtract(29, "days"), moment()],
              "This Month": [
                moment().startOf("month"),
                moment().endOf("month"),
              ],
              "Last Month": [
                moment().subtract(1, "month").startOf("month"),
                moment().subtract(1, "month").endOf("month"),
              ],
            },
            startDate: moment().subtract(29, "days"),
            endDate: moment(),
          },
          function (start, end) {
            $("#reportrange span").html(
              start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY")
            );
          }
        );
      });

      $(function () {
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

          // Create a filter condition based on selected year and month
          var filterCondition = '';

          // If both year and month are selected, filter by both
          if (selectedYear && selectedMonth) {
            filterCondition = selectedYear + '-' + selectedMonth; // Format: YYYY-MM
          }
          // If only year is selected, filter by year
          else if (selectedYear) {
            filterCondition = selectedYear;
          }
          // If only month is selected, filter by month
          else if (selectedMonth) {
            filterCondition = '-' + selectedMonth + '-';
          }

          // Apply the filter
          if (filterCondition) {
            // Assuming the "Date of Catch" is in column 3 (index 3) and format is YYYY-MM-DD
            table.columns(3).search(filterCondition).draw();
          } else {
            table.columns(3).search('').draw(); // Reset search if no year or month is selected
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