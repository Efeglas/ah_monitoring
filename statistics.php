<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AH Monitoring</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- JQUERY -->
  <script src="./plugins/jquery/jquery.min.js" defer></script>
  <!-- DATATABLES -->
  <link rel="stylesheet" href="./plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="./plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="./plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Bootstrap 4 -->
  <script src="./plugins/bootstrap/js/bootstrap.bundle.min.js" defer></script>
  <!-- DataTables  & Plugins -->
  <script src="./plugins/datatables/jquery.dataTables.min.js" defer></script>
  <script src="./plugins/datatables-bs4/js/dataTables.bootstrap4.min.js" defer></script>
  <script src="./plugins/datatables-responsive/js/dataTables.responsive.min.js" defer></script>
  <script src="./plugins/datatables-responsive/js/responsive.bootstrap4.min.js" defer></script>
  <script src="./plugins/datatables-buttons/js/dataTables.buttons.min.js" defer></script>
  <script src="./plugins/datatables-buttons/js/buttons.bootstrap4.min.js" defer></script>
  <script src="./plugins/jszip/jszip.min.js" defer></script>
  <script src="./plugins/pdfmake/pdfmake.min.js" defer></script>
  <script src="./plugins/pdfmake/vfs_fonts.js" defer></script>
  <script src="./plugins/datatables-buttons/js/buttons.html5.min.js" defer></script>
  <script src="./plugins/datatables-buttons/js/buttons.print.min.js" defer></script>
  <script src="./plugins/datatables-buttons/js/buttons.colVis.min.js" defer></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="./plugins/moment/moment.min.js" defer></script>
  <script src="./plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js" defer></script>
  <link rel="stylesheet" href="./plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css" />
  <!-- SweetAlert2 -->
  <script src="./plugins/sweetalert2/sweetalert2.min.js" defer></script>
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="./plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- ChartJS -->
  <script src="./plugins/chart.js/Chart.min.js"></script>
  <!-- OWN -->
  <link rel="stylesheet" href="./own/css/style.css">
  <!-- OWN SCRIPTS -->
  <script src="./own/js/functions.js" defer></script>
  <script src="./own/js/statistics.js" defer></script>
</head>

<body class="hold-transition sidebar-mini sidebar-collapse ">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

        <?php include "./includes/include_topNav.php" ?>

      </ul>
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
          <a class="nav-link" id="sumIncome"></a>
        </li>
      </ul>


    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4 sidebar-no-expand">
      <!-- Brand Logo -->
      <a href="index.php" class="brand-link">
        <img src="./dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AH Monitor</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="./dist/img/AdminLTELogo.png" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a class="d-block">v0.1</a>
          </div>

        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

            <?php include "./includes/include_sideNav.php" ?>

          </ul>
        </nav>
        <!-- /.sidebar-menu -->
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
              <h1 class="m-0">Statistics</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">Statistics</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">

          <!-- //! main content -->

          <div class="row">
            <div class="col-md-6">

            <div class="card">
                <div class="card-header ui-sortable-handle" style="cursor: move;">
                  <h3 class="card-title">
                    <i class="fas fa-coins"></i>
                    Products
                  </h3>
                  <div class="card-tools">
                    
                  </div>
                </div><!-- /.card-header -->
                <div class="card-body">

                  <div class="form-group">
                    <label>Product</label>
                    <select id="productSelect" class="form-control">
      
                    </select>
                  </div>
      
                    <canvas id="chartjs"></canvas>
             

                </div><!-- /.card-body -->
                
              </div>


            </div>
          </div>
          

        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <div class="modal fade" id="modal-def">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">xxx</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>

          <div class="modal-body">
            
          </div>

          <div class="modal-footer">
            <button id="saveProductSoldBtn" type="button" class="btn btn-success">Hozzáadás</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>



  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
</body>

</html>