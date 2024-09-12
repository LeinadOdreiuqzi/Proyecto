<?php
header('Content-Type: application/json');
include("../conexcion.php");

$conectar = conn();
if (!$conectar) {
    echo json_encode(['error' => 'Error al conectar con la base de datos']);
    exit();
}

// Consulta para obtener el total de inventario por fecha
$sql = "SELECT fecha, SUM(cantidad * precio_venta) AS total_inventario FROM inventario WHERE fecha != '0000-00-00' GROUP BY fecha";
$result = $conectar->query($sql);

$labels = [];
$values = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        // Verifica si el valor de fecha es válido
        if ($row['fecha'] && $row['total_inventario']) {
            $labels[] = $row['fecha'];
            $values[] = (float) $row['total_inventario']; // Asegúrate de que los valores son numéricos
        }
    }
    echo json_encode(['labels' => $labels, 'values' => $values]);
} else {
    echo json_encode(['error' => 'Error al ejecutar la consulta']);
}

mysqli_close($conectar);
?>
