<?php
// Incluir el archivo de conexión a la base de datos
require 'dbconnection.php'; // Ajusta la ruta según sea necesario

// Verificar si el formulario de recuperación fue enviado
if (isset($_POST['submit'])) {
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
            // Incluir la librería PHPMailer
            use PHPMailer\PHPMailer\PHPMailer;
            use PHPMailer\PHPMailer\SMTP;
            use PHPMailer\PHPMailer\Exception;

            require 'vendor/autoload.php'; // Ajusta la ruta según sea necesario

            // Configurar PHPMailer
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'tucorreo@gmail.com'; // Cambia a tu dirección de Gmail
            $mail->Password = 'tu-contraseña-de-aplicacion'; // Usa la contraseña de aplicación generada
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // O SSL si corresponde
            $mail->Port = 587; // O el puerto que estás utilizando

            // Configuración adicional
            $mail->setFrom('tucorreo@gmail.com', 'Nombre del remitente'); // Cambia según sea necesario
            $mail->addAddress($email); // Añade aquí el correo electrónico del destinatario

            // Contenido del correo
            $mail->isHTML(true);
            $mail->Subject = 'Recuperación de contraseña';
            $mail->Body = 'Haz clic en el siguiente enlace para restablecer tu contraseña: <a href="http://tu-sitio.com/reset_password.php?email=' . $email . '&token=' . $token . '">Restablecer Contraseña</a>';

            // Intentar enviar el correo
            $mail->send();
            echo 'El email de recuperación ha sido enviado correctamente';
        } catch (Exception $e) {
            echo "El email no pudo ser enviado. Error: {$mail->ErrorInfo}";
        }
    } else {
        echo 'Hubo un error al guardar el token en la base de datos';
    }
}
?>
