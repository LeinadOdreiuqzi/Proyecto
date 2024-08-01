CODIGO ANTERIOR (NO QUIERE FUNCIONAR)

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de ventas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <h1 class="text-center p-3">HOLAAA</h1>
    <div class="container-fluid">
        <div class="row">
            <!-- Formulario de Registro de Ventas -->
            <form class="col-4 p-3">
                <h3 class="text-center text-secondary">Registro de ventas</h3>
                <div class="mb-3">
                    <label for="id" class="form-label">ID</label>
                    <input type="text" class="form-control" name="id" id="id">
                </div>
                <div class="mb-3">
                    <label for="producto" class="form-label">Producto</label>
                    <input type="text" class="form-control" name="producto" id="producto">
                </div>
                <div class="mb-3">
                    <label for="precio" class="form-label">Precio</label>
                    <input type="text" class="form-control" name="precio" id="precio">
                </div>
                <div class="mb-3">
                    <label for="cantidad" class="form-label">Cantidad</label>
                    <input type="text" class="form-control" name="cantidad" id="cantidad">
                </div>
                <button type="submit" class="btn btn-primary" name="btnregistrar" value="ok">Registrar</button>
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
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        include("../conexcion.php");
                        $id= $_POST['id']?? null;
                        $producto= $_POST['producto']?? null;
                        $precio= $_POST['precio']?? null;
                        $cantidad= $_POST['cantidad']?? null;  
                        $conectar = conn();
                        $sql="INSERT INTO registro_ventas(id, producto, precio, cantidad) VALUES('$id' , '$producto', '$precio' , '$cantidad')";
                        $resul = mysqli_query($conectar, $sql) or trigger_error(" query failed SQL-ERROR:".mysqli_error($conectar), E_USER_ERROR); 
                        while ($datos = $resul->fetch_assoc()){
                                echo "<tr>";
                                echo "<td>" . $datos['id'] . "</td>";
                                echo "<td>" . $datos['producto'] . "</td>";
                                echo "<td>$" . $datos['precio'] . "</td>";
                                echo "<td>" . $datos['cantidad'] . "</td>";
                                echo "<td>";
                                echo '<a href="#" class="btn btn-small btn-warning">Editar</a>';
                                echo '<a href="#" class="btn btn-small btn-danger">Eliminar</a>';
                                echo "</td>";
                                echo "</tr>";
                        ?>
                        <?php }
                        ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
