<?php 
require '../conexion.php'; // Asegúrate de que la ruta sea correcta

// Verificar si la conexión fue exitosa
try {
    $conexion = new PDO("mysql:host=$servidor;dbname=$nombreBD", $usuario, $contrasenia);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Inscripciones</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto max-w-lg mt-12 p-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-center text-blue-600 mb-6">Gestión de Inscripciones</h1>
        <div class="flex justify-between mb-4">
            <a href="../index.php" class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">Volver al Inicio</a>
            <a href="../Estudiante/crear-estudiante.php" class="text-white bg-gray-500 hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5">Agregar Nuevo Estudiante</a>
        </div>
        <form action="inscripciones.php" method="POST">
            <div class="mb-4">
                <label for="idEstudiante" class="block text-gray-700 text-sm font-bold mb-2">Estudiante:</label>
                <select id="idEstudiante" name="idEstudiante" class="block appearance-none w-full bg-gray-50 border border-gray-300 text-gray-900 rounded-lg py-2 px-4 leading-tight focus:outline-none focus:bg-white focus:border-blue-500">
                    <?php
                    $stmt = $conexion->query("SELECT idEstudiante, Nombre, Apellido FROM tbl_Estudiantes");
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . htmlspecialchars($row['idEstudiante'], ENT_QUOTES, 'UTF-8') . "'>" . htmlspecialchars($row['Nombre'] . " " . $row['Apellido'], ENT_QUOTES, 'UTF-8') . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-4">
                <label for="idCursos" class="block text-gray-700 text-sm font-bold mb-2">Curso:</label>
                <select id="idCursos" name="idCursos" class="block appearance-none w-full bg-gray-50 border border-gray-300 text-gray-900 rounded-lg py-2 px-4 leading-tight focus:outline-none focus:bg-white focus:border-blue-500">
                    <?php
                    $stmt = $conexion->query("SELECT idCursos, Curso FROM tbl_Cursos");
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . htmlspecialchars($row['idCursos'], ENT_QUOTES, 'UTF-8') . "'>" . htmlspecialchars($row['Curso'], ENT_QUOTES, 'UTF-8') . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-4">
                <label for="fecha" class="block text-gray-700 text-sm font-bold mb-2">Fecha de Inscripción:</label>
                <input type="date" id="fecha" name="fecha" required class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <button type="submit" name="guardar" class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:ring-4 focus:ring-green-300">Guardar</button>
        </form>

        <?php
        if (isset($_POST['guardar'])) {
            $idEstudiante = $_POST['idEstudiante'];
            $idCursos = $_POST['idCursos'];
            $fecha = $_POST['fecha'];

            // Usar una declaración preparada para evitar inyecciones SQL
            $query = "INSERT INTO tbl_Inscripcion (idEstudiante, idCurso, FechaDeInscripcion) VALUES (:idEstudiante, :idCurso, :fecha)";
            $stmt = $conexion->prepare($query);
            $stmt->bindParam(':idEstudiante', $idEstudiante, PDO::PARAM_INT);
            $stmt->bindParam(':idCurso', $idCurso, PDO::PARAM_INT);
            $stmt->bindParam(':fecha', $fecha);

            try {
                if ($stmt->execute()) {
                    echo "<div class='mt-4 p-4 bg-green-100 text-green-700 rounded-lg'>Inscripción guardada con éxito</div>";
                } else {
                    echo "<div class='mt-4 p-4 bg-red-100 text-red-700 rounded-lg'>Error al guardar la inscripción</div>";
                }
            } catch (PDOException $e) {
                echo "<div class='mt-4 p-4 bg-red-100 text-red-700 rounded-lg'>Error: " . $e->getMessage() . "</div>";
            }
        }

        $conexion = null; // Cerrar la conexión
        ?>
    </div>
</body>
</html>
