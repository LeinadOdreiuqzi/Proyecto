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
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Starter Pages
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Active Page</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Inactive Page</p>
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

                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <!-- Main content -->


            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
                <div class="p-3">
                    <h5>Title</h5>
                    <p>Sidebar content</p>
                </div>
            </aside>
            <!-- /.control-sidebar -->
            <div class="container-fluid mt-4">
                <div class="content-container">
                    <!-- Formulario de Registro de Ventas -->
                    <div class="form-container col-md-4">
                        <form class="p-3" method="POST" action="registro_ventas.php">
                            <h3 class="text-center text-secondary">Registro de ventas</h3>
                            <div class="mb-3">
                                <label for="producto" class="form-label">Producto</label>
                                <input type="text" class="form-control" name="producto" id="producto" value="<?php echo $_GET['edit_producto'] ?? ''; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="precio" class="form-label">Precio</label>
                                <input type="text" class="form-control" name="precio" id="precio" value="<?php echo $_GET['edit_precio'] ?? ''; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="cantidad" class="form-label">Cantidad</label>
                                <input type="text" class="form-control" name="cantidad" id="cantidad" value="<?php echo $_GET['edit_cantidad'] ?? ''; ?>">
                            </div>
                            <button type="submit" class="btn btn-primary" name="btnregistrar" value="ok">Registrar</button>
                            <?php if (isset($_GET['edit_id'])): ?>
                                <input type="hidden" name="id" value="<?php echo $_GET['edit_id']; ?>">
                                <button type="submit" class="btn btn-secondary" name="btneditar" value="ok">Actualizar</button>
                            <?php endif; ?>
                        </form>
                    </div>

                    <!-- Filtro de búsqueda y Tabla de Registros de Ventas -->
                    <div class="table-container col-md-8">
                        <div class="mb-3">
                            <input type="text" id="search" class="form-control" placeholder="Buscar por producto o precio">
                        </div>
                        <table class="table">
                            <thead class="bg-info">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Producto</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                                <?php
                                // include("../conexcion.php");

                                $conectar = conn();
                                if (!$conectar) {
                                    die("Error al conectar con la base de datos: " . mysqli_connect_error());
                                }

                                if (isset($_POST['btnregistrar']) && $_POST['btnregistrar'] == 'ok') {
                                    $producto = $_POST['producto'];
                                    $precio = $_POST['precio'];
                                    $cantidad = $_POST['cantidad'];

                                    $producto = mysqli_real_escape_string($conectar, $producto);
                                    $precio = mysqli_real_escape_string($conectar, $precio);
                                    $cantidad = mysqli_real_escape_string($conectar, $cantidad);

                                    $query = "INSERT INTO registro_ventas (producto, precio, cantidad) VALUES ('$producto', '$precio', '$cantidad')";
                                    if (mysqli_query($conectar, $query)) {
                                        echo '<script>window.location="registro_ventas.php?status=success"</script>';
                                        exit();
                                    } else {
                                        echo "Error al insertar los datos: " . mysqli_error($conectar);
                                    }
                                }

                                if (isset($_POST['btneditar']) && $_POST['btneditar'] == 'ok') {
                                    $id = $_POST['id'];
                                    $producto = $_POST['producto'];
                                    $precio = $_POST['precio'];
                                    $cantidad = $_POST['cantidad'];

                                    $id = mysqli_real_escape_string($conectar, $id);
                                    $producto = mysqli_real_escape_string($conectar, $producto);
                                    $precio = mysqli_real_escape_string($conectar, $precio);
                                    $cantidad = mysqli_real_escape_string($conectar, $cantidad);

                                    $query = "UPDATE registro_ventas SET producto='$producto', precio='$precio', cantidad='$cantidad' WHERE id='$id'";
                                    if (mysqli_query($conectar, $query)) {
                                        echo '<script>window.location="registro_ventas.php?status=updated"</script>';
                                        exit();
                                    } else {
                                        echo "Error al actualizar los datos: " . mysqli_error($conectar);
                                    }
                                }

                                if (isset($_GET['delete_id'])) {
                                    $id = $_GET['delete_id'];

                                    $id = mysqli_real_escape_string($conectar, $id);

                                    $query = "DELETE FROM registro_ventas WHERE id='$id' LIMIT 1";
                                    if (mysqli_query($conectar, $query)) {
                                        echo '<script>window.location="registro_ventas.php?status=deleted"</script>';
                                        exit();
                                    } else {
                                        echo "Error al eliminar los datos: " . mysqli_error($conectar);
                                    }
                                }

                                $sql = "SELECT id, producto, precio, cantidad FROM registro_ventas";
                                $result = $conectar->query($sql);

                                if ($result) {
                                    while ($datos = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $datos['id'] . "</td>";
                                        echo "<td>" . $datos['producto'] . "</td>";
                                        echo "<td>" . $datos['precio'] . "</td>";
                                        echo "<td>" . $datos['cantidad'] . "</td>";
                                        echo "<td>";
                                        echo '<a href="registro_ventas.php?edit_id=' . $datos['id'] . '&edit_producto=' . $datos['producto'] . '&edit_precio=' . $datos['precio'] . '&edit_cantidad=' . $datos['cantidad'] . '" class="btn btn-small btn-warning">Editar</a> ';
                                        echo '<a href="registro_ventas.php?delete_id=' . $datos['id'] . '" onclick="return confirm(\'¿Estás seguro de que deseas eliminar este registro?\');" class="btn btn-small btn-danger">Eliminar</a>';
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='5'>Error al ejecutar la consulta: " . mysqli_error($conectar) . "</td></tr>";
                                }

                                mysqli_close($conectar);
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
            <script>
                document.getElementById('search').addEventListener('input', function() {
                    const searchTerm = this.value.toLowerCase();
                    const rows = document.querySelectorAll('#table-body tr');
                    rows.forEach(row => {
                        const cells = row.getElementsByTagName('td');
                        let found = false;
                        for (let i = 0; i < cells.length - 1; i++) { // Ignorar la última celda (acciones)
                            if (cells[i].innerText.toLowerCase().includes(searchTerm)) {
                                found = true;
                                break;
                            }
                        }
                        row.style.display = found ? '' : 'none';
                    });
                });
            </script>
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
    </div>
</body>

</html>