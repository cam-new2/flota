<?php
include 'db.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Obtener el ID del vehículo desde la URL
$id = $_GET['id'];

// Eliminar el vehículo
$sql = "DELETE FROM vehiculos WHERE id_vehiculo=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: vehiculos.php");
    exit();
} else {
    echo "Error al eliminar el vehículo: " . $conn->error;
}
?>
