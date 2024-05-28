<?php 
session_start();
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
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-12G983F99E"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-12G983F99E');
</script>
</head>
<body>
    <div class="container">
        <div class="glitch" data-text="404">404</div>
        <div class="message">Página no encontrada</div>
        <p class="message">¡Lo sentimos mucho!</p>
        <p class="message">Lamentablemente, la página que estás buscando no se encuentra disponible en este momento.</p>
        <?php 
        // Verificar si el usuario ha iniciado sesión
        if (isset($_SESSION['idUser'])) {
            // Si el usuario ha iniciado sesión, mostrar el enlace de inicio
            echo '<p class="message">Puedes regresar a la página de inicio haciendo clic <a href="inicio.php">aquí</a>.</p>';
        } else {
            // Si el usuario no ha iniciado sesión, mostrar el enlace de inicio de sesión
            echo '<p class="message">Puedes regresar a la página de inicio haciendo clic <a href="index.php">aquí</a>.</p>';
        }
        ?>
        <p class="message">Gracias por tu comprensión.</p>
    </div>
    <script src="script.js"></script>
</body>
</html>
>
