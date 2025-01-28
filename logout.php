<?php
// Iniciamos la sesión
session_start();
// Cerramos la sesión
session_destroy();
// Redirigimos a la página de login
header('Location: index');
?>