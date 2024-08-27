<?php
$servidor = "mysql.railway.internal";
$PORT = "3306";
$nombreBD = "railway";
$usuario = "root";
$contrasenia = "OMbXztenmYuxuqWwmyImhgAxgjuMfDsG";

try {
    //crear la conexion con PDO
    $conexion = new PDO("mysql:host=$servidor;port=$PORT; dbname=$nombreBD", $usuario, $contrasenia);
    //configurar la conexión PDO para que muestre los errores
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //mensaje de conexión exitosa
    // echo "Conexión exitosa";
} catch (PDOException $e) {
    echo "Conexión fallida: " . $e->getMessage();
}

?>