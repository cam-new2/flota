<?php
include 'db.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Verificar si el ID del viaje está presente
if (isset($_GET['id'])) {
    $id_viaje = $_GET['id'];
    
    // Cargar los datos del viaje
    $sql = "SELECT * FROM registro_viajes WHERE id_viaje = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_viaje);
    $stmt->execute();
    $result = $stmt->get_result();
    $viaje = $result->fetch_assoc();

    if (!$viaje) {
        echo "Viaje no encontrado.";
        exit();
    }
} else {
    echo "ID de viaje no especificado.";
    exit();
}

// Manejar la actualización del viaje
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $fechaviaje = $_POST['fechaviaje'];
    $horaviaje = $_POST['horaviaje'];
    $destinocamion = $_POST['destinocamion'];
    $salidavehiculo = $_POST['salidavehiculo'];
    $entradavehiculo = $_POST['entradavehiculo'];
    $estado = $_POST['estado'];
    $id_vehiculo = $_POST['id_vehiculo'];
    $id_viaje = $_POST['id_viaje'];

    // Actualizar los datos en la base de datos
    $sql = "UPDATE registro_viajes SET fechaviaje = ?, horaviaje = ?, destinocamion = ?, salidavehiculo = ?, entradavehiculo = ?, estado = ?, id_vehiculo = ? WHERE id_viaje = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssii", $fechaviaje, $horaviaje, $destinocamion, $salidavehiculo, $entradavehiculo, $estado, $id_vehiculo, $id_viaje);

    if ($stmt->execute()) {
        // Redirigir a la página principal después de la actualización
        header("Location: registrar_viaje.php");
        exit();
    } else {
        echo "Error al actualizar el viaje: " . $stmt->error;
    }
}

// Obtener la lista de vehículos para el desplegable
$sql_vehiculos = "SELECT id_vehiculo, marca, modelo FROM vehiculos";
$result_vehiculos = $conn->query($sql_vehiculos);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Viaje</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e0f7fa;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        h1 {
            color: #00796b;
            margin: 20px 0;
        }
        form {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 500px;
            margin: 0 auto;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            text-align: left;
            font-weight: bold;
        }
        input[type="text"],
        input[type="date"],
        input[type="time"],
        input[type="datetime-local"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #00796b;
            border-radius: 4px;
            margin-bottom: 15px;
        }
        button {
            background-color: #00796b;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }
        button:hover {
            background-color: #004d40;
        }
    </style>
</head>
<body>
    <h1>Editar Viaje</h1>
    <form method="POST" action="editar_viaje.php?id=<?php echo $viaje['id_viaje']; ?>">
        <input type="hidden" name="id_viaje" value="<?php echo $viaje['id_viaje']; ?>">
        
        <label for="fechaviaje">Fecha del Viaje:</label>
        <input type="date" id="fechaviaje" name="fechaviaje" value="<?php echo $viaje['fechaviaje']; ?>" required>

        <label for="horaviaje">Hora del Viaje:</label>
        <input type="time" id="horaviaje" name="horaviaje" value="<?php echo $viaje['horaviaje']; ?>" required>

        <label for="destinocamion">Destino:</label>
        <input type="text" id="destinocamion" name="destinocamion" value="<?php echo $viaje['destinocamion']; ?>" required>

        <label for="salidavehiculo">Salida del Vehículo:</label>
        <input type="datetime-local" id="salidavehiculo" name="salidavehiculo" value="<?php echo date('Y-m-d\TH:i', strtotime($viaje['salidavehiculo'])); ?>" required>

        <label for="entradavehiculo">Entrada del Vehículo:</label>
        <input type="datetime-local" id="entradavehiculo" name="entradavehiculo" value="<?php echo date('Y-m-d\TH:i', strtotime($viaje['entradavehiculo'])); ?>" required>

        <label for="estado">Estado:</label>
        <input type="text" id="estado" name="estado" value="<?php echo $viaje['estado']; ?>" required>

        <label for="id_vehiculo">Seleccionar Vehículo:</label>
        <select id="id_vehiculo" name="id_vehiculo" required>
            <option value="">Seleccione un vehículo</option>
            <?php while ($vehiculo = $result_vehiculos->fetch_assoc()): ?>
                <option value="<?php echo $vehiculo['id_vehiculo']; ?>" <?php echo ($vehiculo['id_vehiculo'] == $viaje['id_vehiculo']) ? 'selected' : ''; ?>>
                    <?php echo $vehiculo['marca'] . ' ' . $vehiculo['modelo']; ?>
                </option>
            <?php endwhile; ?>
        </select>

        <button type="submit">Actualizar Viaje</button>
    </form>
</body>
</html>
