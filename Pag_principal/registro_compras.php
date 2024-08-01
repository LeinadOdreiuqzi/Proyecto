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
            justify-content: space-between;
        }
    </style>
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
            <h4 style="padding-left: 120px;">Bienvenido al registro de compras</h4>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="content-container">
            <!-- Formulario de Registro de Ventas -->
            <form class="col-4 p-3" method="POST" action="registro_compras.php">
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
                    <input type="int" class="form-control" name="total" id="total" value="<?php echo $_GET['edit_total'] ?? ''; ?>"> 
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripcion</label>
                    <input type="text" class="form-control" name="descripcion" id="descripcion" value="<?php echo $_GET['edit_descripcion'] ?? ''; ?>">
                </div>
                <div class="mb-3">
                    <label for="metodo_pago" class="form-label">Metodo de pago</label>
                    <input type="text" class="form-control" name="metodo_pago" id="metodo_pago" value="<?php echo $_GET['edit_metodo_pago'] ?? ''; ?>">
                </div>
<!--                 <div class="mb-3">
                    <label for="estado" class="form-label">Estado de la venta:</label>
                    <select name="estado" class="form-control" id="estado" value="<?php echo $_GET['edit_estado'] ?? ''; ?>">
                        <option value="">--Estado de la compra--</option>
                        <option value="pendiente">Pendiente</option>
                        <option value="aprobada">Aprobada</option>
                        <option value="en_proceso">En proceso</option>
                        <option value="enviado">Enviado</option>
                        <option value="entregado">Entregado</option>
                        <option value="cancelado">Cancelado</option>
                        <option value="devuelto">Devuelto</option>
                        <option value="reembolsado">Reembolsado</option>
                        <option value="en_revision">En revisión</option>
                        <option value="preparado_envio">Preparado para envío</option>
                    </select>
                </div> -->
                <button type="submit" class="btn btn-primary" name="btnregistrar" value="ok">Registrar</button>
                <?php if (isset($_GET['edit_id'])): ?>
                    <input type="hidden" name="id" value="<?php echo $_GET['edit_id']; ?>">
                    <button type="submit" class="btn btn-secondary" name="btneditar" value="ok">Actualizar</button>
                <?php endif; ?>
            </form>
            <!-- Tabla de Registros de Compras -->
            <div class="col-8 p-3">
                <h1 class="text-center p-4">Registro de compras</h1>
                <table class="table">
                    <thead class="bg-info">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Proveedor</th>
                            <th scope="col">Total</th>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Metodo de pago</th>
<!--                             <th scope="col">Estado de la venta</th>
 -->                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        include("../conexcion.php");

                        $conectar = conn();
                        if (!$conectar) {
                            die("Error al conectar con la base de datos" . mysqli_connect_error());
                        }

                        if (isset($_POST['btnregistrar']) && $_POST['btnregistrar'] == 'ok') {
                            $fecha = $_POST['fecha'];
                            $proveedor = $_POST['proveedor'];
                            $total = $_POST['total'];
                            $descripcion = $_POST['descripcion'];
                            $metodo_pago = $_POST['metodo_pago'];
                            //$estado = $_POST['estado'];

                            $fecha = mysqli_real_escape_string($conectar, $fecha);
                            $proveedor = mysqli_real_escape_string($conectar, $proveedor);
                            $total = mysqli_real_escape_string($conectar, $total);
                            $descripcion = mysqli_real_escape_string($conectar, $descripcion);
                            $metodo_pago = mysqli_real_escape_string($conectar, $metodo_pago);
                            //$estado = mysqli_real_escape_string($conectar, $estado);

                            $query = "INSERT INTO registro_compras (fecha, proveedor, total, descripcion, metodo_pago) VALUES ('$fecha', '$proveedor', '$total', '$descripcion', '$metodo_pago')";
                            if (mysqli_query($conectar, $query)) {
                                //header("Location: registro_compras.php?status=success");
                                echo '<script>window.location="registro_compras.php?status=success"</script>';
                                exit();
                            } else {
                                echo "Error al insertar los datos " . mysqli_error($conectar);
                            }
                        }

                        if (isset($_POST['btneditar']) && $_POST['btneditar'] == 'ok') {
                            $id = $_POST['id'];
                            $fecha = $_POST['fecha'];
                            $proveedor = $_POST['proveedor'];
                            $total = $_POST['total'];
                            $descripcion = $_POST['descripcion'];
                            $metodo_pago = $_POST['metodo_pago'];
                            //$estado = $_POST['estado'];

                            $id = mysqli_real_escape_string($conectar, $id);
                            $fecha = mysqli_real_escape_string($conectar, $fecha);
                            $proveedor = mysqli_real_escape_string($conectar, $proveedor);
                            $total = mysqli_real_escape_string($conectar, $total);
                            $descripcion = mysqli_real_escape_string($conectar, $descripcion);
                            $metodo_pago = mysqli_real_escape_string($conectar, $metodo_pago);
                            //$estado = mysqli_real_escape_string($conectar, $estado);

                            $query = "UPDATE registro_compras SET fecha='$fecha',proveedor='$proveedor',total='$total',descripcion='$descripcion',metodo_pago='$metodo_pago' WHERE id='$id'";
                            if (mysqli_query($conectar, $query)) {
                                //header("Location: registro_compras.php?status=updated");
                                echo '<script>window.location="registro_compras.php?status=updated"</script>';
                                exit();
                            } else {
                                echo "Error al actualizar datos: " . mysqli_error($conectar);
                            }
                        }

                        if (isset($_GET['delete_id'])) {
                            $id = $_GET['delete_id'];

                            $id = mysqli_real_escape_string($conectar, $id);

                            $query = "DELETE FROM registro_compras WHERE id='$id' LIMIT 1";
                            if (mysqli_query($conectar, $query)) {
                                //header("Location: registro_compras.php?status=deleted");
                                echo '<script>window.location="registro_compras.php?status=deleted"</script>';
                                exit();
                            } else {
                                echo "Error al eliminar datos: " . mysqli_error($conectar);
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
                                //echo "<td>" . $datos['estado'] . "</td>";
                                echo "<td>";
                                // Botón Editar
                                echo '<a href="registro_compras.php?edit_id=' . $datos['id'] . '&edit_fecha=' . $datos['fecha'] . '&edit_proveedor=' . $datos['proveedor'] . '&edit_total=' . $datos['total'] . '&edit_descripcion=' . $datos['descripcion'] . '&edit_metodo_pago=' . $datos['metodo_pago'] .'" class="btn btn-small btn-warning">Editar</a> ';
                                // Botón Eliminar
                                echo '<a href="registro_compras.php?delete_id=' . $datos['id'] . '" onclick="return confirm(\'¿Estás seguro de que deseas eliminar este registro?\');" class="btn btn-small btn-danger">Eliminar</a>';
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            // Mostrar mensaje de error si la consulta falló
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