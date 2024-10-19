<?php
// Conectar a la base de datos
include 'db.php';

// Comprobar si el usuario está autenticado
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Obtener todos los vehículos de la base de datos
$sql = "SELECT * FROM vehiculos";
$result = $conn->query($sql);

// Función para generar PDF
if (isset($_POST['download_pdf'])) {
    require('fpdf/fpdf.php');
    
    // Crear instancia de FPDF
    $pdf = new FPDF();
    $pdf->AddPage();
    
    // Configuración del título del documento
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Lista de Vehículos', 0, 1, 'C');
    
    // Espacio
    $pdf->Ln(10);

    // Configuración de encabezados de la tabla
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(20, 10, 'ID', 1);
    $pdf->Cell(40, 10, 'Marca', 1);
    $pdf->Cell(40, 10, 'Modelo', 1);
    $pdf->Cell(20, 10, 'Año', 1);
    $pdf->Cell(30, 10, 'Estado', 1);
    $pdf->Cell(40, 10, 'Capacidad', 1);
    $pdf->Ln();

    // Agregar datos de los vehículos
    $pdf->SetFont('Arial', '', 12);
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(20, 10, $row['id_vehiculo'], 1);
        $pdf->Cell(40, 10, $row['marca'], 1);
        $pdf->Cell(40, 10, $row['modelo'], 1);
        $pdf->Cell(20, 10, $row['ano'], 1);
        $pdf->Cell(30, 10, $row['estado'], 1);
        $pdf->Cell(40, 10, $row['capacidad'], 1);
        $pdf->Ln();
    }

    // Especificar que el archivo se descargue automáticamente
    $pdf->Output('D', 'lista_vehiculos.pdf');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Vehículos</title>
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

        .container {
            width: 90%;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 12px 15px;
            border: 1px solid #ccc;
            text-align: center;
            font-size: 14px;
        }

        th {
            background-color: #00796b; /* Verde turquesa oscuro */
            color: white;
        }

        td {
            background-color: #ffffff;
        }

        tr:nth-child(even) td {
            background-color: #e0f2f1; /* Fila color más claro */
        }

        a {
            color: #00796b; /* Enlaces en verde turquesa */
            text-decoration: none;
        }

        a:hover {
            color: #004d40; /* Enlaces verde más oscuro al pasar */
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .dashboard-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #004d40; /* Botones oscuros */
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            margin: 5px;
            transition: 0.3s;
        }

        .dashboard-button:hover {
            background-color: #00796b; /* Oscurecer al pasar el ratón */
        }

        .download-button {
            background-color: #009688; /* Botón para descargar PDF */
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            display: inline-block;
            transition: 0.3s;
        }

        .download-button:hover {
            background-color: #00796b;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Lista de Vehículos</h1>

        <table>
            <tr>
                <th>ID</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Año</th>
                <th>Estado</th>
                <th>Capacidad</th>
                <th>Acciones</th>
            </tr>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id_vehiculo']; ?></td>
                <td><?php echo $row['marca']; ?></td>
                <td><?php echo $row['modelo']; ?></td>
                <td><?php echo $row['ano']; ?></td>
                <td><?php echo $row['estado']; ?></td>
                <td><?php echo $row['capacidad']; ?></td>
                <td>
                    <a href="editar_vehiculo.php?id=<?php echo $row['id_vehiculo']; ?>">Editar</a> |
                    <a href="eliminar_vehiculo.php?id=<?php echo $row['id_vehiculo']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este vehículo?');">Eliminar</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>

        <div class="button-container">
            <form method="POST" action="">
                <button type="submit" name="download_pdf" class="download-button">Descargar PDF</button>
            </form>
            <a href="registrar_vehiculo.php" class="dashboard-button">Agregar Nuevo Vehículo</a>
            <a href="dashboard.php" class="dashboard-button">Volver al Dashboard</a>
        </div>
    </div>
</body>
</html>
