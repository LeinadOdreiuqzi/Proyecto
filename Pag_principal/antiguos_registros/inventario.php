<?php
include("sesion.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-container {
            margin-bottom: 20px;
        }

        .search-container {
            margin-bottom: 20px;
            text-align: center;
            /* Centra la barra de búsqueda */
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="pag_principal.php">Dashboard</a>
                </li>
            </ul>
        </div>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="registro_ventas.php">Registro de ventas</a>
                </li>
            </ul>
        </div>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="registro_compras.php">registro_compras</a>
                </li>
            </ul>
        </div>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="inventario.php">Inventario</a>
                </li>
            </ul>
        </div>
    </nav>

    <h1 class="text-center p-3">Inventario</h1>
    <div class="container-fluid">
        <!-- Filtro de búsqueda -->
        <div class="row">
            <!-- Formulario de Inventario -->
            <form class="form-container p-3 col-12 col-md-4" method="POST" action="inventario.php">
                <h3 class="text-center text-secondary">Agregar Producto</h3>
                <div class="mb-2">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <input type="text" class="form-control form-control-sm" name="descripcion" id="descripcion" value="<?php echo $_GET['edit_descripcion'] ?? ''; ?>">
                </div>
                <div class="mb-2">
                    <label for="cliente" class="form-label">Cliente</label>
                    <input type="text" class="form-control form-control-sm" name="cliente" id="cliente" value="<?php echo $_GET['edit_cliente'] ?? ''; ?>">
                </div>
                <div class="mb-2">
                    <label for="fecha" class="form-label">Fecha</label>
                    <input type="date" class="form-control form-control-sm" name="fecha" id="fecha" value="<?php echo $_GET['edit_fecha'] ?? ''; ?>">
                </div>
                <div class="mb-2">
                    <label for="cantidad" class="form-label">Cantidad</label>
                    <input type="text" class="form-control form-control-sm" name="cantidad" id="cantidad" value="<?php echo $_GET['edit_cantidad'] ?? ''; ?>">
                </div>
                <div class="mb-2">
                    <label for="precio_venta" class="form-label">Precio de Venta</label>
                    <input type="text" class="form-control form-control-sm" name="precio_venta" id="precio_venta" value="<?php echo $_GET['edit_precio_venta'] ?? ''; ?>">
                </div>
                <button type="submit" class="btn btn-primary btn-sm" name="btnregistrar" value="ok">Registrar</button>
                <?php if (isset($_GET['edit_id'])): ?>
                    <input type="hidden" name="id" value="<?php echo $_GET['edit_id']; ?>">
                    <button type="submit" class="btn btn-secondary btn-sm" name="btneditar" value="ok">Actualizar</button>
                <?php endif; ?>
            </form>

            <!-- Tabla de Inventario -->
            <div class="table-container col-12 col-md-8">
                <div class="row search-container">
                    <div class="col-12">
                        <label for="search" class="form-label">Buscar</label>
                        <input type="text" class="form-control form-control-sm search-input" id="search" placeholder="Buscar...">
                    </div>
                </div>
                <table class="table table-sm">
                    <thead class="bg-info">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Precio de Venta</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //include("../conexcion.php");

                        $conectar = conn();
                        if (!$conectar) {
                            die("Error al conectar con la base de datos: " . mysqli_connect_error());
                        }

                        if (isset($_POST['btnregistrar']) && $_POST['btnregistrar'] == 'ok') {
                            $descripcion = $_POST['descripcion'];
                            $cliente = $_POST['cliente'];
                            $fecha = $_POST['fecha'];
                            $cantidad = $_POST['cantidad'];
                            $precio_venta = $_POST['precio_venta'];

                            $descripcion = mysqli_real_escape_string($conectar, $descripcion);
                            $cliente = mysqli_real_escape_string($conectar, $cliente);
                            $fecha = mysqli_real_escape_string($conectar, $fecha);
                            $cantidad = mysqli_real_escape_string($conectar, $cantidad);
                            $precio_venta = mysqli_real_escape_string($conectar, $precio_venta);

                            $query = "INSERT INTO inventario (descripcion, cliente, fecha, cantidad, precio_venta) VALUES ('$descripcion', '$cliente', '$fecha', '$cantidad', '$precio_venta')";
                            if (mysqli_query($conectar, $query)) {
                                echo '<script>window.location="inventario.php?status=success"</script>';
                                exit();
                            } else {
                                echo "Error al insertar datos: " . mysqli_error($conectar);
                            }
                        }

                        if (isset($_POST['btneditar']) && $_POST['btneditar'] == 'ok') {
                            $id = $_POST['id'];
                            $descripcion = $_POST['descripcion'];
                            $cliente = $_POST['cliente'];
                            $fecha = $_POST['fecha'];
                            $cantidad = $_POST['cantidad'];
                            $precio_venta = $_POST['precio_venta'];

                            $id = mysqli_real_escape_string($conectar, $id);
                            $descripcion = mysqli_real_escape_string($conectar, $descripcion);
                            $cliente = mysqli_real_escape_string($conectar, $cliente);
                            $fecha = mysqli_real_escape_string($conectar, $fecha);
                            $cantidad = mysqli_real_escape_string($conectar, $cantidad);
                            $precio_venta = mysqli_real_escape_string($conectar, $precio_venta);

                            $query = "UPDATE inventario SET descripcion='$descripcion', cliente='$cliente', fecha='$fecha', cantidad='$cantidad', precio_venta='$precio_venta' WHERE id='$id'";
                            if (mysqli_query($conectar, $query)) {
                                echo '<script>window.location="inventario.php?status=update"</script>';
                                exit();
                            } else {
                                echo "Error al actualizar datos: " . mysqli_error($conectar);
                            }
                        }

                        if (isset($_GET['delete_id'])) {
                            $id = $_GET['delete_id'];

                            $id = mysqli_real_escape_string($conectar, $id);

                            $query = "DELETE FROM inventario WHERE id='$id' LIMIT 1";
                            if (mysqli_query($conectar, $query)) {
                                echo '<script>window.location="inventario.php?status=delete"</script>';
                                exit();
                            } else {
                                echo "Error al eliminar datos: " . mysqli_error($conectar);
                            }
                        }

                        $sql = "SELECT id, descripcion, cliente, fecha, cantidad, precio_venta FROM inventario";
                        $result = $conectar->query($sql);

                        if ($result) {
                            while ($datos = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td data-search='" . strtolower($datos['id']) . "'>" . $datos['id'] . "</td>";
                                echo "<td data-search='" . strtolower($datos['descripcion']) . "'>" . $datos['descripcion'] . "</td>";
                                echo "<td data-search='" . strtolower($datos['cliente']) . "'>" . $datos['cliente'] . "</td>";
                                echo "<td data-search='" . strtolower($datos['fecha']) . "'>" . $datos['fecha'] . "</td>";
                                echo "<td data-search='" . strtolower($datos['cantidad']) . "'>" . $datos['cantidad'] . "</td>";
                                echo "<td data-search='" . strtolower($datos['precio_venta']) . "'>" . $datos['precio_venta'] . "</td>";
                                echo "<td>";
                                echo '<a href="inventario.php?edit_id=' . $datos['id'] . '&edit_descripcion=' . $datos['descripcion'] . '&edit_cliente=' . $datos['cliente'] . '&edit_fecha=' . $datos['fecha'] . '&edit_cantidad=' . $datos['cantidad'] . '&edit_precio_venta=' . $datos['precio_venta'] . '" class="btn btn-sm btn-warning">Editar</a> ';
                                echo '<a href="inventario.php?delete_id=' . $datos['id'] . '" onclick="return confirm(\'¿Estás seguro de que deseas eliminar este registro?\');" class="btn btn-sm btn-danger">Eliminar</a>';
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7'>Error al ejecutar la consulta: " . mysqli_error($conectar) . "</td></tr>";
                        }

                        mysqli_close($conectar);
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('search').addEventListener('keyup', function() {
            const searchValue = this.value.toLowerCase();
            const rows = document.querySelectorAll('table tbody tr');

            rows.forEach(row => {
                const cells = row.querySelectorAll('td');
                let rowContainsSearchValue = false;

                cells.forEach(cell => {
                    if (cell.getAttribute('data-search') && cell.getAttribute('data-search').includes(searchValue)) {
                        rowContainsSearchValue = true;
                    }
                });

                row.style.display = rowContainsSearchValue ? '' : 'none';
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>