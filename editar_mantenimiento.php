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

// Verificar si se recibió un ID para editar
if (isset($_GET['id'])) {
    $id_mantenimiento = $_GET['id'];

    // Obtener los datos del mantenimiento a editar
    $query = "SELECT * FROM mantenimiento WHERE id_mantenimiento = $id_mantenimiento";
    $result = mysqli_query($conn, $query);
    $mantenimiento = mysqli_fetch_assoc($result);

    // Redirigir si no se encuentra el mantenimiento
    if (!$mantenimiento) {
        header("Location: agregar_mantenimiento.php");
        exit();
    }
} else {
    header("Location: agregar_mantenimiento.php");
    exit();
}

// Manejar el envío del formulario de edición
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

    // Actualizar el mantenimiento en la base de datos
    $query_update = "UPDATE mantenimiento SET
                        fecha = '$fecha',
                        tipo = '$tipo',
                        costo = '$costo',
                        cambio_valvulas = '$cambio_valvulas',
                        filtro_aceite = '$filtro_aceite',
                        filtro_gasolina = '$filtro_gasolina',
                        kilometraje = '$kilometraje',
                        chasis = '$chasis',
                        llantas = '$llantas',
                        linea = '$linea',
                        tonelaje = $tonelaje,
                        descripcion = '$descripcion',
                        proveedor = '$proveedor',
                        estadomantenimiento = '$estadomantenimiento',
                        responsable = '$responsable',
                        proximo_mantenimiento = '$proximo_mantenimiento',
                        id_vehiculo = '$id_vehiculo'
                    WHERE id_mantenimiento = $id_mantenimiento";

    if (mysqli_query($conn, $query_update)) {
        // Redirigir después de la actualización
        header("Location: agregar_mantenimiento.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Obtener los vehículos para asociar con el mantenimiento
$query_vehiculos = "SELECT * FROM vehiculos";
$result_vehiculos = mysqli_query($conn, $query_vehiculos);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Mantenimiento</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e8f8f5; /* Fondo color turquesa claro */
            color: #006d79; /* Color de texto azul oscuro */
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #007a8a; /* Color azul más oscuro */
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff; /* Fondo blanco para el formulario */
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #007a8a; /* Borde azul */
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="checkbox"] {
            margin-right: 10px;
        }

        input[type="submit"] {
            background-color: #007a8a; /* Fondo azul */
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #005f6b; /* Color más oscuro al pasar el mouse */
        }
    </style>
</head>
<body>
    <h1>Editar Mantenimiento</h1>
    <form action="editar_mantenimiento.php?id=<?php echo $mantenimiento['id_mantenimiento']; ?>" method="post">
        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha" value="<?php echo $mantenimiento['fecha']; ?>" required>

        <label for="tipo">Tipo:</label>
        <input type="text" name="tipo" value="<?php echo $mantenimiento['tipo']; ?>" required>

        <label for="costo">Costo:</label>
        <input type="number" step="0.01" name="costo" value="<?php echo $mantenimiento['costo']; ?>" required>

        <label for="cambio_valvulas">Cambio de Válvulas:</label>
        <input type="checkbox" name="cambio_valvulas" <?php echo $mantenimiento['cambio_valvulas'] ? 'checked' : ''; ?>>

        <label for="filtro_aceite">Filtro de Aceite:</label>
        <input type="checkbox" name="filtro_aceite" <?php echo $mantenimiento['filtro_aceite'] ? 'checked' : ''; ?>>

        <label for="filtro_gasolina">Filtro de Gasolina:</label>
        <input type="checkbox" name="filtro_gasolina" <?php echo $mantenimiento['filtro_gasolina'] ? 'checked' : ''; ?>>

        <label for="kilometraje">Kilometraje:</label>
        <input type="number" name="kilometraje" value="<?php echo $mantenimiento['kilometraje']; ?>" required>

        <label for="chasis">Chasis:</label>
        <input type="text" name="chasis" value="<?php echo $mantenimiento['chasis']; ?>">

        <label for="llantas">Llantas:</label>
        <input type="text" name="llantas" value="<?php echo $mantenimiento['llantas']; ?>">

        <label for="linea">Línea:</label>
        <input type="text" name="linea" value="<?php echo $mantenimiento['linea']; ?>">

        <label for="tonelaje">Tonelaje:</label>
        <input type="number" step="0.01" name="tonelaje" value="<?php echo $mantenimiento['tonelaje']; ?>">

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" rows="4"><?php echo $mantenimiento['descripcion']; ?></textarea>

        <label for="proveedor">Proveedor:</label>
        <input type="text" name="proveedor" value="<?php echo $mantenimiento['proveedor']; ?>">

        <label for="estadomantenimiento">Estado del Mantenimiento:</label>
        <input type="text" name="estadomantenimiento" value="<?php echo $mantenimiento['estadomantenimiento']; ?>" required>

        <label for="responsable">Responsable:</label>
        <input type="text" name="responsable" value="<?php echo $mantenimiento['responsable']; ?>" required>

        <label for="proximo_mantenimiento">Próximo Mantenimiento:</label>
        <input type="date" name="proximo_mantenimiento" value="<?php echo $mantenimiento['proximo_mantenimiento']; ?>">

        <label for="id_vehiculo">Vehículo:</label>
        <select name="id_vehiculo" required>
            <?php while ($vehiculo = mysqli_fetch_assoc($result_vehiculos)) { ?>
                <option value="<?php echo $vehiculo['id_vehiculo']; ?>" <?php echo $vehiculo['id_vehiculo'] == $mantenimiento['id_vehiculo'] ? 'selected' : ''; ?>>
                    <?php echo $vehiculo['modelo']; ?>
                </option>
            <?php } ?>
        </select>

        <input type="submit" value="Actualizar Mantenimiento">
    </form>
</body>
</html>
