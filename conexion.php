<?php
$servidor = "127.0.0.1:3310";
$nombreBD = "GestionAcademica";
$usuario = "root";
$contrasenia = "";

try {
    //crear la conexion con PDO
    $conexion = new PDO("mysql:host=$servidor; dbname=$nombreBD", $usuario, $contrasenia);
    //configurar la conexión PDO para que muestre los errores
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //mensaje de conexión exitosa
    // echo "Conexión exitosa";
} catch (PDOException $e) {
    echo "Conexión fallida: " . $e->getMessage();
}

?>