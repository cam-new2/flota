<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transporte Terrestre y Aéreos de Centroamérica, S.A.</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #eaf6f6;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0px 0px 15px rgba(0,0,0,0.2);
        }
        h1, h2, h3 {
            font-family: 'Arial Black', Gadget, sans-serif;
            letter-spacing: 1.5px;
        }
        h1 {
            color: #34495e;
            font-size: 3.5em;
            text-shadow: 2px 2px 5px rgba(0,0,0,0.2);
        }
        h2 {
            color: #2c3e50;
            font-size: 2.5em;
            text-transform: uppercase;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        h3 {
            color: #16a085;
            font-size: 2em;
        }
        p, ul, li {
            color: #555555;
            line-height: 1.8;
            font-size: 1.1em;
        }
        .header {
            text-align: center;
            padding: 70px 0;
            background: linear-gradient(to right, #3498db, #2ecc71);
            color: white;
        }
        .header h1 {
            font-size: 4em;
        }
        .header p {
            font-size: 1.5em;
        }
        .section {
            padding: 30px 0;
            border-bottom: 2px solid #eeeeee;
        }
        .section:last-child {
            border-bottom: none;
        }
        .contact-info, .services, .flota, .certifications, .community {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .contact-info div, .services div, .flota div, .certifications div, .community div {
            flex: 1 1 48%;
            margin-bottom: 20px;
        }
        footer {
            background-color: #34495e;
            color: white;
            text-align: center;
            padding: 20px 0;
            margin-top: 20px;
            font-size: 1.2em;
        }
        footer a {
            color: #ecf0f1;
            text-decoration: none;
        }
        footer a:hover {
            text-decoration: underline;
        }
        /* Button Styling */
        .cta-button {
            display: inline-block;
            padding: 15px 30px;
            margin: 20px 0;
            background-color: #e74c3c;
            color: white;
            font-size: 1.5em;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .cta-button:hover {
            background-color: #c0392b;
            cursor: pointer;
        }
        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .fade {
            animation: fadeIn 2s ease-in;
        }
    </style>
</head>
<body>

    <div class="header fade">
        <h1>Transporte Terrestre y Aéreos de Centroamérica, S.A.</h1>
        <p>¡Líder en el Transporte de Carga en la Región Centroamericana!</p>
        <!-- Imagen añadida aquí -->
        <img src="imagenes/EMPRESA.png" alt="Información sobre la empresa" style="max-width: 10%; height: auto; margin-top: 10px;">
    </div>

    <div class="container fade">
        <div class="section">
            <h2>Descripción de la Empresa</h2>
            <p>Transporte Terrestres y Aéreos de Centroamérica, S.A. es una empresa subsidiaria de Cervecería Centroamericana, S.A., dedicada al transporte terrestre de carga y productos a nivel regional. Con más de 20 años de experiencia en la industria, la empresa se ha posicionado como líder en el sector gracias a su compromiso con la calidad, la seguridad y la eficiencia en el servicio.</p>
        </div>

        <div class="section">
            <h2>Misión</h2>
            <p>Proporcionar servicios de transporte terrestre confiables y eficientes, asegurando la entrega oportuna de productos, contribuyendo al desarrollo económico de la región y manteniendo los más altos estándares de seguridad y sostenibilidad.</p>
        </div>

        <div class="section">
            <h2>Visión</h2>
            <p>Ser la empresa de transporte terrestre más confiable de Centroamérica, reconocida por su innovación y excelencia en el servicio al cliente.</p>
        </div>

        <div class="section">
            <h2>Valores</h2>
            <ul>
                <li><strong>Compromiso:</strong> Dedicados a cumplir con los plazos de entrega y a satisfacer las necesidades de nuestros clientes.</li>
                <li><strong>Seguridad:</strong> Priorizamos la seguridad de nuestros empleados, carga y clientes en todas nuestras operaciones.</li>
                <li><strong>Sostenibilidad:</strong> Implementamos prácticas amigables con el medio ambiente en nuestras operaciones de transporte.</li>
                <li><strong>Innovación:</strong> Buscamos constantemente mejorar nuestros procesos y servicios a través de la tecnología.</li>
                <li><strong>Trabajo en equipo:</strong> Fomentamos un ambiente colaborativo donde cada miembro del equipo es valorado y escuchado.</li>
            </ul>
        </div>

        <div class="section flota">
            <h2>Flota de Vehículos</h2>
            <div>
                <p>Nuestra flota está compuesta por más de 100 vehículos, que incluyen camiones de carga, vehículos refrigerados y vehículos de transporte especializado. Todos nuestros vehículos están equipados con tecnología GPS para garantizar un seguimiento en tiempo real de las entregas.</p>
            </div>
        </div>

        <footer>
            <p>&copy; 2024 Transporte Terrestre y Aéreos de Centroamérica, S.A. | <a href="mailto:contacto@empresa.com">Contacto</a></p>
        </footer>
    </div>

</body>
</html>
