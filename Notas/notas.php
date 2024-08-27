<?php

    // Incluir el archivo de conexión
    require '../conexion.php';

    // Verificar si se envió el formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtener los datos del formulario
        $idEstudiante = $_POST['id_estudiante'];
        $idProfesor = $_POST['id_profesor'];
        $idCurso = $_POST['id_curso'];
        $nota = $_POST['nota'];

        // Validar los datos
        if (!is_numeric($idEstudiante) || !is_numeric($idProfesor) || !is_numeric($idCurso) || !is_numeric($nota)) {
            $error = "Los IDs y la nota deben ser valores numéricos.";
        } elseif ($nota < 0 || $nota > 100) {
            $error = "La nota debe estar entre 0 y 100.";
        } else {
            try {
                // Preparar la consulta SQL
                $query = "INSERT INTO tbl_Notas (idEstudiante, idCurso, idProfesor, Nota) VALUES (:idEstudiante, :idCurso, :idProfesor, :nota)";
                $stmt = $conexion->prepare($query);
                $stmt->bindParam(':idEstudiante', $idEstudiante, PDO::PARAM_INT);
                $stmt->bindParam(':idCurso', $idCurso, PDO::PARAM_INT);
                $stmt->bindParam(':idProfesor', $idProfesor, PDO::PARAM_INT);
                $stmt->bindParam(':nota', $nota, PDO::PARAM_INT);

                // Ejecutar la consulta
                if ($stmt->execute()) {
                    $success = "Nota creada con éxito.";
                } else {
                    $error = "Error al crear la nota.";
                }
            } catch (PDOException $e) {
                $error = "Error: " . $e->getMessage();
            }
        }

        // Cerrar la conexión
        $conexion = null;
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nota</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto max-w-lg mt-12 p-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-center text-blue-600 mb-6">Crear Nota</h1>
        <a href="../index.php" class="block text-center mb-4 text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">Volver al Inicio</a>

        <!-- Mostrar mensaje de éxito o error -->
        <?php if (isset($success)) : ?>
            <div class="mt-4 p-4 bg-green-100 text-green-700 rounded-lg"><?= $success ?></div>
        <?php elseif (isset($error)) : ?>
            <div class="mt-4 p-4 bg-red-100 text-red-700 rounded-lg"><?= $error ?></div>
        <?php endif; ?>

        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <div class="mb-4">
                <label for="id_estudiante" class="block text-gray-700 text-sm font-bold mb-2">ID Estudiante:</label>
                <input type="number" id="id_estudiante" name="id_estudiante" required class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div class="mb-4">
                <label for="id_profesor" class="block text-gray-700 text-sm font-bold mb-2">ID Profesor:</label>
                <input type="number" id="id_profesor" name="id_profesor" required class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div class="mb-4">
                <label for="id_curso" class="block text-gray-700 text-sm font-bold mb-2">ID Curso:</label>
                <input type="number" id="id_curso" name="id_curso" required class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div class="mb-4">
                <label for="nota" class="block text-gray-700 text-sm font-bold mb-2">Nota:</label>
                <input type="number" id="nota" name="nota" required class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div class="flex space-x-4">
                <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:ring-4 focus:ring-green-300">Guardar Nota</button>
            </div>
        </form>
    </div>
</body>
</html>