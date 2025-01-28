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
        <table>
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
                            <a href="editar-proveedor.php?id=<?php echo $proveedor['id']; ?>" class="button button-edit">Editar</a>
                            <a href="eliminar-proveedor.php?id=<?php echo $proveedor['id']; ?>" class="button button-delete">Eliminar</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <h3>Añadir proveedor</h3>
        <form action="nuevo_proveedor.php" method="post" class="nuevo-proveedor">
            <label for="nombre"></label>
            <input type="text" name="nombre" id="nombre" placeholder="Nombre proveedor" required>
            <label for="web"></label>
            <input type="text" name="web" id="web" placeholder="http://" required>
            <input type="submit" value="Guardar">
        </form>
    </main>
</section>
<!-- incluimos el footer desde el archivo footer.php -->
<?php include 'partials/footer.php' ?>
<script src="javascript/script.js"></script>
</body>

</html>