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
                header("Location: listar_viajes.php");
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

// Obtener la lista de vehículos para el desplegable
$sql_vehiculos = "SELECT id_vehiculo, marca, modelo FROM vehiculos";
$result_vehiculos = $conn->query($sql_vehiculos);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Viaje</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8f8;
            color: #333;
            text-align: center;
            padding: 20px;
        }
        h1, h2 {
            color: #00796b;
        }
        form, table {
            margin: 20px auto;
            padding: 20px;
            border: 2px solid #00796b;
            border-radius: 10px;
            background-color: #e0f7fa;
            width: 50%;
        }
        label {
            display: inline-block;
            width: 150px;
            font-weight: bold;
            text-align: left;
            color: #006064;
        }
        input, select {
            margin: 10px 0;
            padding: 10px;
            width: 70%;
            border: 1px solid #00796b;
            border-radius: 5px;
        }
        button {
            background-color: #00796b;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #004d40;
        }
        a {
            color: #00796b;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        table, th, td {
            border: 1px solid #00796b;
        }
        th, td {
            padding: 10px;
            text-align: center;
            color: #004d40;
        }
        th {
            background-color: #004d40;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #e0f2f1;
        }
        /* Estilo para centrar la imagen */
        .imagen-centro {
            display: block;
            margin: 0 auto 20px auto;
            width: 150px; /* Puedes ajustar el tamaño aquí */
            border-radius: 10px;
        }
        /* Estilo del botón para regresar al dashboard */
        .btn-dashboard {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #ff5722;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }
        .btn-dashboard:hover {
            background-color: #e64a19;
        }
    </style>
</head>
<body>
    <!-- Imagen centrada -->
    <img src="imagenes/viaje.png" alt="Viaje" class="imagen-centro">

    <h1>Registrar Viaje</h1>
    <form method="POST" action="registrar_viaje.php">
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

    <a href="listar_viajes.php">Ver listado de viajes</a>
    
    <!-- Botón destacado para regresar al Dashboard -->
    <a href="dashboard.php" class="btn-dashboard">Regresar al Dashboard</a>
</body>
</html>
