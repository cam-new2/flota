<?php
include 'db.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

$sql = "DELETE FROM conductores WHERE id_conductor=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: conductores.php");
    exit();
} else {
    echo "Error al eliminar el conductor: " . $conn->error;
}
?>
