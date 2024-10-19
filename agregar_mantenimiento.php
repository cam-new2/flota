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

// Obtener los vehículos para asociar con el mantenimiento
$query_vehiculos = "SELECT * FROM vehiculos";
$result_vehiculos = mysqli_query($conn, $query_vehiculos);

// Verificar si la consulta se ejecutó correctamente
if (!$result_vehiculos) {
    die("Error en la consulta de vehículos: " . mysqli_error($conn));
}

// Manejar el envío del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fecha = $_POST['fecha'];
    $tipo = $_POST['tipo'];
    $costo = $_POST['costo'];
    $cambio_valvulas = isset($_POST['cambio_valvulas']) ? 1 : 0;
    $filtro_aceite = isset($_POST['filtro_aceite']) ? 1 : 0;
    $filtro_gasolina = isset($_POST['filtro_gasolina']) ? 1 : 0;
    $kilometraje = $_POST['kilometraje'];
    $chasis = $_POST['chasis'];
    $llantas = $_POST['llantas'];
    $linea = $_POST['linea'];
    $tonelaje = !empty($_POST['tonelaje']) ? $_POST['tonelaje'] : null;
    $descripcion = $_POST['descripcion'];
    $proveedor = $_POST['proveedor'];
    $estadomantenimiento = $_POST['estadomantenimiento'];
    $responsable = $_POST['responsable'];
    $proximo_mantenimiento = $_POST['proximo_mantenimiento'];
    $id_vehiculo = $_POST['id_vehiculo'];

    $query = "INSERT INTO mantenimiento (fecha, tipo, costo, cambio_valvulas, filtro_aceite, filtro_gasolina, kilometraje, chasis, llantas, linea, tonelaje, descripcion, proveedor, estadomantenimiento, responsable, proximo_mantenimiento, id_vehiculo)
              VALUES ('$fecha', '$tipo', '$costo', '$cambio_valvulas', '$filtro_aceite', '$filtro_gasolina', '$kilometraje', '$chasis', '$llantas', '$linea', $tonelaje, '$descripcion', '$proveedor', '$estadomantenimiento', '$responsable', '$proximo_mantenimiento', '$id_vehiculo')";

    if (mysqli_query($conn, $query)) {
        echo "Mantenimiento agregado exitosamente.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Mantenimiento</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #007f7f;
        }
        img {
            display: block;
            margin: 0 auto;
            width: 100px; /* Ajusta el tamaño de la imagen según necesites */
        }
        form {
            background-color: #e0ffff;
            border: 1px solid #007f7f;
            border-radius: 10px;
            padding: 20px;
            max-width: 600px;
            margin: 0 auto;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"],
        input[type="date"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #007f7f;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #007f7f;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #005f5f;
        }
        a {
            display: block;
            text-align: center;
            margin: 20px 0;
            text-decoration: none;
            color: #007f7f;
        }
        a:hover {
            text-decoration: underline;
        }
        .dashboard-btn {
            background-color: #007f7f;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            text-align: center;
            display: inline-block;
            margin: 20px auto;
        }
    </style>
</head>
<body>
    <img src="imagenes\mantenimiento.png" alt="Mantenimiento">
    <h1>Agregar Mantenimiento</h1>
    <form action="agregar_mantenimiento.php" method="post">
        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha" required>

        <label for="tipo">Tipo:</label>
        <input type="text" name="tipo" required>

        <label for="costo">Costo:</label>
        <input type="number" step="0.01" name="costo" required>

        <label for="cambio_valvulas">Cambio de Válvulas:</label>
        <input type="checkbox" name="cambio_valvulas"><br>

        <label for="filtro_aceite">Filtro de Aceite:</label>
        <input type="checkbox" name="filtro_aceite"><br>

        <label for="filtro_gasolina">Filtro de Gasolina:</label>
        <input type="checkbox" name="filtro_gasolina"><br>

        <label for="kilometraje">Kilometraje:</label>
        <input type="number" name="kilometraje" required>

        <label for="chasis">Chasis:</label>
        <input type="text" name="chasis"><br>

        <label for="llantas">Llantas:</label>
        <input type="text" name="llantas"><br>

        <label for="linea">Línea:</label>
        <input type="text" name="linea"><br>

        <label for="tonelaje">Tonelaje:</label>
        <input type="number" step="0.01" name="tonelaje"><br>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion"></textarea><br>

        <label for="proveedor">Proveedor:</label>
        <input type="text" name="proveedor"><br>

        <label for="estadomantenimiento">Estado del Mantenimiento:</label>
        <input type="text" name="estadomantenimiento" required>

        <label for="responsable">Responsable:</label>
        <input type="text" name="responsable" required>

        <label for="proximo_mantenimiento">Próximo Mantenimiento:</label>
        <input type="date" name="proximo_mantenimiento"><br>

        <label for="id_vehiculo">Vehículo:</label>
        <select name="id_vehiculo" required>
            <?php while ($vehiculo = mysqli_fetch_assoc($result_vehiculos)) { ?>
                <option value="<?php echo $vehiculo['id_vehiculo']; ?>">
                    <?php echo $vehiculo['marca'] . " " . $vehiculo['modelo'] . " (" . $vehiculo['ano'] . ")"; ?>
                </option>
            <?php } ?>
        </select><br>

        <input type="submit" value="Agregar Mantenimiento">
    </form>

    <a href="listar_mantenimiento.php">Ver Mantenimientos Registrados</a>
    <a class="dashboard-btn" href="dashboard.php">Regresar al Dashboard</a>
</body>
</html>
