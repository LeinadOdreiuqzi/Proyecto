<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de ventas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="pag_principal.php">Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="registro_ventas.php">Registro de ventas <span class="sr-only"></span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="registro_compras.php">Registro de compras</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="inventario.php">Inventario</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Dropdown link
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
        </ul>
        <h4 style="padding-left: 120px;">Bienvenido al registro de ventas</h4>
    </div>
</nav>
<h1 class="text-center p-3">Registro de Ventas</h1>
<div class="container-fluid">
    <div class="row">
        <!-- Formulario de Registro de Ventas -->
        <form class="col-4 p-3" method="POST" action="registro_ventas.php">
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

        <!-- Tabla de Registros de Ventas -->
        <div class="col-8 p-4">
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
                <tbody>
                    <?php 
                    include("../conexcion.php");

                    // Establecer conexión
                    $conectar = conn();
                    if (!$conectar) {
                        die("Error al conectar con la base de datos: " . mysqli_connect_error());
                    }

                    // Verificar si se ha enviado el formulario y realizar la inserción
                    if (isset($_POST['btnregistrar']) && $_POST['btnregistrar'] == 'ok') {
                        $producto = $_POST['producto'];
                        $precio = $_POST['precio'];
                        $cantidad = $_POST['cantidad'];

                        // Sanitizar entradas
                        $producto = mysqli_real_escape_string($conectar, $producto);
                        $precio = mysqli_real_escape_string($conectar, $precio);
                        $cantidad = mysqli_real_escape_string($conectar, $cantidad);

                        // Preparar y ejecutar la consulta SQL para insertar datos
                        $query = "INSERT INTO registro_ventas (producto, precio, cantidad) VALUES ('$producto', '$precio', '$cantidad')";
                        if (mysqli_query($conectar, $query)) {
                            // Redirigir para evitar reenvío de formularios
                            header("Location: registro_ventas.php?status=success");
                            exit();
                        } else {
                            echo "Error al insertar datos: " . mysqli_error($conectar);
                        }
                    }

                    // Verificar si se ha enviado el formulario de edición y realizar la actualización
                    if (isset($_POST['btneditar']) && $_POST['btneditar'] == 'ok') {
                        $id = $_POST['id'];
                        $producto = $_POST['producto'];
                        $precio = $_POST['precio'];
                        $cantidad = $_POST['cantidad'];

                        // Sanitizar entradas
                        $id = mysqli_real_escape_string($conectar, $id);
                        $producto = mysqli_real_escape_string($conectar, $producto);
                        $precio = mysqli_real_escape_string($conectar, $precio);
                        $cantidad = mysqli_real_escape_string($conectar, $cantidad);

                        // Preparar y ejecutar la consulta SQL para actualizar datos
                        $query = "UPDATE registro_ventas SET producto='$producto', precio='$precio', cantidad='$cantidad' WHERE id='$id'";
                        if (mysqli_query($conectar, $query)) {
                            // Redirigir para evitar reenvío de formularios
                            header("Location: registro_ventas.php?status=updated");
                            exit();
                        } else {
                            echo "Error al actualizar datos: " . mysqli_error($conectar);
                        }
                    }

                    // Verificar si se ha enviado el parámetro para eliminar un registro y realizar la eliminación
                    if (isset($_GET['delete_id'])) {
                        $id = $_GET['delete_id'];

                        // Sanitizar la entrada
                        $id = mysqli_real_escape_string($conectar, $id);

                        // Preparar y ejecutar la consulta SQL para eliminar datos
                        $query = "DELETE FROM registro_ventas WHERE id='$id' LIMIT 1";
                        if (mysqli_query($conectar, $query)) {
                            // Redirigir para evitar reenvío de formularios
                            header("Location: registro_ventas.php?status=deleted");
                            exit();
                        } else {
                            echo "Error al eliminar datos: " . mysqli_error($conectar);                           
                        }
                    }

                    // Mostrar registros existentes
                    $sql = "SELECT id, producto, precio, cantidad FROM registro_ventas";
                    $result = $conectar->query($sql);

                    // Verificar si la consulta se ejecutó correctamente
                    if ($result) {
                        // Iterar sobre cada fila de resultados
                        while ($datos = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $datos['id'] . "</td>";
                            echo "<td>" . $datos['producto'] . "</td>";
                            echo "<td>" . $datos['precio'] . "</td>";
                            echo "<td>" . $datos['cantidad'] . "</td>";
                            echo "<td>";
                            // Botón Editar
                            echo '<a href="registro_ventas.php?edit_id=' . $datos['id'] . '&edit_producto=' . $datos['producto'] . '&edit_precio=' . $datos['precio'] . '&edit_cantidad=' . $datos['cantidad'] . '" class="btn btn-small btn-warning">Editar</a> ';
                            // Botón Eliminar
                            echo '<a href="registro_ventas.php?delete_id=' . $datos['id'] . '" onclick="return confirm(\'¿Estás seguro de que deseas eliminar este registro?\');" class="btn btn-small btn-danger">Eliminar</a>';
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>Error al ejecutar la consulta: " . mysqli_error($conectar) . "</td></tr>";
                    }

                    // Cerrar la conexión
                    mysqli_close($conectar);
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
