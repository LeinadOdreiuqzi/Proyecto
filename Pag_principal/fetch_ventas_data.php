<?php
header('Content-Type: application/json');
include("../conexcion.php");

$conectar = conn();
if (!$conectar) {
    echo json_encode(['error' => 'Error al conectar con la base de datos']);
    exit();
}

// Suponiendo que quieres sumar el total de ventas por producto
$sql = "SELECT producto, SUM(precio * cantidad) AS total_ventas FROM registro_ventas GROUP BY producto";
$result = $conectar->query($sql);

$labels = [];
$values = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        // Verifica si el valor del producto y el total de ventas son válidos
        if ($row['producto'] && $row['total_ventas']) {
            $labels[] = $row['producto'];
            $values[] = (float) $row['total_ventas']; // Asegúrate de que los valores son numéricos
        }
    }
    echo json_encode(['labels' => $labels, 'values' => $values]);
} else {
    echo json_encode(['error' => 'Error al ejecutar la consulta']);
}

mysqli_close($conectar);
?>
