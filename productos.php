<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Conexión a la base de datos
$servername = "localhost";
$username = "root"; // Cambia por tus credenciales
$password = "";
$dbname = "flotas"; // Asegúrate de tener esta base de datos configurada

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consultar productos
$sql = "SELECT * FROM productos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Módulo Productos - Sistema de Gestión de Flotas</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e0f7fa; /* Color de fondo claro */
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            color: #00796b; /* Color turquesa */
            text-align: center;
        }

        .buttons {
            margin-bottom: 20px;
            text-align: center;
        }

        .module-button {
            background-color: #00796b; /* Color turquesa */
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            margin-right: 10px;
            transition: background-color 0.3s;
        }

        .module-button:hover {
            background-color: #004d40; /* Color turquesa más oscuro */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #00796b; /* Color turquesa */
            color: white;
        }

        .action-link {
            color: #00796b; /* Color turquesa */
            text-decoration: none;
        }

        .action-link:hover {
            text-decoration: underline;
        }

        .logout {
            margin-top: 20px;
            text-align: right;
        }

        .header-image {
            display: block;
            margin: 0 auto 20px auto; /* Centrar imagen */
            width: 100px; /* Ajusta el tamaño de la imagen */
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="imagenes/productos.png" alt="Productos" class="header-image"> <!-- Imagen centrada -->
        <h1>Módulo de Productos</h1>
        
        <div class="buttons">
            <a href="agregar_producto.php" class="module-button">Agregar Nuevo Producto</a>
            <a href="dashboard.php" class="module-button">Volver al Dashboard</a>
        </div>
        
        <h2>Lista de Productos</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Categoría</th>
                    <th>Cantidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id_producto']; ?></td>
                    <td><?php echo $row['nombre']; ?></td>
                    <td><?php echo $row['descripcion']; ?></td>
                    <td><?php echo $row['categoria']; ?></td>
                    <td><?php echo $row['cantidad']; ?></td>
                    <td>
                        <a href="editar_producto.php?id=<?php echo $row['id_producto']; ?>" class="action-link">Editar</a>
                        <a href="eliminar_producto.php?id=<?php echo $row['id_producto']; ?>" class="action-link" onclick="return confirm('¿Estás seguro de que quieres eliminar este producto?');">Eliminar</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <div class="logout">
            <a href="logout.php">Cerrar sesión</a>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
