<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema de Gestión de Flotas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            overflow: hidden; /* Para que no haya scroll */
            background-image: url('imagenes/logofofondo.png'); /* Asegúrate de que la imagen esté en este directorio */
            background-size: cover; /* Para que la imagen cubra toda la pantalla */
            background-position: center; /* Para centrar la imagen */
        }

        .login-container {
            background-color: rgba(255, 255, 255, 0.9); /* Fondo semitransparente para ver la imagen */
            padding: 40px; /* Aumentar el padding */
            border-radius: 15px;
            box-shadow: 0px 10px 30px rgba(0,0,0,0.3); /* Sombra más intensa */
            width: 400px; /* Aumentar el ancho */
            z-index: 1; /* Mantiene el formulario encima de la imagen */
            text-align: center; /* Centrar el texto */
            transition: transform 0.3s; /* Efecto de movimiento */
            margin: 0 auto; /* Centramos el contenedor */
        }

        .login-container:hover {
            transform: scale(1.05); /* Efecto de escalado al pasar el mouse */
        }

        h1 {
            color: #007bff; /* Color del texto del título */
            font-size: 24px; /* Tamaño del texto del título */
            margin-bottom: 20px; /* Espaciado inferior */
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2); /* Sombra de texto */
        }

        h2 {
            color: #007bff; /* Color del texto del encabezado */
            margin-bottom: 20px;
            font-weight: bold;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2); /* Sombra de texto */
        }

        input {
            width: 100%;
            padding: 15px; /* Aumentar el padding */
            margin: 10px 0;
            border: 2px solid #007bff; /* Borde más grueso */
            border-radius: 5px;
            transition: border-color 0.3s; /* Transición para el borde */
        }

        input:focus {
            border-color: #0056b3; /* Color del borde al hacer foco */
            outline: none; /* Sin contorno por defecto */
        }

        button {
            background-color: #17a2b8; /* Color del botón turquesa */
            color: white;
            padding: 15px; /* Aumentar el padding */
            border: none;
            cursor: pointer;
            width: 100%;
            border-radius: 5px;
            font-size: 18px; /* Aumentar el tamaño de la fuente */
            transition: background-color 0.3s, transform 0.3s; /* Transiciones */
        }

        button:hover {
            background-color: #138496; /* Color del botón al pasar el mouse */
            transform: translateY(-2px); /* Mover hacia arriba */
        }

        button:active {
            transform: translateY(1px); /* Volver hacia abajo al hacer clic */
        }

        footer {
            margin-top: 20px; /* Espacio encima del footer */
            color: #555; /* Color del texto del footer */
            font-size: 14px; /* Tamaño de la fuente del footer */
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h1>TRANSPORTES TERRESTRES Y AÉREOS DE CENTRO AMÉRICA S.A.</h1>
        <h2>Login</h2>
        <form action="authenticate.php" method="POST">
            <input type="text" name="username" placeholder="Usuario" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Ingresar</button>
        </form>
        <footer>Sistema desarrollado por Camila Castillo</footer> <!-- Pie de página -->
    </div>
    
</body>
</html>
