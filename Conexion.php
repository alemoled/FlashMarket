<?php
// Definir el servidor de la base de datos
$_Servidor ="localhost";
// Definir el usuario de la base de datos
$_Usuario ="admin";
// Definir la contraseña de la base de datos
$_password ="admin";
// Definir el nombre de la base de datos
$_bd ="tienda_bd";

// Crear una nueva conexión a la base de datos
$_conexion = new mysqli($_Servidor,$_Usuario,$_password,$_bd);

// Verificar si hay algún error en la conexión
if($_conexion -> connect_error){
    // Si hay un error, terminar el script y mostrar el error
    die("Error en el conexion" .  $connect_error -> connect_error);
}else{
    // Si no hay error, mostrar un mensaje de éxito
    echo "Furula";
}
?>