<?php 
session_start();
if(!isset($_SESSION['user'])){
    header('Location: index.php');
    exit;
}
$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de administración</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header class="header-admin">
        <img src="img/logo.webp" alt="LOGO" class="logo">
        <div>
            <p class="welcome">Bienvenido, <?php echo $user['username']; ?></p>
            <a href="logout.php" class="logout-button">Cerrar sesión</a>
        </div>
    </header>
    <section class="admin-panel">
        <aside class="admin-menu"></aside>
        <main class="admin-content">
        </main>
    </section>
</body>

</html>