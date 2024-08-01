<?php
include('../conexcion.php');

$id = $_GET['id'];
$mysqli->query("DELETE FROM historial_ventas WHERE id = $id");

header("Location: index.php");
?>
