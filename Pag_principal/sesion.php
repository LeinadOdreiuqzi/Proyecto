<?php
session_start();
include("../conexcion.php");
// Verificar si la sesión está iniciada
if (!isset($_SESSION['sesion_email'])) {
  // Si no hay sesión activa, redirigir al login
  header('Location: ../login.html');
  exit();
}
?>