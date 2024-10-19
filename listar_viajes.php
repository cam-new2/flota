<?php
include 'db.php';
session_start();

// Redirigir a la página de inicio de sesión si el usuario no está autenticado
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Manejo de la eliminación de viajes
if (isset($_GET['eliminar'])) {
    $id_viaje = $_GET['eliminar'];
    $sql = "DELETE FROM registro_viajes WHERE id_viaje=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_viaje);
    $stmt->execute();
    $stmt->close();
    header("Location: listar_viajes.php");
    exit();
}

// Listar viajes para mostrar en la tabla
$sql_viajes = "SELECT rv.*, v.marca, v.modelo FROM registro_viajes rv 
               JOIN vehiculos v ON rv.id_vehiculo = v.id_vehiculo";
$result_viajes = $conn->query($sql_viajes);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Viajes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8f8;
            color: #333;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        h1, h2 {
            color: #00897b; /* Turquesa más bonito */
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 100%;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            border: 1px solid #00897b; /* Turquesa */
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #005b5c; /* Color más oscuro para el encabezado */
            color: white;
        }
        td {
            background-color: #e0f2f1; /* Color más claro para las celdas */
        }
        a {
            text-decoration: none;
            color: #00897b; /* Turquesa */
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin: 20px 10px 20px 0; /* Añadido margen derecho */
            font-size: 16px;
            color: white;
            background-color: #87CEEB; /* Azul cielo */
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .button:hover {
            background-color: #005f73; /* Cambio a un color más oscuro en hover */
        }
        /* Añadir estilo para el mensaje de "No hay viajes registrados" */
        .no-records {
            font-style: italic;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Lista de Viajes</h1>
        
        <!-- Botones con estilo personalizado -->
        <a href="registrar_viaje.php" class="button">Registrar un nuevo viaje</a>
        <a href="dashboard.php" class="button">Volver al Dashboard</a>

        <h2>Viajes Registrados</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Destino</th>
                <th>Salida</th>
                <th>Entrada</th>
                <th>Estado</th>
                <th>Vehículo</th>
                <th>Acciones</th>
            </tr>
            <?php if ($result_viajes && $result_viajes->num_rows > 0): ?>
                <?php while ($viaje = $result_viajes->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $viaje['id_viaje']; ?></td>
                        <td><?php echo $viaje['fechaviaje']; ?></td>
                        <td><?php echo $viaje['horaviaje']; ?></td>
                        <td><?php echo $viaje['destinocamion']; ?></td>
                        <td><?php echo $viaje['salidavehiculo']; ?></td>
                        <td><?php echo $viaje['entradavehiculo']; ?></td>
                        <td><?php echo $viaje['estado']; ?></td>
                        <td><?php echo $viaje['marca'] . ' ' . $viaje['modelo']; ?></td>
                        <td>
                            <a href="editar_viaje.php?id=<?php echo $viaje['id_viaje']; ?>">Editar</a> |
                            <a href="listar_viajes.php?eliminar=<?php echo $viaje['id_viaje']; ?>" 
                               onclick="return confirm('¿Estás seguro de eliminar este viaje?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9" class="no-records">No hay viajes registrados</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
</body>
</html>
