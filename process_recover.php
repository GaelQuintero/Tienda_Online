<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!--Manda a llamar los css de bootstrap-->
      <link rel="stylesheet" href="css/bootstrap.css">
    <title>Proccess recover</title>
</head>
<body>
    


<?php
// Incluir el archivo de conexión a la base de datos
require 'connection/dbconnection.php'; // Ajusta la ruta según sea necesario

// Incluir la librería PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Ajusta la ruta según sea necesario

// Crear una instancia de la clase Database y obtener la conexión
$database = new Database();
$conn = $database->getConnection();

// Verificar si el formulario de recuperación fue enviado
if (isset($_POST['recoverPassword'])) {
    // Capturar el correo electrónico desde el formulario
    $email = $_POST['email'];

    // Generar un token único para la recuperación de contraseña
    $token = bin2hex(random_bytes(50)); // Genera un token aleatorio seguro

    // Insertar el token en la base de datos junto con el correo electrónico y la fecha de expiración
    $query = "INSERT INTO password_resets (email, token, created_at) VALUES (:email, :token, NOW())";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':token', $token);

    if ($stmt->execute()) {
        // Enviar correo electrónico de recuperación
        try {
            // Configurar PHPMailer
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'robertogael664@gmail.com'; // Cambia a tu dirección de Gmail
            $mail->Password = 'elxt bjye fccf pfrp'; // Usa la contraseña de aplicación generada
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // O SSL si corresponde
            $mail->Port = 587; // O el puerto que estás utilizando

            // Configuración adicional
            $mail->setFrom('robertogael664@gmail.com', 'Tech Store'); // Cambia según sea necesario
            $mail->addAddress($email); // Añade aquí el correo electrónico del destinatario

            // Contenido del correo
            $mail->isHTML(true);
            $mail->Subject = 'Password recovery';
            $mail->Body = 'Haz clic en el siguiente enlace para restablecer tu clave de acceso: <a href="http://tu-sitio.com/reset_password.php?email=' . $email . '&token=' . $token . '">Restablecer clave de acceso</a>';

            // Intentar enviar el correo
            $mail->send();
            echo '
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
            Swal.fire({
                icon: "success",
                title: "El email de recuperación ha sido enviado correctamente",
                text: "En breve se le enviará un correo.",
                timer: 2000,
            }).then(function() {
                window.location = "login.php"; // Redirige a la página de inicio de sesión después de cerrar la alerta
            });
            </script>';
        } catch (Exception $e) {
            echo '
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
            Swal.fire({
                icon: "error",
                title: "El email no pudo ser enviado",
                text: "Error: ' . $mail->ErrorInfo . '"
            }).then(function() {
                window.location = "forgetpassword.php"; // Redirige a la página de recuperación después de cerrar la alerta
            });
            </script>';
        }
    } else {
        echo '
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
        Swal.fire({
            icon: "error",
            title: "Hubo un error al guardar el token en la base de datos"
        }).then(function() {
            window.location = "forgetpassword.php"; // Redirige a la página de recuperación después de cerrar la alerta
        });
        </script>';
    }
}
?>
</body>
</html>
