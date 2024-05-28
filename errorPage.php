<?php 
session_start();

// Si ya hay una sesión activa, redirigir al usuario a la página de inicio
if (isset($_SESSION['idUser'])) {
    header("Location: inicio.php");
    exit();
}
require_once('connection/dbconnection.php'); // Incluye el archivo de conexión a la base de datos

?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 404 - Página no encontrada</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.png">
    <link rel="stylesheet" href="css/errorPage.css">
</head>
<body>
    <div class="container">
        <div class="glitch" data-text="404">404</div>
        <div class="message">Página no encontrada</div>
        <p class="message">¡Lo sentimos mucho!</p>
        <p class="message">Lamentablemente, la página que estás buscando no se encuentra disponible en este momento.</p>
        <p class="message">Puedes regresar a la página de inicio haciendo clic <a href="index.php">aquí</a>.</p>
        <p class="message">Gracias por tu comprensión.</p>
    </div>
    <script src="script.js"></script>
</body>
</html>
