<?php
require '../conexion.php';

if (isset($_GET['IdEstudianteEli'])) {
    $id = $_GET['IdEstudianteEli'];

    $consultaSQL = "DELETE FROM tbl_Estudiantes WHERE idEstudiante = :id";
    $sentencia = $conexion->prepare($consultaSQL);
    $sentencia->bindParam(':id', $id, PDO::PARAM_INT); // Especifica el tipo de parámetro como entero

    try {
        $sentencia->execute();
        header("Location: consultar-estudiante.php"); // Redirige después de la eliminación
        exit; // Asegúrate de salir después de redirigir
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "ID de estudiante no proporcionado.";
}
?>
