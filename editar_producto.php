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

// Manejo de la lógica de editar producto
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $categoria = $_POST['categoria'];
    $cantidad = $_POST['cantidad'];

    // Actualizar producto
    $sql = "UPDATE productos SET nombre='$nombre', descripcion='$descripcion', categoria='$categoria', cantidad=$cantidad WHERE id_producto=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: productos.php");
        exit();
    } else {
        echo "Error al actualizar: " . $conn->error;
    }
}

// Consultar producto para editar
$id = $_GET['id'];
$sql = "SELECT * FROM productos WHERE id_producto=$id";
$result = $conn->query($sql);
$product = $result->fetch_assoc();

if (!$product) {
    die("Producto no encontrado.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto - Sistema de Gestión de Flotas</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        h1 {
            color: #008080; /* Color turquesa */
        }
        form {
            background-color: #e0f7f7; /* Color de fondo del formulario */
            border-radius: 8px;
            padding: 20px;
            margin: 20px auto;
            max-width: 400px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        button {
            background-color: #008080; /* Color del botón */
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #006666; /* Color al pasar el mouse */
        }
        a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #008080; /* Color de enlace */
        }
        a:hover {
            text-decoration: underline;
        }
        .logo {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="logo">
        <img src="imagenes/productos.png" alt="Productos" width="100" height="100">
    </div>
    <h1>Editar Producto</h1>
    
    <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo $product['id_producto']; ?>">
        
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $product['nombre']; ?>" required>
        
        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" required><?php echo $product['descripcion']; ?></textarea>
        
        <label for="categoria">Categoría:</label>
        <input type="text" id="categoria" name="categoria" value="<?php echo $product['categoria']; ?>" required>
        
        <label for="cantidad">Cantidad:</label>
        <input type="number" id="cantidad" name="cantidad" value="<?php echo $product['cantidad']; ?>" required>
        
        <button type="submit">Actualizar Producto</button>
    </form>

    <a href="productos.php">Volver a la lista de productos</a>
</body>
</html>

<?php
$conn->close();
?>
