<!-- incluimos la cabecera desde el archivo header.php -->
<?php
include 'partials/header.php';
// Consulta a la base de datos para obtener los proveedores
$sql = "SELECT * FROM proveedores order by id desc";
$stmt = $conn->prepare($sql);
?>
<section class="admin-panel">
    <!-- incluimos el aside desde el archivo aside.php -->
    <?php include 'partials/aside.php' ?>
    <main class="admin-content">
        <h1>Proveedores</h1>
        <table class="tabla-resultados">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Web</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Ejecutar la consulta
                $stmt->execute();
                // Obtener los resultados
                $proveedores = $stmt->fetchAll(PDO::FETCH_ASSOC);
                // Iterar los resultados
                foreach ($proveedores as $proveedor) {
                ?>
                    <tr>
                        <td><?php echo $proveedor['id']; ?></td>
                        <td><?php echo $proveedor['nombre']; ?></td>
                        <td><?php echo $proveedor['web']; ?></td>
                        <td>
                            <a href="editar-proveedor.php?id=<?php echo $proveedor['id']; ?>" ><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="eliminar-proveedor.php?id=<?php echo $proveedor['id']; ?>" ><i class="fa-solid fa-trash"></i></a>
                            <a href="proveedores.php?id=<?php echo $proveedor['id']; ?>" ><i class="fa-solid fa-address-book"></i></a>
                            <a href="proveedor.php?id=<?php echo $proveedor['id']; ?>" ><i class="fa-solid fa-eye"></i></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <hr>
        <div class="add-form-container">
            <h3>Añadir proveedor</h3>
            <form action="nuevo_proveedor.php" method="post" class="nuevo-proveedor">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre proveedor" required>
                <label for="web">Web:</label>
                <input type="text" name="web" id="web" placeholder="http://" required>
                <input type="submit" value="Guardar">
            </form>
        </div>
        <?php
        if (isset($_GET["id"])) {
        ?>
            <div class="secondary-form-container">
                <div class="direccion-form">
                    <h3>Nueva dirección</h3>
                    <form action="nueva_direccion.php" method="post">
                        <input type="hidden" name="idproveedor" value="<?php echo $_GET["id"] ?>">
                        <label for="calle">Calle</label>
                        <input type="text" name="calle" id="calle" required placeholder="Calle">
                        <label for="numero">Número</label>
                        <input type="text" name="numero" id="numero" required placeholder="Número">
                        <label for="comuna">Comuna</label>
                        <input type="text" name="comuna" id="comuna" required placeholder="Comuna">
                        <label for="ciudad">Ciudad</label>
                        <input type="text" name="ciudad" id="ciudad" required placeholder="Ciudad">
                        <div class="buttons-container">
                            <input type="reset" value="Cancelar">
                            <input type="submit" value="Guardar">
                        </div>
                    </form>
                </div>
                <div class="telf-form">
                    <h3>Nuevo teléfono</h3>
                    <form action="nuevo_telefono.php" method="post">
                        <input type="hidden" name="idproveedor" value="<?php echo $_GET["id"] ?>">
                        <label for="telefono">Teléfono</label>
                        <input type="text" name="telefono" id="telefono" required placeholder="Teléfono">
                        <div class="buttons-container">
                            <input type="reset" value="Cancelar">
                            <input type="submit" value="Guardar">
                        </div>
                    </form>
                </div>
            </div>
        <?php } ?>
    </main>
</section>
<!-- incluimos el footer desde el archivo footer.php -->
<?php include 'partials/footer.php' ?>
<script src="javascript/script.js"></script>
</body>

</html>