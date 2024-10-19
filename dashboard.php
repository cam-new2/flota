<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Si el usuario no está logueado, lo rediriges al login
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistema de Gestión de Flotas</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f8f9fa;
        }

        .title-container {
            display: flex;
            align-items: center;
            gap: 15px; /* Espacio entre la imagen y el título */
        }

        h1 {
            color: #007bff;
        }

        .title-image {
            width: 50px; /* Ajusta el tamaño de la imagen */
            height: 50px;
        }

        .module-button {
            display: flex; /* Para alinear el texto y la imagen horizontalmente */
            align-items: center; /* Alineación vertical al centro */
            padding: 20px;
            background-color: #40E0D0; /* Color turquesa */
            color: white;
            text-decoration: none;
            border-radius: 10px;
            margin-bottom: 30px;
            width: calc(100% - 20px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s, transform 0.3s;
        }

        .module-button:hover {
            background-color: #30C4B0; /* Color turquesa más oscuro para el hover */
            transform: translateY(-2px);
        }

        .module-button img {
            width: 30px; /* Tamaño de las imágenes en los botones */
            height: 30px;
            margin-right: 10px;
        }

        .card {
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #007bff;
            color: white;
        }

        .card-body {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="title-container">
            <img src="imagenes/imagenes.png" alt="Logo adicional" class="title-image"> <!-- Nueva imagen -->
            <h1>Sistema de Gestión de Flotas</h1>
        </div>
        <p>Usuario: <strong><?php echo $_SESSION['username']; ?></strong></p>

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Módulos
                    </div>
                    <div class="card-body">
                        <div class="modules">
                            <a href="registro.php" class="module-button">
                                <img src="imagenes/1.png" alt="Conductores">
                                Módulo Conductores
                            </a>
                            <a href="registrar_vehiculo.php" class="module-button">
                                <img src="imagenes/2.png" alt="Vehículos">
                                Módulo Vehículos
                            </a>
                            <a href="registrar_viaje.php" class="module-button">
                                <img src="imagenes/3.png" alt="Viajes">
                                Registro de Viajes
                            </a>
                            <a href="productos.php" class="module-button">
                                <img src="imagenes/4.png" alt="Productos">
                                Módulo Productos
                            </a>
                            <a href="agregar_mantenimiento.php" class="module-button">
                                <img src="imagenes/5.png" alt="Mantenimiento">
                                Módulo Mantenimiento
                            </a>
                            <a href="info.php" class="module-button">
                                <img src="imagenes/EMPRESA.png" alt="EMPRESA">
                                EMPRESA
                            <a href="logout.php" class="module-button">
                                <img src="imagenes/6.png" alt="Cerrar sesión">
                                Cerrar sesión
                            </a>
                            
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Estadísticas Generales
                    </div>
                    <div class="card-body">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Datos de ejemplo para el gráfico (aquí debes reemplazar con los datos reales de tus módulos)
        const labels = ['Conductores', 'Vehículos', 'Viajes', 'Productos', 'Mantenimientos'];
        const data = {
            labels: labels,
            datasets: [{
                label: 'Cantidad',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                data: [10, 15, 20, 5, 7], // Cambia esto por los datos que necesites
            }]
        };

        const config = {
            type: 'bar', // Puedes cambiar a 'line', 'pie', etc.
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
