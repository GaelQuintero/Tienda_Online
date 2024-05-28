<?php
// Incluimos el archivo que contiene la clase Database
include_once 'connection/dbconnection.php';

// Verificamos si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibimos los datos del formulario
    $name = $_POST["name"];
    $description = $_POST["description"];
    $category = $_POST["category"];

    // Procesamos la imagen
    $targetDir = "img/articulos/";
    $fileName = basename($_FILES["image"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Verificamos si el archivo es una imagen
    $allowTypes = array('jpg', 'jpeg', 'png');
    if (in_array($fileType, $allowTypes)) {
        // Movemos la imagen a la carpeta de uploads
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            try {
                // Creamos una instancia de la clase Database
                $database = new Database();
                // Obtenemos la conexión a la base de datos
                $conn = $database->getConnection();

                // Preparamos la consulta SQL para insertar los datos en la tabla
                $sql = "INSERT INTO articulos (name, description, image, category) VALUES (:name, :description, :image, :category)";
                $stmt = $conn->prepare($sql);

                // Bind de parámetros
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':description', $description);
                $stmt->bindParam(':image', $fileName);
                $stmt->bindParam(':category', $category);

                // Ejecutamos la consulta
                if ($stmt->execute()) {
                    echo "Registro exitoso";
                } else {
                    echo "Error al registrar los datos.";
                }
            } catch (PDOException $exception) {
                echo "Error de conexión: " . $exception->getMessage();
            }

            // Cerramos la conexión
            $conn = null;
        } else {
            echo "Error al subir la imagen.";
        }
    } else {
        echo "Solo se permiten archivos JPG, JPEG, y PNG.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
    <style>
        form {
            margin: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            max-width: 500px;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"], input[type="file"], select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            float: right;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
        <label for="name">Nombre:</label>
        <input type="text" id="name" name="name" required>
        
        <label for="description">Descripción:</label>
        <textarea id="description" name="description" rows="4" required></textarea>
        
        <label for="image">Imagen:</label>
        <input type="file" id="image" name="image" accept=".jpg, .jpeg, .png" required>
        
        <label for="category">Categoría:</label>
        <select id="category" name="category" required>
            <option value="">Selecciona una categoría</option>
            <option value="Computadoras">Computadoras</option>
            <option value="Laptops"> Laptops</option>
            <option value="Celulares">Celulares</option>
            <!-- Agrega más opciones según sea necesario -->
        </select>
        
        <input type="submit" value="Registrar">
    </form>
</body>
</html>
