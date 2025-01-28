<!-- incluimos la cabecera desde el archivo header.php -->
<?php
if (!isset($_GET["id"])) {
    header("location: proveedores");
}
include 'partials/header.php';


?>
<section class="admin-panel">
    <!-- incluimos el aside desde el archivo aside.php -->
    <?php include 'partials/aside.php' ?>
    <main class="admin-content">

    </main>
</section>
<!-- incluimos el footer desde el archivo footer.php -->
<?php include 'partials/footer.php' ?>
<script src="javascript/script.js"></script>
</body>

</html>