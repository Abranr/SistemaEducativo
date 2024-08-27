<?php 
    require '../conexion.php'; // Asegúrate de que la ruta sea correcta

    // Verificar si la conexión fue exitosa
    try {
        $conexion = new PDO("mysql:host=$servidor;dbname=$nombreBD", $usuario, $contrasenia);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Error en la conexión: " . $e->getMessage());
    }

    // Obtener las notas
    $consultaSQL = "SELECT n.idNotas, e.idEstudiante, e.Nombre, e.Apellido, c.idCurso,c.Materia, n.Nota 
                    FROM tbl_Notas n
                    JOIN tbl_Estudiantes e ON n.idEstudiante = e.idEstudiante
                    JOIN tbl_Cursos c ON n.idCurso = c.idCurso";
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
    <title>Consultar Notas</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            margin-top: 50px;
        }
        .table {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .table thead th {
            background-color: #007bff;
            color: #ffffff;
            text-align: center;
            font-weight: bold;
        }
        .table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .table tbody tr:hover {
            background-color: #e2e6ea;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        h1 {
            color: #343a40;
            font-weight: bold;
        }
        .text-center {
            text-align: center;
        }
        .mb-4 {
            margin-bottom: 1.5rem;
        }
        .mb-3 {
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-4">Notas Registradas</h1>
        <a href="../index.php" class="btn btn-primary mb-3">Volver al inicio</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Nota</th>
                    <th>ID Estudiante</th>
                    <th>Curso</th>
                    <th>Nota</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($resultado)) {
                    foreach ($resultado as $fila) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($fila['idNotas'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($fila['Nombre'] . " " . $fila['Apellido'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($fila['Materia'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($fila['Nota'], ENT_QUOTES, 'UTF-8'); ?></td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr><td colspan="4" class="text-center">No hay notas registradas</td></tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
