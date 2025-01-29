<!-- incluimos la cabecera desde el archivo header.php -->
<?php
include 'partials/header.php';
// Consulta a la base de datos para obtener las categorías
$sql = "SELECT * FROM categorias order by id asc";
$stmt = $conn->prepare($sql);
?>
<section class="admin-panel">
    <!-- incluimos el aside desde el archivo aside.php -->
    <?php include 'partials/aside.php' ?>
    <main class="admin-content">
        <h1>Categorías</h1>
        <hr>
        <div class="add-form-container">
            <h3>Añadir categoría</h3>
            <form action="nueva_categoria.php" method="post" class="nueva-categoria">
                <div>
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Nombre categoría" required>
                </div>
                <div>
                    <label for="descripcion">Descripción:</label>
                    <input type="text" name="descripcion" id="descripcion" placeholder="Añade descripción" required>
                </div>
                <input type="submit" value="Añadir">
            </form>
        </div>
        <hr>
        <table class="tabla-resultados">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Ejecutar la consulta
                $stmt->execute();
                // Obtener los resultados
                $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
                // Iterar los resultados
                foreach ($categorias as $categoria) {
                ?>
                    <tr>
                        <td><?php echo $categoria['id']; ?></td>
                        <td><?php echo $categoria['nombre']; ?></td>
                        <td><?php echo $categoria['descripcion']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
</section>
<!-- incluimos el footer desde el archivo footer.php -->
<?php include 'partials/footer.php' ?>
<script src="javascript/script.js"></script>
</body>

</html>