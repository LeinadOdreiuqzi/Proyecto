<?php
include("sesion.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .content-container {
            display: flex;
            gap: 20px; /* Añadir espacio entre formulario y tabla */
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
    
    <div class="container-fluid mt-4">
        <div class="row">
            <!-- Formulario de Registro de Compras -->
            <div class="form-container col-md-4">
                <form class="p-3" method="POST" action="registro_compras.php">
                    <h3 class="text-center text-secondary">Registro de compras</h3>
                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" id="fecha" value="<?php echo $_GET['edit_fecha'] ?? ''; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="proveedor" class="form-label">Proveedor</label>
                        <input type="text" class="form-control" name="proveedor" id="proveedor" value="<?php echo $_GET['edit_proveedor'] ?? ''; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="total" class="form-label">Total</label>
                        <input type="number" class="form-control" name="total" id="total" value="<?php echo $_GET['edit_total'] ?? ''; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <input type="text" class="form-control" name="descripcion" id="descripcion" value="<?php echo $_GET['edit_descripcion'] ?? ''; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="metodo_pago" class="form-label">Método de pago</label>
                        <input type="text" class="form-control" name="metodo_pago" id="metodo_pago" value="<?php echo $_GET['edit_metodo_pago'] ?? ''; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary" name="btnregistrar" value="ok">Registrar</button>
                    <?php if (isset($_GET['edit_id'])): ?>
                        <input type="hidden" name="id" value="<?php echo $_GET['edit_id']; ?>">
                        <button type="submit" class="btn btn-secondary" name="btneditar" value="ok">Actualizar</button>
                    <?php endif; ?>
                </form>
            </div>
            
            <!-- Filtro de búsqueda y Tabla de Registros de Compras -->
            <div class="table-container col-md-8">
                <div class="mb-3">
                    <input type="text" id="search" class="form-control" placeholder="Buscar por proveedor o descripción">
                </div>
                <table class="table">
                    <thead class="bg-info">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Proveedor</th>
                            <th scope="col">Total</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Método de pago</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <?php
                        //include("../conexcion.php");

                        $conectar = conn();
                        if (!$conectar) {
                            die("Error al conectar con la base de datos: " . mysqli_connect_error());
                        }

                        if (isset($_POST['btnregistrar']) && $_POST['btnregistrar'] == 'ok') {
                            $fecha = $_POST['fecha'];
                            $proveedor = $_POST['proveedor'];
                            $total = $_POST['total'];
                            $descripcion = $_POST['descripcion'];
                            $metodo_pago = $_POST['metodo_pago'];

                            $fecha = mysqli_real_escape_string($conectar, $fecha);
                            $proveedor = mysqli_real_escape_string($conectar, $proveedor);
                            $total = mysqli_real_escape_string($conectar, $total);
                            $descripcion = mysqli_real_escape_string($conectar, $descripcion);
                            $metodo_pago = mysqli_real_escape_string($conectar, $metodo_pago);

                            $query = "INSERT INTO registro_compras (fecha, proveedor, total, descripcion, metodo_pago) VALUES ('$fecha', '$proveedor', '$total', '$descripcion', '$metodo_pago')";
                            if (mysqli_query($conectar, $query)) {
                                echo '<script>window.location="registro_compras.php?status=success"</script>';
                                exit();
                            } else {
                                echo "Error al insertar los datos: " . mysqli_error($conectar);
                            }
                        }

                        if (isset($_POST['btneditar']) && $_POST['btneditar'] == 'ok') {
                            $id = $_POST['id'];
                            $fecha = $_POST['fecha'];
                            $proveedor = $_POST['proveedor'];
                            $total = $_POST['total'];
                            $descripcion = $_POST['descripcion'];
                            $metodo_pago = $_POST['metodo_pago'];

                            $id = mysqli_real_escape_string($conectar, $id);
                            $fecha = mysqli_real_escape_string($conectar, $fecha);
                            $proveedor = mysqli_real_escape_string($conectar, $proveedor);
                            $total = mysqli_real_escape_string($conectar, $total);
                            $descripcion = mysqli_real_escape_string($conectar, $descripcion);
                            $metodo_pago = mysqli_real_escape_string($conectar, $metodo_pago);

                            $query = "UPDATE registro_compras SET fecha='$fecha', proveedor='$proveedor', total='$total', descripcion='$descripcion', metodo_pago='$metodo_pago' WHERE id='$id'";
                            if (mysqli_query($conectar, $query)) {
                                echo '<script>window.location="registro_compras.php?status=updated"</script>';
                                exit();
                            } else {
                                echo "Error al actualizar los datos: " . mysqli_error($conectar);
                            }
                        }

                        if (isset($_GET['delete_id'])) {
                            $id = $_GET['delete_id'];

                            $id = mysqli_real_escape_string($conectar, $id);

                            $query = "DELETE FROM registro_compras WHERE id='$id' LIMIT 1";
                            if (mysqli_query($conectar, $query)) {
                                echo '<script>window.location="registro_compras.php?status=deleted"</script>';
                                exit();
                            } else {
                                echo "Error al eliminar los datos: " . mysqli_error($conectar);
                            }
                        }

                        $sql = "SELECT id, fecha, proveedor, total, descripcion, metodo_pago FROM registro_compras";
                        $result = $conectar->query($sql);

                        if ($result) {
                            while ($datos = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $datos['id'] . "</td>";
                                echo "<td>" . $datos['fecha'] . "</td>";
                                echo "<td>" . $datos['proveedor'] . "</td>";
                                echo "<td>" . $datos['total'] . "</td>";
                                echo "<td>" . $datos['descripcion'] . "</td>";
                                echo "<td>" . $datos['metodo_pago'] . "</td>";
                                echo "<td>";
                                echo '<a href="registro_compras.php?edit_id=' . $datos['id'] . '&edit_fecha=' . $datos['fecha'] . '&edit_proveedor=' . $datos['proveedor'] . '&edit_total=' . $datos['total'] . '&edit_descripcion=' . $datos['descripcion'] . '&edit_metodo_pago=' . $datos['metodo_pago'] .'" class="btn btn-small btn-warning">Editar</a> ';
                                echo '<a href="registro_compras.php?delete_id=' . $datos['id'] . '" onclick="return confirm(\'¿Estás seguro de que deseas eliminar este registro?\');" class="btn btn-small btn-danger">Eliminar</a>';
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
</body>

</html>
