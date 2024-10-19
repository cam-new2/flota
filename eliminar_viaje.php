<?php
include 'db.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id_viaje = $_GET['id'];
    
    // Eliminar el viaje
    $sql = "DELETE FROM registro_viajes WHERE id_viaje=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_viaje);
    
    if ($stmt->execute()) {
        header("Location: lista_viajes.php");
    } else {
        echo "Error al eliminar el viaje: " . $stmt->error;
    }
} else {
    header("Location: lista_viajes.php");
}
?>
