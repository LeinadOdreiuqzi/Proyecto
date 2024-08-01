<?php
session_start();
include('../conexcion.php');

// Verificar si la sesión está iniciada
if (!isset($_SESSION['sesion_email'])) {
    echo "No hay sesión activa, redirigiendo al login.";
    header('Location:');
    exit();
} else {
    echo "Sesión activa para " . $_SESSION['sesion_email'];
}
?>
