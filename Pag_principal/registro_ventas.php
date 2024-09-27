<?php
include("sesion.php");
// Obtener el nombre de usuario de la sesión
$nombre = $_SESSION['sesion_email'];

// Obtener la información del usuario de la base de datos
$conectar = conn();
$nombre = mysqli_real_escape_string($conectar, $nombre);

$sql = "SELECT * FROM registro WHERE Nombre = '$nombre'";
$resul = mysqli_query($conectar, $sql) or trigger_error("query failed SQL-ERROR:" . mysqli_error($conectar), E_USER_ERROR);
$row = mysqli_fetch_array($resul);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gabo Café</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="../public/template/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
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

        .content-container {
            display: flex;
            justify-content: space-between;
        }

        .form-container {
            width: 45%;
        }

        .table-container {
            width: 50%;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
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

            <ul class="navbar-nav ml-auto">
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

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="index3.html" class="brand-link">
                <img src="../public/template/AdminLTE-3.2.0/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">AdminLTE 3</span>
            </a>

            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="../public/template/AdminLTE-3.2.0/dist/img/hunter.png" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?php echo htmlspecialchars($row['Nombre'] . ' ' . $row['Apellido']); ?></a>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
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
                            <a href="../app/controladores/login/cerrar_sesion.php" class="btn btn-danger">Cerrar sesión</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Bienvenido!</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid mt-4">
                <div class="content-container">
                    <div class="form-container">
                        <!-- Formulario de Registro de Ventas -->
                        <form class="p-3" method="POST" action="registro_ventas.php">
                            <h3 class="text-center text-secondary">Registro de ventas</h3>
                            <div class="mb-3">
                                <label for="producto" class="form-label">Producto</label>
                                <input type="text" class="form-control" name="producto" id="producto" value="<?php echo $_GET['edit_producto'] ?? ''; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="precio" class="form-label">Precio</label>
                                <input type="text" class="form-control" name="precio" id="precio" value="<?php echo $_GET['edit_precio'] ?? ''; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="cantidad" class="form-label">Cantidad</label>
                                <input type="number" class="form-control" name="cantidad" id="cantidad" value="<?php echo $_GET['edit_cantidad'] ?? ''; ?>" required>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" name="id" value="<?php echo $_GET['edit_id'] ?? ''; ?>">
                                <input type="submit" class="btn btn-primary" name="btnregistrar" value="Registrar venta">
                                <input type="submit" class="btn btn-warning" name="btneditar" value="Actualizar" <?php echo isset($_GET['edit_id']) ? '' : 'disabled'; ?>>
                            </div>
                        </form>
                    </div>

                    <!-- Contenedor de la tabla -->
                    <div class="table-container">
                        <div class="mb-3">
                            <input type="text" id="search" class="form-control" placeholder="Buscar por producto o precio">
                        </div>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                                <?php
                                $sql = "SELECT id, producto, precio, cantidad FROM registro_ventas";
                                $result = $conectar->query($sql);

                                if ($result) {
                                    while ($datos = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($datos['producto']) . "</td>";
                                        echo "<td>" . htmlspecialchars($datos['precio']) . "</td>";
                                        echo "<td>" . htmlspecialchars($datos['cantidad']) . "</td>";
                                        echo "<td>";
                                        echo '<a href="registro_ventas.php?edit_id=' . $datos['id'] . '&edit_producto=' . urlencode($datos['producto']) . '&edit_precio=' . $datos['precio'] . '&edit_cantidad=' . $datos['cantidad'] . '" class="btn btn-small btn-warning">Editar</a>';
                                        echo ' <a href="registro_ventas.php?delete_id=' . $datos['id'] . '" class="btn btn-small btn-danger">Eliminar</a>';
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="main-footer" id="footer1">
            <strong>Gabo Café</strong>
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.1.0
            </div>
        </footer>
    </div>

    <script src="../public/template/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
    <script src="../public/template/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../public/template/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#search').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $('#table-body tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
</body>

</html>

<?php
// Lógica para manejar el registro y edición de ventas
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['btnregistrar'])) {
        $producto = mysqli_real_escape_string($conectar, $_POST['producto']);
        $precio = mysqli_real_escape_string($conectar, $_POST['precio']);
        $cantidad = mysqli_real_escape_string($conectar, $_POST['cantidad']);

        $sql = "INSERT INTO registro_ventas (producto, precio, cantidad) VALUES ('$producto', '$precio', '$cantidad')";
        mysqli_query($conectar, $sql) or die(mysqli_error($conectar));
        echo '<script>window.location="registro_ventas.php?status=success"</script>';
        exit();
    }

    if (isset($_POST['btneditar'])) {
        $id = mysqli_real_escape_string($conectar, $_POST['id']);
        $producto = mysqli_real_escape_string($conectar, $_POST['producto']);
        $precio = mysqli_real_escape_string($conectar, $_POST['precio']);
        $cantidad = mysqli_real_escape_string($conectar, $_POST['cantidad']);

        $sql = "UPDATE registro_ventas SET producto='$producto', precio='$precio', cantidad='$cantidad' WHERE id='$id'";
        mysqli_query($conectar, $sql) or die(mysqli_error($conectar));
        echo '<script>window.location="registro_ventas.php?status=updated"</script>';
        exit();
    }
}

// Lógica para manejar la eliminación
if (isset($_GET['delete_id'])) {
    $id = mysqli_real_escape_string($conectar, $_GET['delete_id']);
    $sql = "DELETE FROM registro_ventas WHERE id='$id'";
    mysqli_query($conectar, $sql) or die(mysqli_error($conectar));
    echo '<script>window.location="registro_ventas.php?status=deleted"</script>';
    exit();
}
?>