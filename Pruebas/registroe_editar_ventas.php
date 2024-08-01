<?php
include('../conexcion.php');

$id = $_GET['id'];
$result = $mysqli->query("SELECT * FROM registro_ventas WHERE id = $id");
$row = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Venta</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Editar Venta</h2>
        <form action="procesar.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <div class="form-group">
                <label for="codigo">Código</label>
                <input type="text" name="codigo" id="codigo" class="form-control" value="<?php echo $row['codigo']; ?>" required>
            </div>
            <div class="form-group">
                <label for="producto">Producto</label>
                <input type="text" name="producto" id="producto" class="form-control" value="<?php echo $row['producto']; ?>" required>
            </div>
            <div class="form-group">
                <label for="precio">Precio</label>
                <input type="number" step="0.01" name="precio" id="precio" class="form-control" value="<?php echo $row['precio']; ?>" required>
            </div>
            <div class="form-group">
                <label for="unidades">Unidades</label>
                <input type="number" name="unidades" id="unidades" class="form-control" value="<?php echo $row['unidades']; ?>" required>
            </div>
            <div class="form-group">
                <label for="descuento">Descuento</label>
                <input type="number" step="0.01" name="descuento" id="descuento" class="form-control" value="<?php echo $row['descuento']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</body>
</html>
