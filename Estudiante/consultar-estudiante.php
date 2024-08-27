<?php
require '../conexion.php';

$consultaSQL = "SELECT * FROM tbl_estudiantes";
$sentenciaConsulta = $conexion->prepare($consultaSQL);

try {
    $sentenciaConsulta->execute();
    $resultado = $sentenciaConsulta->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Lista de Estudiantes</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
        table {
            text-align: center;
        }
    </style>
</head>
<body class="bg-gray-100">

<div class="container mx-auto mt-8 p-5 bg-white shadow-lg rounded-lg">
    <h2 class="text-2xl font-bold mb-4 text-center">Lista de Estudiantes</h2>
    
    <section class="mb-4 flex justify-between items-center">
        <button type="button" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600 transition duration-200" onclick="window.location.href='crear-estudiante.php'">
            <i class="fas fa-plus-circle"></i> Crear nuevo estudiante
        </button>
        <button type="button" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition duration-200" onclick="window.location.href='../index.php'">
            <i class="fas fa-home"></i> Volver al Inicio
        </button>
    </section>

    <table class="min-w-full bg-white border border-gray-300 rounded-lg">
        <thead class="bg-blue-500 text-white">
            <tr>
                <th class="py-3 px-4 border-b">ID</th>
                <th class="py-3 px-4 border-b">Nombre</th>
                <th class="py-3 px-4 border-b">Apellido</th>
                <th class="py-3 px-4 border-b">Correo</th>
                <th class="py-3 px-4 border-b">Teléfono</th>
                <th class="py-3 px-4 border-b">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($resultado)) {
                foreach ($resultado as $fila) { ?>
                    <tr class="hover:bg-gray-100 transition duration-200">
                        <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($fila['idEstudiante'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($fila['Nombre'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($fila['Apellido'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($fila['Correo'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($fila['Telefono'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td class="py-2 px-4 border-b">
                            <a class="text-yellow-500 hover:text-yellow-600" href="actualizar-estudiante.php?idEstudianteAct=<?php echo htmlspecialchars($fila['idEstudiante'], ENT_QUOTES, 'UTF-8'); ?>">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <a href="#" onclick="eliminarRegistro(<?php echo htmlspecialchars($fila['idEstudiante'], ENT_QUOTES, 'UTF-8'); ?>)" class="text-red-500 hover:text-red-600">
                                <i class="fas fa-trash-alt"></i> Eliminar
                            </a>
                        </td>
                    </tr>
                <?php }
            } else { ?>
                <tr><td colspan="6" class="text-center py-4">No hay estudiantes registrados</td></tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script>
    function eliminarRegistro(id) {
        if (confirm("¿Estás seguro de que deseas eliminar este estudiante?")) {
            window.location.href = 'eliminar-estudiante.php?IdEstudianteEli=' + id;
        }
    }
</script>

</body>
</html>
