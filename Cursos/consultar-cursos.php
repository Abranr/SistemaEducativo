<?php
$servidor = "127.0.0.1:3310";
$nombreBD = "GestionAcademica";
$usuario = "root";
$contrasenia = "";

// Verificar si la conexión fue exitosa
try {
    $conexion = new PDO("mysql:host=$servidor;dbname=$nombreBD", $usuario, $contrasenia);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}

// Obtener los cursos
$consultaSQL = "SELECT c.idCurso, c.Nombre, c.Descripcion, c.Creditos, c.Materia, c.idEstudiante
                FROM tbl_Cursos AS c
                LEFT JOIN tbl_Horarios AS h ON c.idHorario = h.idHorario"; // Verifica si el JOIN es necesario
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
    <title>Consultar Cursos</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 50px;
        }
        h1 {
            color: #007bff;
        }
        .btn-custom {
            background-color: #28a745;
            color: white;
        }
        .btn-custom:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mt-4 mb-4"><i class="fas fa-book-open"></i> Cursos Registrados</h1>
        <a href="../index.php" class="btn btn-primary mb-3"><i class="fas fa-arrow-left"></i> Volver al inicio</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Curso</th>
                    <th>Nombre del Curso</th>
                    <th>Descripción</th>
                    <th>Créditos</th>
                    <th>Materia</th>
                    <th>ID Estudiante</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($resultado)) {
                    foreach ($resultado as $fila) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($fila['idCurso'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($fila['Nombre'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($fila['Descripcion'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($fila['Creditos'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($fila['Materia'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($fila['idEstudiante'], ENT_QUOTES, 'UTF-8'); ?></td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr><td colspan="6" class="text-center">No hay cursos registrados</td></tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
