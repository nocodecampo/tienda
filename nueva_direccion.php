<?php
if(! isset($_POST["calle"])){
    header("location: proveedores");
}
include 'dbconnect.php';
$sql = "INSERT INTO direcciones (calle, numero, comuna, ciudad, proveedores_id) VALUES (:calle, :numero, :comuna, :ciudad, :proveedor_id)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':calle', $_POST["calle"]);
$stmt->bindParam(':numero', $_POST["numero"]);
$stmt->bindParam(':comuna',$_POST["comuna"]);
$stmt->bindParam(':ciudad',$_POST["ciudad"]);
$stmt->bindParam(':proveedor_id',$_POST["idproveedor"]);
$stmt->execute();
header('location: proveedores?id='.$_POST["idproveedor"]);
?>