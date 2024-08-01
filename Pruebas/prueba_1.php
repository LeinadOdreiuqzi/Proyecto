<?php
    require ("conexcion.php");
    $conectar = conn();
    $sql =("SELECT * FROM registro_ventas");
    ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>registro ventas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <br>
    <div class="container">
        <h1 class="text-center"style="background-color: black; color:red"whiter>LISTADO de productos</h1>
    </div>
    <br>
    <div class="container">
    <table class="table">
  <thead>
    <tr>
      <th scope="col">id/th>
      <th scope="col">producto</th>
      <th scope="col">preciot</th>
      <th scope="col">unidad</th>
      <th scope="col">total</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row"><?php echo $resul['id']</th>
      <th scope="row"><?php echo $resul['producto']</th>
      <th scope="row"><?php echo $resul['precio']</th>
      <th scope="row"><?php echo $resul['unidad']</th>
      <th scope="row"><?php echo $resul['descuento']</th>
      <th scope="row"><?php echo $resul['total']</th>
      <th scope="row"><?php echo $resul['codigo']</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td colspan="2">Larry the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>