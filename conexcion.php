<?php
function conn()
{
    $hostname = "localhost";
    $usuariodb = "root";
    $passworddb = "";
    $dbname = "adso";

    $conectar = mysqli_connect($hostname, $usuariodb, $passworddb, $dbname);
    $conectar->set_charset("utf8");
    return $conectar;

    
}
$URL = "http://localhost/proyecto";
?>
