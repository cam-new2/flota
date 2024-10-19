<?php
// Conectar a la base de datos
include 'db.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Obtener el ID del vehículo desde la URL
$id = $_GET['id'];

// Si se envía el formulario, actualizar el vehículo
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $ano = $_POST['ano'];
    $estado = $_POST['estado'];
    $capacidad = $_POST['capacidad'];

    $sql = "UPDATE vehiculos SET marca=?, modelo=?, ano=?, estado=?, capacidad=? WHERE id_vehiculo=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssisii", $marca, $modelo, $ano, $estado, $capacidad, $id);

    if ($stmt->execute()) {
        header("Location: registrar_vehiculo.php");
        exit();
    } else {
        echo "Error al actualizar el vehículo: " . $conn->error;
    }
} else {
    // Obtener los datos actuales del vehículo
    $sql = "SELECT * FROM vehiculos WHERE id_vehiculo=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $vehiculo = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Vehículo</title>
    <style>
        /* Estilos generales */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #e0f7fa; /* Fondo turquesa claro */
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #00796b; /* Verde turquesa oscuro */
        }

        .form-container {
            width: 50%;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            color: #00796b;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #00796b; /* Botón verde oscuro */
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #004d40; /* Oscurecer al pasar el ratón */
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Editar Vehículo</h1>
        <form method="POST" action="">
            <label for="marca">Marca:</label>
            <input type="text" id="marca" name="marca" value="<?php echo htmlspecialchars($vehiculo['marca']); ?>" required>

            <label for="modelo">Modelo:</label>
            <input type="text" id="modelo" name="modelo" value="<?php echo htmlspecialchars($vehiculo['modelo']); ?>" required>

            <label for="ano">Año:</label>
            <input type="number" id="ano" name="ano" value="<?php echo htmlspecialchars($vehiculo['ano']); ?>" required>

            <label for="estado">Estado:</label>
            <input type="text" id="estado" name="estado" value="<?php echo htmlspecialchars($vehiculo['estado']); ?>" required>

            <label for="capacidad">Capacidad:</label>
            <input type="number" id="capacidad" name="capacidad" value="<?php echo htmlspecialchars($vehiculo['capacidad']); ?>" required>

            <button type="submit">Actualizar Vehículo</button>
        </form>
    </div>
</body>
</html>
