<?php
$servername = "localhost";  // El servidor es localhost porque estás usando XAMPP
$username = "root";         // El nombre de usuario predeterminado en XAMPP es "root"
$password = "";             // En XAMPP, por defecto, no hay contraseña para root
$dbname = "flotas";         // El nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
