<?php
include("../conexcion.php");
$nombre = $_POST["Nombre"];
$apellido = $_POST["Apellido"];
$telefono = $_POST["Telefono"];
$correo = $_POST["Correo"];
$cedula = $_POST["Cedula"];

$conectar = conn();
$sql = "INSERT INTO registro(Nombre, Apellido, Telefono, Correo, Cedula) VALUES('$nombre' , '$apellido', '$telefono' , '$correo' ,'$cedula')";

$resul = mysqli_query($conectar, $sql) or trigger_error(" query failed SQL-ERROR:".mysqli_error($conectar), E_USER_ERROR);

header("Location: ../login.html");
exit;




?>