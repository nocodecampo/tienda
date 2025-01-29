<?php
if (!isset($_POST["nombre"])) {
    header("location: categorias");
    exit;
}
include 'dbconnect.php';
$sql = "INSERT INTO categorias (nombre, descripcion) VALUES (:nombre, :descripcion)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':nombre', $_POST["nombre"]);
$stmt->bindParam(':descripcion',$_POST["descripcion"]);
$stmt->execute();
$id=$conn->lastInsertId();
header("location: categorias");
exit;

?>
