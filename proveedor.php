<!-- incluimos la cabecera desde el archivo header.php -->
<?php
if (!isset($_GET["id"])) {
    header("location: proveedores");
}
include 'partials/header.php';

$sql = "SELECT P.id,P.nombre,P.web,D.id as iddireccion,D.calle,D.numero,D.comuna,D.ciudad
,T.id as idtelefono,T.numero as telefono FROM tienda.proveedores P 
left join tienda.direcciones D on P.id=D.proveedores_id
left join tienda.telefonos T on T.idproveedores=P.id
where P.id=:id;";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":id", $_GET["id"]);
$result = $stmt->execute();

?>

<section class="admin-panel">
    <!-- incluimos el aside desde el archivo aside.php -->
    <?php include 'partials/aside.php' ?>
    <main class="admin-content">
        <h1>Datos del proveedor</h1>
        <?php
        $direcciones=[];
        $telefonos=[];
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
        if($row){
            echo "
            <div class='proveedor'>
            <h4>{$row['nombre']}</h4>
            <p>Web: <a href='{$row['web']}'>{$row['web']}</a></p>
            </div>
            ";
        }
        ?>
    </main>
</section>
<!-- incluimos el footer desde el archivo footer.php -->
<?php include 'partials/footer.php' ?>
<script src="javascript/script.js"></script>
</body>

</html>