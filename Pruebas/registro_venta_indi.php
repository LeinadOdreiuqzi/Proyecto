<?php

include("../conexcion.php");

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $mysqli->prepare("SELECT id, codigo, producto, precio, unidades, descuento, gran_total FROM historial_ventas WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
}
   
