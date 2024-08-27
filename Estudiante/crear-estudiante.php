<?php
    require '../conexion.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Sanitización de datos de entrada
        $nombre = htmlspecialchars(trim($_POST['nombre']));
        $apellido = htmlspecialchars(trim($_POST['apellido']));
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $telefono = htmlspecialchars(trim($_POST['telefono']));

        // Validación básica del email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>
                    Swal.fire({
                        title: 'Error!',
                        text: 'El email proporcionado no es válido.',
                        icon: 'error',
                        confirmButtonText: 'Aceptar'
                    });
                </script>";
            exit;
        }

        $insertarSQL = "INSERT INTO tbl_estudiantes (Nombre, Apellido, Correo, Telefono) 
                        VALUES (:nombre, :apellido, :email, :telefono)";
        
        $sentencia = $conexion->prepare($insertarSQL);

        $sentencia->bindParam(':nombre', $nombre);
        $sentencia->bindParam(':apellido', $apellido);
        $sentencia->bindParam(':email', $email);
        $sentencia->bindParam(':telefono', $telefono);

        if ($sentencia->execute()) {
            echo "<script>
                    Swal.fire({
                        title: 'Éxito!',
                        text: 'Estudiante eliminado exitosamente.',
                        icon: 'success',
                        confirmButtonText: 'Aceptar'
                    }).then(() => {
                        window.location.href = './consultar-estudiante.php';
                    });
                </script>";
            exit;
        } else {
            echo "<script>
                    Swal.fire({
                        title: 'Error!',
                        text: 'Error al eliminar el estudiante.',
                        icon: 'error',
                        confirmButtonText: 'Aceptar'
                    }).then(() => {
                        window.location.href = './consultar-estudiante.php';
                    });
                </script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Estudiante</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100">
    <div class="flex justify-center items-center min-h-screen">
        <div class="w-full max-w-4xl">
            <div class="bg-white shadow-lg rounded-lg">
                <div class="bg-blue-500 text-white text-center py-6 rounded-t-lg">
                    <h2 class="text-3xl font-bold">Crear Estudiante</h2>
                </div>
                <div class="p-8">
                    <form method="post" action="crear-estudiante.php">
                        <div class="mb-6">
                            <label for="nombre" class="block text-gray-700 text-lg">Nombre:</label>
                            <input type="text" id="nombre" name="nombre" class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        <div class="mb-6">
                            <label for="apellido" class="block text-gray-700 text-lg">Apellido:</label>
                            <input type="text" id="apellido" name="apellido" class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        <div class="mb-6">
                            <label for="email" class="block text-gray-700 text-lg">Email:</label>
                            <input type="email" id="email" name="email" class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        <div class="mb-6">
                            <label for="telefono" class="block text-gray-700 text-lg">Teléfono:</label>
                            <input type="text" id="telefono" name="telefono" class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        <div class="flex justify-between items-center">
                            <button type="submit" class="bg-blue-500 text-white px-8 py-3 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 text-lg">Crear</button>
                            <a href="./consultar-estudiante.php" class="text-gray-500 hover:text-gray-700 text-lg">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
