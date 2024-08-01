<?php
session_start(); // Asegúrate de iniciar la sesión al principio
include("conexcion.php");

if (isset($_POST["Cedula"]) && isset($_POST["Nombre"])) {
    $cedula = $_POST["Cedula"];
    $nombre = $_POST["Nombre"];

    // Sanitizar los datos recibidos
    $conectar = conn();
    $cedula = mysqli_real_escape_string($conectar, $cedula);
    $nombre = mysqli_real_escape_string($conectar, $nombre);

    // Consulta SQL para verificar si el usuario existe
    $sql = "SELECT * FROM registro WHERE Cedula = '$cedula' AND Nombre = '$nombre'";
    $resul = mysqli_query($conectar, $sql) or trigger_error("query failed SQL-ERROR:" . mysqli_error($conectar), E_USER_ERROR);

    if (mysqli_num_rows($resul) > 0) {
        // Iniciar sesión estableciendo una variable de sesión
        $_SESSION['sesion_email'] = $nombre;

        // Redirigir a la página principal
        $url = "Pag_principal/pag_principal.php";
        header("Location: $url");
        exit();
    } else {
        echo "La cédula o el nombre no existen en la base de datos.";
    }
} else {
    echo "Por favor, complete los campos de cédula y nombre.";
}
?>
