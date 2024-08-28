<?php
require '../conexion.php';

// Manejo del formulario para guardar un nuevo horario
if (isset($_POST['guardar'])) {
    $curso = $_POST['curso'];
    $profesor = $_POST['profesor']; // Asegúrate de que este nombre coincide con el del formulario
    $dia = $_POST['dia'];
    $hora = $_POST['hora'];

    $query = "INSERT INTO tbl_Horarios (idCurso, idProfesor, Dia, Hora) VALUES (:curso, :profesor, :dia, :hora)";
    $stmt = $conexion->prepare($query);
    $stmt->bindParam(':curso', $curso);
    $stmt->bindParam(':profesor', $profesor);
    $stmt->bindParam(':dia', $dia);
    $stmt->bindParam(':hora', $hora);

    if ($stmt->execute()) {
        $mensaje = "<div class='bg-green-100 text-green-700 p-4 rounded mt-4'>Horario guardado con éxito</div>";
    } else {
        $mensaje = "<div class='bg-red-100 text-red-700 p-4 rounded mt-4'>Error: " . htmlspecialchars($stmt->errorInfo()[2], ENT_QUOTES, 'UTF-8') . "</div>";
    }
}

// Manejo del formulario para consultar horarios
if (isset($_POST['consultar'])) {
    $query = "SELECT h.Dia, h.Hora, c.Nombre AS Curso 
              FROM tbl_horarios h
              JOIN tbl_cursos c ON h.idCurso = c.idCurso
              ORDER BY h.Dia ASC, h.Hora ASC";
    $stmt = $conexion->prepare($query);
    $stmt->execute();
    $horarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Horarios</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Gestión de Horarios</h1>
        <a href="../index.php" class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-6">Volver al Inicio</a>
        
        <form action="horarios.php" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            <div class="mb-4">
                <label for="curso" class="block text-sm font-medium text-gray-700">Curso:</label>
                <select id="curso" name="curso" required class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <?php
                    $cursosQuery = "SELECT idCurso, Nombre FROM tbl_cursos";
                    $stmtCursos = $conexion->prepare($cursosQuery);
                    $stmtCursos->execute();
                    $cursos = $stmtCursos->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($cursos as $curso) { ?>
                        <option value="<?php echo htmlspecialchars($curso['idCurso'], ENT_QUOTES, 'UTF-8'); ?>">
                            <?php echo htmlspecialchars($curso['Nombre'], ENT_QUOTES, 'UTF-8'); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            
            <div class="mb-4">
                <label for="profesor" class="block text-sm font-medium text-gray-700">Profesor:</label>
                <select id="profesor" name="profesor" required class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <?php
                    $profesoresQuery = "SELECT idProfesor, Nombre FROM tbl_profesores";
                    $stmtProfesores = $conexion->prepare($profesoresQuery);
                    $stmtProfesores->execute();
                    $profesores = $stmtProfesores->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($profesores as $profesor) { ?>
                        <option value="<?php echo htmlspecialchars($profesor['idProfesor'], ENT_QUOTES, 'UTF-8'); ?>">
                            <?php echo htmlspecialchars($profesor['Nombre'], ENT_QUOTES, 'UTF-8'); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            
            <div class="mb-4">
                <label for="dia" class="block text-sm font-medium text-gray-700">Día:</label>
                <select id="dia" name="dia" required class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <?php
                    $diasSemana = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
                    foreach ($diasSemana as $dia) { ?>
                        <option value="<?php echo htmlspecialchars($dia, ENT_QUOTES, 'UTF-8'); ?>">
                            <?php echo htmlspecialchars($dia, ENT_QUOTES, 'UTF-8'); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            
            <div class="mb-4">
                <label for="hora" class="block text-sm font-medium text-gray-700">Hora:</label>
                <input type="time" id="hora" name="hora" required class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            
            <div class="flex space-x-2">
                <button type="submit" name="guardar" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Guardar</button>
                <button type="submit" name="consultar" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Consultar Horarios</button>
            </div>
        </form>

        <?php if (isset($mensaje)) echo $mensaje; ?>

        <?php if (isset($horarios) && $horarios) { ?>
            <table class='min-w-full bg-white mt-4'>
                <thead class='bg-gray-50'>
                    <tr>
                        <th class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>Curso</th>
                        <th class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>Día</th>
                        <th class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>Hora</th>
                    </tr>
                </thead>
                <tbody class='bg-white divide-y divide-gray-200'>
                    <?php foreach ($horarios as $horario) { ?>
                        <tr>
                            <td class='px-6 py-4 whitespace-nowrap'><?php echo htmlspecialchars($horario['Curso'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td class='px-6 py-4 whitespace-nowrap'><?php echo htmlspecialchars($horario['Dia'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td class='px-6 py-4 whitespace-nowrap'><?php echo htmlspecialchars($horario['Hora'], ENT_QUOTES, 'UTF-8'); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } elseif (isset($horarios)) { ?>
            <div class='bg-yellow-100 text-yellow-700 p-4 rounded mt-4'>No se encontraron horarios registrados</div>
        <?php } ?>
    </div>
</body>
</html>