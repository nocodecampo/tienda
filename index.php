<?php 
if(isset($_POST['username'])){
    try{
        // Incluir el archivo de conexión a la base de datos
        include 'dbconnect.php';
        $username = $_POST['username'];
        $password = $_POST['password'];
        // Consulta para obtener el usuario y contraseña
        $sql = "SELECT * FROM usuarios WHERE username = :username";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        // Verificar si el usuario existe
        if($user){
            // Verificar si la contraseña es correcta
            if(password_verify($password, $user['password'])){
                // Iniciar sesión
                session_start();
                $_SESSION['user'] = $user;
                // Redireccionar a la página de inicio
                header('Location: admin');
                exit;
            }else{
                $error = 'Usuario o contraseña incorrectos';
            }
        }else{
            $error = 'Usuario o contraseña incorrectos';
        }
    }catch(PDOException $e){
        $error = $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
</head>
<link rel="stylesheet" href="style.css">
<body>
    <section class="section-login">
        <div class="form-container">
            <h1>Bienvenido a la Tienda</h1>
        <!--Formulario de login con username y password-->
        <form action="" method="post" class="login-form">
            <label for="username">Usuario</label>
            <input type="text" name="username" id="username" placeholder="Tu usuario" required>
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password" placeholder="Tu contraseña" required>
            <input type="submit" value="Iniciar sesión">
            <?php if(isset($error)): ?>
                <span class="error"><?php echo $error; ?></span>
            <?php endif; ?>
        </form>
        </div>
    </section>
</body>
</html>