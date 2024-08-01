<?php
session_start();

// Verificar si la sesión está iniciada
if (isset($_SESSION['sesion_email'])) {
    session_unset(); // Elimina todas las variables de sesión
    session_destroy(); // Destruye la sesión

    // Redirigir al login
    header('Location: ../../../login.html');
    exit();
} else {
    // Si no hay sesión, redirigir al login directamente
    header('Location: ../../../login.html');
    exit();
}
?>
