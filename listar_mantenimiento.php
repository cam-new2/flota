<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Redirigir si el usuario no ha iniciado sesión
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Incluir el archivo de conexión a la base de datos
include 'db.php';

// Manejar la eliminación de un mantenimiento
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id_mantenimiento = $_GET['id'];
    $query_delete = "DELETE FROM mantenimiento WHERE id_mantenimiento = $id_mantenimiento";
    mysqli_query($conn, $query_delete);
    header("Location: listar_mantenimiento.php"); // Redirigir después de eliminar
    exit();
}

// Obtener todos los mantenimientos
$query_mantenimientos = "SELECT mantenimiento.*, vehiculos.marca, vehiculos.modelo 
                          FROM mantenimiento 
                          INNER JOIN vehiculos ON mantenimiento.id_vehiculo = vehiculos.id_vehiculo 
                          ORDER BY fecha DESC";
$result_mantenimientos = mysqli_query($conn, $query_mantenimientos);

// Verificar si la consulta de mantenimientos se ejecutó correctamente
if (!$result_mantenimientos) {
    die("Error en la consulta de mantenimientos: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Mantenimientos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
        }
        h1 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px auto;
            background-color: #e0f7fa; /* Color turquesa claro */
        }
        th, td {
            border: 1px solid #00796b; /* Color de borde */
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #00796b; /* Color de fondo de los encabezados */
            color: white;
        }
        tr:nth-child(even) {
            background-color: #b2ebf2; /* Color de fondo para filas pares */
        }
        a {
            text-decoration: none;
            color: #00796b; /* Color del enlace */
        }
        .button {
            background-color: #00796b; /* Color del botón */
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }
        .button:hover {
            background-color: #004d40; /* Color del botón al pasar el mouse */
        }
        .header-img {
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <img src="imagenes\mantenimiento.png" alt="Mantenimiento" class="header-img" width="150">
    <h1>Lista de Mantenimientos Registrados</h1>
    
    <table>
        <tr>
            <th>ID</th>
            <th>Fecha</th>
            <th>Tipo</th>
            <th>Costo</th>
            <th>Cambio de Válvulas</th>
            <th>Filtro de Aceite</th>
            <th>Filtro de Gasolina</th>
            <th>Kilometraje</th>
            <th>Chasis</th>
            <th>Llantas</th>
            <th>Línea</th>
            <th>Tonelaje</th>
            <th>Descripción</th>
            <th>Proveedor</th>
            <th>Estado del Mantenimiento</th>
            <th>Responsable</th>
            <th>Próximo Mantenimiento</th>
            <th>Vehículo</th>
            <th>Acciones</th>
        </tr>
        <?php while ($mantenimiento = mysqli_fetch_assoc($result_mantenimientos)) { ?>
            <tr>
                <td><?php echo $mantenimiento['id_mantenimiento']; ?></td>
                <td><?php echo $mantenimiento['fecha']; ?></td>
                <td><?php echo $mantenimiento['tipo']; ?></td>
                <td><?php echo $mantenimiento['costo']; ?></td>
                <td><?php echo $mantenimiento['cambio_valvulas'] ? 'Sí' : 'No'; ?></td>
                <td><?php echo $mantenimiento['filtro_aceite'] ? 'Sí' : 'No'; ?></td>
                <td><?php echo $mantenimiento['filtro_gasolina'] ? 'Sí' : 'No'; ?></td>
                <td><?php echo $mantenimiento['kilometraje']; ?></td>
                <td><?php echo $mantenimiento['chasis']; ?></td>
                <td><?php echo $mantenimiento['llantas']; ?></td>
                <td><?php echo $mantenimiento['linea']; ?></td>
                <td><?php echo $mantenimiento['tonelaje']; ?></td>
                <td><?php echo $mantenimiento['descripcion']; ?></td>
                <td><?php echo $mantenimiento['proveedor']; ?></td>
                <td><?php echo $mantenimiento['estadomantenimiento']; ?></td>
                <td><?php echo $mantenimiento['responsable']; ?></td>
                <td><?php echo $mantenimiento['proximo_mantenimiento']; ?></td>
                <td><?php echo $mantenimiento['marca'] . " " . $mantenimiento['modelo']; ?></td>
                <td>
                    <a href="editar_mantenimiento.php?id=<?php echo $mantenimiento['id_mantenimiento']; ?>">Editar</a> |
                    <a href="listar_mantenimiento.php?action=delete&id=<?php echo $mantenimiento['id_mantenimiento']; ?>">Eliminar</a>
                </td>
            </tr>
        <?php } ?>
    </table>

    <h2><a href="agregar_mantenimiento.php">Agregar Nuevo Mantenimiento</a></h2>
    <button class="button" onclick="window.location.href='dashboard.php'">Regresar al Dashboard</button>
</body>
</html>
