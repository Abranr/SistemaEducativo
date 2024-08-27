<?php
require '../conexion.php';

if (isset($_GET['idEstudianteAct'])) {
    $id = filter_var($_GET['idEstudianteAct'], FILTER_SANITIZE_NUMBER_INT);
    
    $consultaSQL = "SELECT * FROM tbl_estudiantes WHERE idEstudiante = :id";
    $sentencia = $conexion->prepare($consultaSQL);
    $sentencia->bindParam(':id', $id, PDO::PARAM_INT);
    $sentencia->execute();

    $estudiante = $sentencia->fetch(PDO::FETCH_ASSOC);

    if ($estudiante === false) {
        echo "Estudiante no encontrado";
        exit;
    }
} else {
    echo "ID del estudiante no especificado";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombreInp'];
    $apellido = $_POST['apellidoInp'];
    $correo = $_POST['CorreoInp'];
    $telefono = $_POST['telefonoInp'];
    $id = $_POST['idEstudiante'];

    if ($correo === false) {
        echo "Correo electrónico inválido";
        exit;
    }

    $actualizarSQL = "UPDATE tbl_estudiantes 
                      SET Nombre = :nombre, Apellido = :apellido, Correo = :correo, Telefono = :telefono 
                      WHERE idEstudiante = :id";
    
    $sentencia = $conexion->prepare($actualizarSQL);
    $sentencia->bindParam(':nombre', $nombre);
    $sentencia->bindParam(':apellido', $apellido);
    $sentencia->bindParam(':correo', $correo);
    $sentencia->bindParam(':telefono', $telefono);
    $sentencia->bindParam(':id', $id, PDO::PARAM_INT);

    try {
        if ($sentencia->execute()) {
            header('Location: consultar-estudiante.php?success=1');
            exit;
        } else {
            $errorInfo = $sentencia->errorInfo();
            echo "Error al actualizar el estudiante: " . $errorInfo[2];
        }
    } catch (PDOException $e) {
        error_log("Error al actualizar el estudiante: " . $e->getMessage());
        echo "Hubo un error al actualizar el estudiante. Por favor, inténtelo de nuevo más tarde.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.4.0/flowbite.min.css" rel="stylesheet">
    <title>Actualizar Estudiante</title>
</head>
<body class="bg-gray-100">

<div class="container mx-auto my-10 p-10 bg-white shadow-lg rounded-lg max-w-4xl">
    <h2 class="text-3xl font-bold mb-6">Actualizar Estudiante</h2>
    <form method="post" action="">
        <input type="hidden" name="idEstudiante" value="<?php echo htmlspecialchars($estudiante['idEstudiante'], ENT_QUOTES, 'UTF-8'); ?>">
        <div class="mb-6">
            <label for="nombreInp" class="block text-gray-700 text-lg">Nombre:</label>
            <input type="text" class="mt-1 block w-full p-3 border border-gray-300 rounded-lg" id="nombreInp" name="nombreInp" value="<?php echo htmlspecialchars($estudiante['Nombre'], ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
        <div class="mb-6">
            <label for="apellidoInp" class="block text-gray-700 text-lg">Apellido:</label>
            <input type="text" class="mt-1 block w-full p-3 border border-gray-300 rounded-lg" id="apellidoInp" name="apellidoInp" value="<?php echo htmlspecialchars($estudiante['Apellido'], ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
        <div class="mb-6">
            <label for="CorreoInp" class="block text-gray-700 text-lg">Correo:</label>
            <input type="email" class="mt-1 block w-full p-3 border border-gray-300 rounded-lg" id="CorreoInp" name="CorreoInp" value="<?php echo htmlspecialchars($estudiante['Correo'], ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
        <div class="mb-6">
            <label for="telefonoInp" class="block text-gray-700 text-lg">Teléfono:</label>
            <input type="text" class="mt-1 block w-full p-3 border border-gray-300 rounded-lg" id="telefonoInp" name="telefonoInp" value="<?php echo htmlspecialchars($estudiante['Telefono'], ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 text-white py-3 px-6 rounded-lg hover:bg-blue-600 text-lg mr-2">Actualizar</button>
            <a href="consultar-estudiante.php" class="bg-red-500 text-white py-3 px-6 rounded-lg hover:bg-red-600 text-lg">Cancelar</a>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/flowbite@1.4.0/dist/flowbite.min.js"></script>
</body>
</html>
