<?php
require '../conexion.php'; // Asegúrate de que este archivo esté correctamente configurado para conectar a tu base de datos

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Profesores</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f3f4f6;
            font-family: 'Roboto', sans-serif;
        }
        .container {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 50px;
        }
        h1 {
            color: #007bff;
            text-align: center;
            margin-bottom: 30px;
        }
        .btn-custom {
            background-color: #28a745;
            color: white;
        }
        .btn-custom:hover {
            background-color: #218838;
        }
        .form-label {
            font-weight: 500;
        }
        .alert {
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><i class="bi bi-person-plus-fill"></i> Gestión de Profesores</h1>
        <a href="../index.php" class="btn btn-primary mb-3"><i class="bi bi-arrow-left-circle"></i> Volver al Inicio</a>
        <form action="profesores.php" method="POST">
            <div class="form-group">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="apellido" class="form-label">Apellido:</label>
                <input type="text" class="form-control" id="apellido" name="apellido" required>
            </div>
            <div class="form-group">
                <label for="telefono" class="form-label">Teléfono:</label>
                <input type="text" class="form-control" id="telefono" name="telefono">
            </div>
            <div class="form-group">
                <label for="correo" class="form-label">Correo:</label>
                <input type="email" class="form-control" id="correo" name="correo">
            </div>
            <div class="form-group">
                <label for="especialidad" class="form-label">Especialidad:</label>
                <input type="text" class="form-control" id="especialidad" name="especialidad">
            </div>
            <div class="form-group">
                <label for="idCurso" class="form-label">Curso:</label>
                <select class="form-control" id="idCurso" name="idCurso" required>
                    <?php
                    try {
                        $stmt = $conexion->query("SELECT idCurso, Nombre FROM tbl_cursos");
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='" . htmlspecialchars($row['idCurso'], ENT_QUOTES, 'UTF-8') . "'>" . htmlspecialchars($row['Nombre'], ENT_QUOTES, 'UTF-8') . "</option>";
                        }
                    } catch (PDOException $e) {
                        echo "<option value=''>Error al cargar cursos</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" name="guardar" class="btn btn-custom"><i class="bi bi-save"></i> Guardar</button>
        </form>

        <?php
        if (isset($_POST['guardar'])) {
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $telefono = $_POST['telefono'];
            $correo = $_POST['correo'];
            $especialidad = $_POST['especialidad'];
            $idCurso = $_POST['idCurso'];

            $query = "INSERT INTO tbl_profesores (Nombre, Apellido, Telefono, Correo, Especialidad, idCurso) 
                      VALUES (:nombre, :apellido, :telefono, :correo, :especialidad, :idCurso)";
            $stmt = $conexion->prepare($query);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':apellido', $apellido);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':especialidad', $especialidad);
            $stmt->bindParam(':idCurso', $idCurso, PDO::PARAM_INT);

            try {
                if ($stmt->execute()) {
                    echo "<div class='alert alert-success mt-3'>Profesor guardado con éxito</div>";
                } else {
                    echo "<div class='alert alert-danger mt-3'>Error al guardar el profesor</div>";
                }
            } catch (PDOException $e) {
                echo "<div class='alert alert-danger mt-3'>Error: " . htmlspecialchars($e->getMessage()) . "</div>";
            }
        }

        $conexion = null; // Cerrar la conexión
        ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
