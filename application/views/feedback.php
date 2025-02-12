<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User Feedback | MARIS</title>
  <link rel="apple-touch-icon" sizes="180x180" href="../assets/dist/img/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../assets/dist/img/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../assets/dist/img/favicon-16x16.png">
  <link rel="manifest" href="dist/img/site.webmanifest">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="../assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css" />
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
  <style>
    .slider-legends {
      display: flex;
      justify-content: space-between;
      position: relative;
      width: 100%;
      margin-top: 5px;
      font-size: 12px;
      color: #333;
    }

    .slider-legend {
      text-align: center;
      transform: translateX(-50%);
    }

    .slider-value {
      display: block;
      text-align: right;
      margin-top: 5px;
      font-weight: bold;
      color: #333;
    }
  </style>
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
              <a href="<?php echo base_url('home/faq') ?>" class="nav-link">
                <i class="far fa-question-circle nav-icon"></i>
                <p>FAQ's</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('home/feedback') ?>" class="nav-link active">
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
              <h1>User Feedback</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="card card-success card-outline">

            <!-- Form Content -->
            <form action="feedback.php" method="POST">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label for="interface">Easy to use tool? <span class="text-danger">*</span></label>
                      <div class="custom-control custom-radio">
                        <input class="custom-control-input custom-control-input-success custom-control-input-outline"
                          type="radio" id="customRadio1" name="interface" value="Yes">
                        <label for="customRadio1" class="custom-control-label">Yes</label>
                      </div>
                      <div class="custom-control custom-radio">
                        <input class="custom-control-input custom-control-input-pink custom-control-input-outline"
                          type="radio" id="customRadio2" name="interface" value="No">
                        <label for="customRadio2" class="custom-control-label">No</label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-9">
                    <div class="form-group">
                      <label for="ratingSlider">User friendlinees <span class="text-danger">*</span></label>
                      <input type="range" class="custom-range custom-range-pink" id="ratingSlider" name="ratingSlider"
                        min="1" max="10" step="0.1" value="1">
                      <div class="slider-legends" id="ratingSliderLegends"></div>
                      <span class="slider-value" id="ratingSliderValue">1</span>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="accuracy">Is the catch chart accurate? <span class="text-danger">*</span></label>
                      <div class="custom-control custom-radio">
                        <input class="custom-control-input custom-control-input-success custom-control-input-outline"
                          type="radio" id="customRadio3" name="accuracy" value="Yes">
                        <label for="customRadio3" class="custom-control-label">Yes</label>
                      </div>
                      <div class="custom-control custom-radio">
                        <input class="custom-control-input custom-control-input-pink custom-control-input-outline"
                          type="radio" id="customRadio4" name="accuracy" value="No">
                        <label for="customRadio4" class="custom-control-label">No</label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-9">
                    <div class="form-group">
                      <label for="accuracySlider">Tracking accuracy <span class="text-danger">*</span></label>
                      <input type="range" class="custom-range custom-range-pink" id="accuracySlider"
                        name="accuracySlider" min="1" max="10" step="0.1" value="1">
                      <div class="slider-legends" id="accuracySliderLegends"></div>
                      <span class="slider-value" id="accuracySliderValue">1</span>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="monitor">Continuous monitoring? <span class="text-danger">*</span></label>
                      <div class="custom-control custom-radio">
                        <input class="custom-control-input custom-control-input-success custom-control-input-outline"
                          type="radio" id="customRadio5" name="monitor" value="Yes">
                        <label for="customRadio5" class="custom-control-label">Yes</label>
                      </div>
                      <div class="custom-control custom-radio">
                        <input class="custom-control-input custom-control-input-pink custom-control-input-outline"
                          type="radio" id="customRadio6" name="monitor" value="No">
                        <label for="customRadio6" class="custom-control-label">No</label>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="recommend">Would you recommend the website? <span class="text-danger">*</span></label>
                      <div class="custom-control custom-radio">
                        <input class="custom-control-input custom-control-input-success custom-control-input-outline"
                          type="radio" id="customRadio7" name="recommend" value="Yes">
                        <label for="customRadio7" class="custom-control-label">Yes</label>
                      </div>
                      <div class="custom-control custom-radio">
                        <input class="custom-control-input custom-control-input-pink custom-control-input-outline"
                          type="radio" id="customRadio8" name="recommend" value="No">
                        <label for="customRadio8" class="custom-control-label">No</label>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="comment">What is you comment about the website? <span
                          class="text-danger">*</span></label>
                      <textarea name="comment" class="form-control" rows="5" placeholder="Enter ..."></textarea>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="suggestion">How can we improve the performance of the website? <span
                          class="text-danger">*</span></label>
                      <textarea name="suggestion" class="form-control" rows="5" placeholder="Enter ..."></textarea>
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
  <!-- SweetAlert2 -->
  <script src="../assets/plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../assets/dist/js/adminlte.min.js"></script>
  <!-- Page Specific Script -->
  <script src="../assets/dist/js/feedback.js" defer></script>
</body>

</html>