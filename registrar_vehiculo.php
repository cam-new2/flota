<?php
// Conectar a la base de datos
include 'db.php';

// Comprobar si el usuario está autenticado
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Si se envía el formulario de agregar vehículo
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $ano = $_POST['ano'];
    $estado = $_POST['estado'];
    $capacidad = $_POST['capacidad'];

    // Insertar el vehículo en la base de datos
    $sql = "INSERT INTO vehiculos (marca, modelo, ano, estado, capacidad) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssisi", $marca, $modelo, $ano, $estado, $capacidad);
    $stmt->execute();
    $stmt->close();
    header("Location: lista_vehiculos.php"); // Redirigir a la lista después de agregar
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Vehículo</title>
    <style>
        /* Estilos generales */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #e0f7fa; /* Color turquesa claro de fondo */
            margin: 0;
            padding: 0;
        }
        .container {
            width: 400px;
            margin: 40px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center; /* Centrar contenido */
        }
        .title {
            color: #00796b; /* Verde turquesa oscuro */
            margin-bottom: 20px;
        }
        .vehicle-image {
            margin-bottom: 20px; /* Espacio entre la imagen y el título */
        }
        /* Estilos del formulario */
        .form-container {
            margin-bottom: 20px;
        }
        .input-group {
            margin-bottom: 15px;
        }
        label {
            font-size: 14px;
            color: #00796b; /* Verde turquesa */
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #00796b; /* Bordes turquesa */
            border-radius: 4px;
            font-size: 14px;
            transition: 0.3s;
        }
        input:focus {
            border-color: #004d40; /* Verde más oscuro al enfocarse */
            outline: none;
        }
        button.submit-btn {
            width: 100%;
            padding: 10px;
            background-color: #009688; /* Botón turquesa */
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
            transition: 0.3s;
        }
        button.submit-btn:hover {
            background-color: #00796b; /* Oscurecer al pasar el ratón */
        }
        /* Botones de navegación */
        .button-container {
            text-align: center;
            margin-top: 20px;
        }
        .nav-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #004d40; /* Botón oscuro para Dashboard */
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
            margin: 5px;
            transition: 0.3s;
        }
        .nav-button:hover {
            background-color: #00796b; /* Oscurecer al pasar el ratón */
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Imagen centrada -->
        <img src="imagenes/vehiculos.png" alt="Vehículos" class="vehicle-image" width="100" height="100">
        
        <h1 class="title">Registrar Vehículo</h1>

        <div class="form-container">
            <form method="POST" action="registrar_vehiculo.php">
                <div class="input-group">
                    <label for="marca">Marca:</label>
                    <input type="text" id="marca" name="marca" required>
                </div>

                <div class="input-group">
                    <label for="modelo">Modelo:</label>
                    <input type="text" id="modelo" name="modelo" required>
                </div>

                <div class="input-group">
                    <label for="ano">Año:</label>
                    <input type="number" id="ano" name="ano" required>
                </div>

                <div class="input-group">
                    <label for="estado">Estado:</label>
                    <input type="text" id="estado" name="estado" required>
                </div>

                <div class="input-group">
                    <label for="capacidad">Capacidad:</label>
                    <input type="number" id="capacidad" name="capacidad" required>
                </div>

                <button type="submit" class="submit-btn">Agregar Vehículo</button>
            </form>
        </div>

        <div class="button-container">
            <a href="dashboard.php" class="nav-button">Volver al Dashboard</a>
            <a href="lista_vehiculos.php" class="nav-button">Ver lista de Vehículos</a>
        </div>
    </div>
</body>
</html>
