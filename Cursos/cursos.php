<?php 
require '../conexion.php'; // Asegúrate de que este archivo esté correctamente configurado para conectar a tu base de datos
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Cursos</title>
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
        <h1 class="mt-4 mb-4"><i class="fas fa-book-open"></i> Gestión de Cursos</h1>
        <a href="../index.php" class="btn btn-primary mb-3"><i class="fas fa-home"></i> Volver al Inicio</a>
        
        <!-- Formulario para crear cursos -->
        <h2 class="mt-4">Crear Curso</h2>
        <form action="cursos.php" method="POST">
            <div class="form-group">
                <label for="nombre">Nombre del Curso:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="creditos">Créditos:</label>
                <input type="number" class="form-control" id="creditos" name="creditos" required>
            </div>
            <div class="form-group">
                <label for="materia">Materia:</label>
                <input type="text" class="form-control" id="materia" name="materia" required>
            </div>
            <div class="form-group">
                <label for="idEstudiante">ID Estudiante:</label>
                <input type="number" class="form-control" id="idEstudiante" name="idEstudiante">
            </div>
            <button type="submit" name="guardarCurso" class="btn btn-custom"><i class="fas fa-save"></i> Guardar Curso</button>
            <a href="consultar-cursos.php" class="btn btn-info"><i class="fas fa-search"></i> Consultar Cursos</a>
        </form>

        <?php
        if (isset($_POST['guardarCurso'])) {
            // Recoger datos del formulario de cursos
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $creditos = $_POST['creditos'];
            $materia = $_POST['materia'];
            $idEstudiante = isset($_POST['idEstudiante']) && !empty($_POST['idEstudiante']) ? $_POST['idEstudiante'] : null;

            try {
                // Verificar si el idEstudiante existe en tbl_Estudiantes
                if ($idEstudiante !== null) {
                    $stmtCheckEstudiante = $conexion->prepare("SELECT COUNT(*) FROM tbl_estudiantes WHERE idEstudiante = :idEstudiante");
                    $stmtCheckEstudiante->bindParam(':idEstudiante', $idEstudiante, PDO::PARAM_INT);
                    $stmtCheckEstudiante->execute();
                    $estudianteExists = $stmtCheckEstudiante->fetchColumn();

                    if ($estudianteExists == 0) {
                        throw new Exception("El ID Estudiante proporcionado no existe.");
                    }
                }

                // Preparar la consulta SQL para insertar curso
                $query = "INSERT INTO tbl_Cursos (Nombre, Descripcion, Creditos, Materia, idEstudiante) 
                          VALUES (:nombre, :descripcion, :creditos, :materia, :idEstudiante)";
                $stmt = $conexion->prepare($query);
                $stmt->bindParam(':nombre', $nombre);
                $stmt->bindParam(':descripcion', $descripcion);
                $stmt->bindParam(':creditos', $creditos);
                $stmt->bindParam(':materia', $materia);
                $stmt->bindParam(':idEstudiante', $idEstudiante, PDO::PARAM_INT);

                // Ejecutar la consulta y manejar el resultado
                if ($stmt->execute()) {
                    echo "<div class='alert alert-success mt-3'>Curso guardado con éxito</div>";
                } else {
                    echo "<div class='alert alert-danger mt-3'>Error: " . htmlspecialchars($stmt->errorInfo()[2]) . "</div>";
                }
            } catch (Exception $e) {
                echo "<div class='alert alert-danger mt-3'>Error: " . htmlspecialchars($e->getMessage()) . "</div>";
            }
        }
        ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
