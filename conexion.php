<?php
$conexion = mysqli_connect("localhost","root","lolita1873","videos");

if (!$conexion) {
 die("Error de conexión (".mysqli_connect_errno().")".mysqli_connect_error());
} 
?>