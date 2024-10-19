<?php
include 'db.php';
session_start();

// Redirigir a la página de inicio de sesión si el usuario no está autenticado
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Manejo del formulario para registrar viajes
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verifica que el campo de fecha no esté vacío
    if (empty($_POST['fechaviaje'])) {
        echo "La fecha del viaje es obligatoria.";
    } else {
        // Obtener datos del formulario
        $fechaviaje = $_POST['fechaviaje'];
        $horaviaje = $_POST['horaviaje'];
        $destinocamion = $_POST['destinocamion'];
        $salidavehiculo = $_POST['salidavehiculo'];
        $entradavehiculo = $_POST['entradavehiculo'];
        $estado = $_POST['estado'];
        $id_vehiculo = $_POST['id_vehiculo'];

        // Consulta para insertar el nuevo viaje
        $sql = "INSERT INTO registro_viajes (fechaviaje, horaviaje, destinocamion, salidavehiculo, entradavehiculo, estado, id_vehiculo) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        
        if ($stmt) {
            $stmt->bind_param("ssssssi", $fechaviaje, $horaviaje, $destinocamion, $salidavehiculo, $entradavehiculo, $estado, $id_vehiculo);
            
            if ($stmt->execute()) {
                // Redireccionar después de guardar
                header("Location: registro_viajes.php");
                exit();
            } else {
                echo "Error al guardar: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error en la preparación de la consulta: " . $conn->error;
        }
    }
}

// Manejo de la eliminación de viajes
if (isset($_GET['eliminar'])) {
    $id_viaje = $_GET['eliminar'];
    $sql = "DELETE FROM registro_viajes WHERE id_viaje=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_viaje);
    $stmt->execute();
    $stmt->close();
    header("Location: registro_viajes.php");
    exit();
}

// Obtener la lista de vehículos para el desplegable
$sql_vehiculos = "SELECT id_vehiculo, marca, modelo FROM vehiculos";
$result_vehiculos = $conn->query($sql_vehiculos);

// Listar viajes para mostrar en la tabla
$sql_viajes = "SELECT rv.*, v.marca, v.modelo FROM registro_viajes rv JOIN vehiculos v ON rv.id_vehiculo = v.id_vehiculo";
$result_viajes = $conn->query($sql_viajes);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Viaje</title>
</head>
<body>
    <h1>Registrar Viaje</h1>
    <form method="POST" action="registro_viajes.php">
        <label for="fechaviaje">Fecha del Viaje:</label>
        <input type="date" id="fechaviaje" name="fechaviaje" required><br>

        <label for="horaviaje">Hora del Viaje:</label>
        <input type="time" id="horaviaje" name="horaviaje" required><br>

        <label for="destinocamion">Destino:</label>
        <input type="text" id="destinocamion" name="destinocamion" required><br>

        <label for="salidavehiculo">Salida del Vehículo:</label>
        <input type="datetime-local" id="salidavehiculo" name="salidavehiculo" required><br>

        <label for="entradavehiculo">Entrada del Vehículo:</label>
        <input type="datetime-local" id="entradavehiculo" name="entradavehiculo" required><br>

        <label for="estado">Estado:</label>
        <input type="text" id="estado" name="estado" required><br>

        <label for="id_vehiculo">Seleccionar Vehículo:</label>
        <select id="id_vehiculo" name="id_vehiculo" required>
            <option value="">Seleccione un vehículo</option>
            <?php while ($vehiculo = $result_vehiculos->fetch_assoc()): ?>
                <option value="<?php echo $vehiculo['id_vehiculo']; ?>">
                    <?php echo $vehiculo['marca'] . ' ' . $vehiculo['modelo']; ?>
                </option>
            <?php endwhile; ?>
        </select><br>

        <button type="submit">Guardar Viaje</button>
    </form>

    <h2>Lista de Viajes</h2>
    <table border="1">
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
                        <a href="ed.php?id=<?php echo $viaje['id_viaje']; ?>">Editar</a> |
                        <a href="registro_viajes.php?eliminar=<?php echo $viaje['id_viaje']; ?>" onclick="return confirm('¿Estás seguro de eliminar este viaje?');">Eliminar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="9">No hay viajes registrados</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</html>
