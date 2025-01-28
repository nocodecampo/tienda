<?php
if (!isset($_POST["nombre"])) {
    header("location: proveedores");
    exit;
}
include 'dbconnect.php';
$sql = "INSERT INTO proveedores (nombre, web) VALUES (:nombre, :web)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':nombre', $_POST["nombre"]);
$stmt->bindParam(':web',$_POST["web"]);
$stmt->execute();
$id=$conn->lastInsertId();
header("location: proveedores?id=$id");

?>
