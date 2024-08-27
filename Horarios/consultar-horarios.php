<?php
require '../conexion.php'; // Asegúrate de que la ruta sea correcta

// Obtener los horarios junto con los cursos
$consultaSQL = "SELECT h.idHorario, h.idCurso, h.idProfesor, h.Dia, h.Hora, c.Materia
                FROM tbl_Horarios h 
                JOIN tbl_Cursos c ON h.idCurso = c.idCurso";
$sentenciaConsulta = $conexion->prepare($consultaSQL);

try {
    $sentenciaConsulta->execute();
    $resultado = $sentenciaConsulta->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Horarios</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .table {
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
        }
        .table thead th {
            background-color: #007bff;
            color: #ffffff;
            text-align: center;
        }
        .table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .table tbody tr:hover {
            background-color: #e9ecef;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-4">Horarios Registrados</h1>
        <a href="../index.php" class="btn btn-primary mb-3">Volver al Inicio</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Horario</th>
                    <th>ID Curso</th>
                    <th>ID Profesor</th>
                    <th>Dia</th>
                    <th>Hora</th>
                    <th>Curso</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($resultado)) {
                    foreach ($resultado as $fila) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($fila['idHorario'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($fila['idCurso'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($fila['idProfesor'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($fila['Dia'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($fila['Hora'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($fila['Materia'], ENT_QUOTES, 'UTF-8'); ?></td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr><td colspan="6" class="text-center">No hay horarios registrados</td></tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
