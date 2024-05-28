
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!--Manda a llamar los css de bootstrap-->
      <link rel="stylesheet" href="css/bootstrap.css">
    <title>Reset Password</title>
    <!--CDN de SweetAlert2-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
<?php
// Incluir el archivo de conexión a la base de datos
require 'connection/dbconnection.php'; // Ajusta la ruta según sea necesario

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['email'], $_POST['token'], $_POST['password'], $_POST['confirm_password'])) {
        $email = $_POST['email'];
        $token = $_POST['token'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        if ($password !== $confirm_password) {
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
            Swal.fire({
                icon: "error",
                title: "Las contraseñas no coinciden",
                text: "Por favor, asegúrate de que las contraseñas coincidan.",
            });
            </script>';
            exit;
        }

        // Crear una instancia de la base de datos
        $database = new Database();
        $db = $database->getConnection();

        // Verificar el token
        $stmt = $db->prepare('SELECT * FROM password_resets WHERE email = :email AND token = :token');
        $stmt->execute(array(':email' => $email, ':token' => $token));
        $password_reset = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($password_reset) {
            // Actualizar la contraseña en la tabla userstechstore sin hashear
            $stmt = $db->prepare('UPDATE userstechstore SET password = :password WHERE email = :email');
            $stmt->execute(array(':password' => $password, ':email' => $email));

            // Eliminar el token usado
            $stmt = $db->prepare('DELETE FROM password_resets WHERE email = :email');
            $stmt->execute(array(':email' => $email));

            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
            Swal.fire({
                icon: "success",
                title: "Tu contraseña se ha actualizado correctamente",
                text: "En breve saldra de aqui.",
                timer: 2000,
            }).then(function() {
                // Redirige a la página de inicio de sesión después de cerrar la alerta
                window.location.href = "login.php";
            });
            </script>';
        } else {
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
            Swal.fire({
                icon: "error",
                title: "Token inválido o expirado",
                text: "Por favor, solicita un nuevo enlace para restablecer tu contraseña.",
            });
            </script>';
        }
    } else {
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
        Swal.fire({
            icon: "error",
            title: "Todos los campos son obligatorios",
            text: "Por favor, completa todos los campos.",
        });
        </script>';
    }
} else {
    echo "Método de solicitud no válido.";
}
?>
</body>