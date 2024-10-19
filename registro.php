<?php
include 'db.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Agregar nuevo conductor
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $numero_licencia = $_POST['numero_licencia'];
    $tipo_licencia = $_POST['tipo_licencia'];
    $vencimiento_licencia = $_POST['vencimiento_licencia'];
    $renovacion_licencia = $_POST['renovacion_licencia'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $direccion = $_POST['direccion'];
    $estado = $_POST['estado'];

    $sql = "INSERT INTO conductores (nombre, numero_licencia, tipo_licencia, vencimiento_licencia, renovacion_licencia, telefono, correo, direccion, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssss", $nombre, $numero_licencia, $tipo_licencia, $vencimiento_licencia, $renovacion_licencia, $telefono, $correo, $direccion, $estado);
    $stmt->execute();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Conductores</title>
    <style>
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
            font-weight: bold; 
        }

        .form-container {
            background-color: rgba(255, 255, 255, 0.9); 
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
            width: 100%; 
            max-width: 800px; 
            margin-bottom: 20px; 
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #17a2b8; 
            color: white; 
        }

        label {
            color: #e0f7fa; 
            font-weight: bold; 
            font-size: 1.2em; 
        }

        input[type="text"],
        input[type="email"],
        input[type="date"] {
            width: calc(100% - 14px); 
            padding: 12px; 
            margin-bottom: 15px; 
            border: 2px solid #17a2b8; 
            border-radius: 5px;
            transition: border-color 0.3s;
        }

        button {
            background-color: #17a2b8; 
            color: white;
            padding: 12px; 
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
            width: 100%;
            margin-top: 10px; 
        }

        button:hover {
            background-color: #138496; 
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

        .dashboard-button {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .dashboard-button img {
            width: 30px; 
            height: 30px; 
            margin-right: 8px; 
        }

        .image-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .image-container img {
            max-width: 30%; /* Ajusta este valor para hacerla más grande */
            height: auto; 
        }
    </style>
</head>
<body>
    <div class="image-container">
        <img src="imagenes/registroconductor.png" alt="Registro de Conductores">
    </div>
    <div class="buttons">
        <a href="agregar_producto.php" class="module-button">Agregar Nuevo Producto</a>
        <a href="dashboard.php" class="module-button">Volver al Dashboard</a>
    </div>
    <h1>Registro de Conductores</h1>

    <div class="form-container">
        <form method="POST" action="registro.php">
            <table>
                <tr>
                    <th><label for="nombre">Nombre:</label></th>
                    <td><input type="text" id="nombre" name="nombre" required></td>
                </tr>
                <tr>
                    <th><label for="numero_licencia">Número de Licencia:</label></th>
                    <td><input type="text" id="numero_licencia" name="numero_licencia" required></td>
                </tr>
                <tr>
                    <th><label for="tipo_licencia">Tipo de Licencia:</label></th>
                    <td><input type="text" id="tipo_licencia" name="tipo_licencia" required></td>
                </tr>
                <tr>
                    <th><label for="vencimiento_licencia">Vencimiento de Licencia:</label></th>
                    <td><input type="date" id="vencimiento_licencia" name="vencimiento_licencia" required></td>
                </tr>
                <tr>
                    <th><label for="renovacion_licencia">Renovación de Licencia:</label></th>
                    <td><input type="date" id="renovacion_licencia" name="renovacion_licencia" required></td>
                </tr>
                <tr>
                    <th><label for="telefono">Teléfono:</label></th>
                    <td><input type="text" id="telefono" name="telefono" required></td>
                </tr>
                <tr>
                    <th><label for="correo">Correo:</label></th>
                    <td><input type="email" id="correo" name="correo" required></td>
                </tr>
                <tr>
                    <th><label for="direccion">Dirección:</label></th>
                    <td><input type="text" id="direccion" name="direccion" required></td>
                </tr>
                <tr>
                    <th><label for="estado">Estado:</label></th>
                    <td><input type="text" id="estado" name="estado" required></td>
                </tr>
            </table>
            <button type="submit">Agregar Conductor</button>
        </form>
    </div>

    <div class="button-container">
        <a href="dashboard.php" class="dashboard-button">
            <img src="imagenes/volver.png" alt="Volver">
            <button type="button">Volver al Dashboard</button>
        </a>
        <a href="listado.php">Ver Lista de Conductores</a>
    </div>
</body>
</html>
