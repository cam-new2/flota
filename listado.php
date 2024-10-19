<?php
include 'db.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Obtener todos los conductores
$sql = "SELECT * FROM conductores";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Conductores</title>
    <style>
        /* Estilos aquí (mismos que antes) */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff; 
            margin: 0;
            padding: 20px;
            color: #333;
            display: flex; 
            justify-content: center; 
            flex-direction: column; 
            align-items: center; 
        }

        h1 {
            text-align: center;
            color: #007bff; 
            margin-bottom: 20px; 
        }

        .table-container {
            width: 100%; 
            max-width: 900px; 
            margin-top: 30px; 
        }

        table {
            width: 100%;
            border-collapse: collapse; 
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #007bff; 
        }

        th {
            background-color: #17a2b8; 
            color: white; 
        }

        tr:nth-child(even) {
            background-color: #e9f7fa; 
        }

        tr:hover {
            background-color: #d1ecf1; 
        }

        a {
            display: block;
            margin-top: 20px;
            text-align: center;
            color: #007bff; 
            text-decoration: none; 
        }

        a:hover {
            text-decoration: underline; 
        }
    </style>
</head>
<body>
    <h1>Lista de Conductores</h1>
    <div class="table-container">
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Número de Licencia</th>
                <th>Tipo de Licencia</th>
                <th>Vencimiento</th>
                <th>Renovación</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Dirección</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id_conductor']; ?></td>
                <td><?php echo $row['nombre']; ?></td>
                <td><?php echo $row['numero_licencia']; ?></td>
                <td><?php echo $row['tipo_licencia']; ?></td>
                <td><?php echo $row['vencimiento_licencia']; ?></td>
                <td><?php echo $row['renovacion_licencia']; ?></td>
                <td><?php echo $row['telefono']; ?></td>
                <td><?php echo $row['correo']; ?></td>
                <td><?php echo $row['direccion']; ?></td>
                <td><?php echo $row['estado']; ?></td>
                <td>
                    <a href="editar_conductor.php?id=<?php echo $row['id_conductor']; ?>">Editar</a> | 
                    <a href="javascript:void(0);" onclick="confirmarEliminar(<?php echo $row['id_conductor']; ?>)">Eliminar</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
    <a href="registro.php">Registrar Nuevo Conductor</a> <!-- Enlace al registro -->
    <script>
        function confirmarEliminar(id) {
            if (confirm('¿Estás seguro de que deseas eliminar este conductor?')) {
                window.location.href = 'eliminar.php?id=' + id;
            }
        }
    </script>
</body>
</html>
