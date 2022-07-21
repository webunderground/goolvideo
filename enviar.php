<?php 
// Llamamos al archivo de conexión a la base de datos
require("conexion.php");
 
//Creamos las variables con los nombres de los campos del formulario
$usuario = $_POST["usuario"];
$comentario = $_POST["comentario"];

// Codigo de insercion a la base de datos
$insertar = mysqli_query($conexion,"INSERT INTO comentarios (usuario,comentario) VALUES ('$usuario','$comentario')");

if (!$insertar) {
 echo "Error al guardar";
} else {
   header("Location: index.php");
}

mysqli_close($conexion);
?>