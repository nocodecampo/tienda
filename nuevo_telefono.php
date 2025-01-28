<?php
if(! isset($_POST["telefono"])){
    header("location: proveedores");
}
include 'dbconnect.php';
$sql = "INSERT INTO telefonos (numero, idproveedores) VALUES (:numero, :idproveedores)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':numero',$_POST["telefono"]);
$stmt->bindParam(':idproveedores',$_POST["idproveedor"]);
$stmt->execute();
header('location: proveedores?id='.$_POST["idproveedor"])
?>