<?php
include("sesion.php");
// Obtener el nombre de usuario de la sesión
$nombre = $_SESSION['sesion_email'];

// Obtener la información del usuario de la base de datos
$conectar = conn();
$nombre = mysqli_real_escape_string($conectar, $nombre);

$sql = "SELECT * FROM registro WHERE Nombre = '$nombre'";
$resul = mysqli_query($conectar, $sql) or trigger_error(" query failed SQL-ERROR:" . mysqli_error($conectar), E_USER_ERROR);
$row = mysqli_fetch_array($resul);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gabo Café</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../public/template/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../public/template/AdminLTE-3.2.0/dist/css/adminlte.min.css">
  <style>
    .chart-container {
      position: relative;
      height: 400px;
      width: 100%;
    }

    #footer1 {
      position: auto;
      bottom: 0px;
      padding-bottom: 0px;
    }
  </style>
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="pag_principal.php" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="registro_ventas.php" class="nav-link">Registro de ventas</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="registro_compras.php" class="nav-link">Registro de compras</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="inventario.php" class="nav-link">Inventario</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
          </a>
          <div class="navbar-search-block">
            <form class="form-inline">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="../public/template/AdminLTE-3.2.0/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="../public/template/AdminLTE-3.2.0/dist/img/hunter.png" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"><?php echo htmlspecialchars($row['Nombre'] . ' ' . $row['Apellido']); ?></a>
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
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item menu-open">
              <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Ventas/Compras
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="registro_ventas.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Registro de ventas</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="registro_compras.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Registro de compras</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="inventario.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Inventario</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item">
              <a href="<?php echo $URL; ?>/app/controladores/login/cerrar_sesion.php" class="btn btn-danger">Cerrar sesión</a>
            </li>
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
              <h1 class="m-0">Bienvenido!</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Starter Page</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
      <!-- Main content -->
      <div class="container">
        <h2>Gráficos</h2>
        <div class="row">
          <div class="col-md-4">
            <canvas id="comprasChart"></canvas>
          </div>
          <div class="col-md-4">
            <canvas id="ventasChart"></canvas>
          </div>
          <div class="col-md-4">
            <canvas id="inventarioChart"></canvas>
          </div>
        </div>
      </div>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
          <h5>Title</h5>
          <p>Sidebar content</p>
        </div>
      </aside>
      <!-- /.control-sidebar -->

      <!-- Main Footer -->
    </div>
    <footer class="main-footer" id="footer1">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
        Anything you want
      </div>
      <!-- Default to the left -->
      <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="../public/template/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../public/template/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../public/template/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        // Gráfico de compras
        fetch('fetch_compras_data.php')
          .then(response => response.json())
          .then(data => {
            if (data.error) {
              console.error('Error:', data.error);
              return;
            }

            new Chart(document.getElementById('comprasChart'), {
              type: 'line',
              data: {
                labels: data.labels,
                datasets: [{
                  label: 'Total Compras',
                  data: data.values,
                  borderColor: 'rgba(75, 192, 192, 1)',
                  backgroundColor: 'rgba(75, 192, 192, 0.2)',
                  borderWidth: 1
                }]
              },
              options: {
                scales: {
                  x: {
                    beginAtZero: true
                  },
                  y: {
                    beginAtZero: true
                  }
                }
              }
            });
          })
          .catch(error => console.error('Error al cargar los datos:', error));

        fetch('fetch_ventas_data.php')
          .then(response => response.json())
          .then(data => {
            console.log(data); // Verifica la estructura de los datos recibidos
            if (data.error) {
              console.error('Error:', data.error);
              return;
            }

            new Chart(document.getElementById('ventasChart'), {
              type: 'line',
              data: {
                labels: data.labels,
                datasets: [{
                  label: 'Total Ventas',
                  data: data.values,
                  borderColor: 'rgba(54, 162, 235, 1)',
                  backgroundColor: 'rgba(54, 162, 235, 0.2)',
                  borderWidth: 1
                }]
              },
              options: {
                scales: {
                  x: {
                    beginAtZero: true
                  },
                  y: {
                    beginAtZero: true
                  }
                }
              }
            });
          })
          .catch(error => console.error('Error al cargar los datos:', error));

        // Gráfico de inventario
        fetch('fetch_inventario_data.php')
          .then(response => response.json())
          .then(data => {
            if (data.error) {
              console.error('Error:', data.error);
              return;
            }

            new Chart(document.getElementById('inventarioChart'), {
              type: 'bar',
              data: {
                labels: data.labels,
                datasets: [{
                  label: 'Total Inventario',
                  data: data.values,
                  backgroundColor: 'rgba(255, 99, 132, 0.2)',
                  borderColor: 'rgba(255, 99, 132, 1)',
                  borderWidth: 1
                }]
              },
              options: {
                scales: {
                  x: {
                    beginAtZero: true
                  },
                  y: {
                    beginAtZero: true
                  }
                }
              }
            });
          })
          .catch(error => console.error('Error al cargar los datos:', error));
      });
    </script>
  </div>
</body>

</html>