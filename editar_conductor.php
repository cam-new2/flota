<?php
include 'db.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id']; // Obtener el id del conductor

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibir los datos del formulario
    $nombre = $_POST['nombre'];
    $numero_licencia = $_POST['numero_licencia'];
    $tipo_licencia = $_POST['tipo_licencia'];
    $vencimiento_licencia = $_POST['vencimiento_licencia'];
    $renovacion_licencia = $_POST['renovacion_licencia'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $direccion = $_POST['direccion'];
    $estado = $_POST['estado'];

    // Actualizar los datos del conductor
    $sql = "UPDATE conductores SET nombre=?, numero_licencia=?, tipo_licencia=?, vencimiento_licencia=?, renovacion_licencia=?, telefono=?, correo=?, direccion=?, estado=? WHERE id_conductor=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssi", $nombre, $numero_licencia, $tipo_licencia, $vencimiento_licencia, $renovacion_licencia, $telefono, $correo, $direccion, $estado, $id);

    if ($stmt->execute()) {
        header("Location: registro.php"); // Redirigir a la lista de conductores
        exit();
    } else {
        echo "Error al actualizar el conductor: " . $conn->error;
    }
} else {
    // Seleccionar los datos del conductor para mostrarlos en el formulario
    $sql = "SELECT * FROM conductores WHERE id_conductor=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $conductor = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Conductor</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            margin: 0;
            padding: 20px;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            text-align: center;
            color: #007bff;
            margin-bottom: 20px;
            font-weight: bold;
        }

        form {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 600px;
        }

        label {
            color: #007bff;
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        input[type="text"],
        input[type="email"],
        input[type="date"] {
            width: calc(100% - 14px);
            padding: 12px;
            margin-bottom: 15px;
            border: 2px solid #007bff;
            border-radius: 5px;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="date"]:focus {
            border-color: #0056b3;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
            width: 100%;
        }

        button:hover {
            background-color: #0056b3;
        }

        .button-container {
            margin-top: 20px;
        }

        a {
            display: block;
            text-align: center;
            color: #007bff;
            text-decoration: none;
            margin-top: 20px;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Editar Conductor</h1>
    <form method="POST" action="">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $conductor['nombre']; ?>" required>

        <label for="numero_licencia">Número de Licencia:</label>
        <input type="text" id="numero_licencia" name="numero_licencia" value="<?php echo $conductor['numero_licencia']; ?>" required>

        <label for="tipo_licencia">Tipo de Licencia:</label>
        <input type="text" id="tipo_licencia" name="tipo_licencia" value="<?php echo $conductor['tipo_licencia']; ?>" required>

        <label for="vencimiento_licencia">Vencimiento de Licencia:</label>
        <input type="date" id="vencimiento_licencia" name="vencimiento_licencia" value="<?php echo $conductor['vencimiento_licencia']; ?>" required>

        <label for="renovacion_licencia">Renovación de Licencia:</label>
        <input type="date" id="renovacion_licencia" name="renovacion_licencia" value="<?php echo $conductor['renovacion_licencia']; ?>" required>

        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono" value="<?php echo $conductor['telefono']; ?>" required>

        <label for="correo">Correo:</label>
        <input type="email" id="correo" name="correo" value="<?php echo $conductor['correo']; ?>" required>

        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion" value="<?php echo $conductor['direccion']; ?>" required>

        <label for="estado">Estado:</label>
        <input type="text" id="estado" name="estado" value="<?php echo $conductor['estado']; ?>" required>

        <button type="submit">Actualizar Conductor</button>
    </form>

    <div class="button-container">
        <a href="registro.php">Volver a la lista de conductores</a>
    </div>
</body>
</html>
