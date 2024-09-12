<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de ventas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .content-container {
            display: flex;
            gap: 20px; /* Añadir espacio entre formulario y tabla */
        }
        .form-container, .table-container {
            flex: 1;
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
                        include("../conexcion.php");

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
</body>

</html>
