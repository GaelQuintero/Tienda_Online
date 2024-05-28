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
            echo "Las contraseñas no coinciden.";
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
            // Hash de la nueva contraseña
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Actualizar la contraseña en la tabla userstechstore
            $stmt = $db->prepare('UPDATE userstechstore SET password = :password WHERE email = :email');
            $stmt->execute(array(':password' => $hashed_password, ':email' => $email));

            // Eliminar el token usado
            $stmt = $db->prepare('DELETE FROM password_resets WHERE email = :email');
            $stmt->execute(array(':email' => $email));

            echo "Tu contraseña ha sido actualizada correctamente.";
        } else {
            echo "Token inválido o expirado.";
        }
    } else {
        echo "Todos los campos son obligatorios.";
    }
} else {
    echo "Método de solicitud no válido.";
}
?>


