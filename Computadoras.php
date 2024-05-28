<?php 
session_start();

require_once('connection/dbconnection.php'); // Incluye el archivo de conexión a la base de datos

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Computadoras 💻</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.png">
     <!--Manda a llamar los css de bootstrap-->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-grid.css">
    <link rel="stylesheet" href="css/bootstrap-utilities.css">
    <link rel="stylesheet" href="css/bootstrap-grid.rtl.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.css">
     <!--Manda a llamar el css de index-->
    <link rel="stylesheet" href="css/index.css">
     <!--Manda a llamar el script de bootstrap-->
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/bootstrap.esm.js"></script>
    <!--CDN de iconos de bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!--CDN de SweetAlert2-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--API para el chat-->
    <script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="a2cff799-adf7-4880-b0cf-e072cb6b28bc";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>
</head>
<body>
     <!--Footer de inicio-->
     <footer class="bg-dark text-light py-2">
        <div class="container">
            <div class="row">
                <div class="col-md-6 d-flex flex-column flex-md-row align-items-center">
                    <p class="mb-0 me-md-3"><i class="bi bi-telephone-fill text-danger"></i> Teléfono: +844 171 6912</p>
                    <p class="mb-0"><i class="bi bi-envelope-fill"></i> Email: TechStore@hotmail.com</p>
                </div>
                <?php
// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION['idUser'])) {
    // Si el usuario ha iniciado sesión, mostrar el enlace de cerrar sesión
    echo '<div class="col-md-6 d-flex justify-content-end mt-2 mt-md-0">';
    echo '    <a href="logout.php" class="text-light me-3">Cerrar sesión <i class="bi bi-door-open"></i></a>';
    echo '</div>';
} else {
    // Si el usuario no ha iniciado sesión, mostrar los enlaces de registro e inicio de sesión
    echo '<div class="col-md-6 d-flex justify-content-end mt-2 mt-md-0">';
    echo '    <a href="registration.php" class="text-light me-3">Registrarse <i class="bi bi-check2-circle"></i></a>';
    echo '    <a href="login.php" class="text-light"> Iniciar sesión <i class="bi bi-person-circle"></i></a>';
    echo '</div>';
}
?>


            </div>
        </div>
    </footer>
     <!--End Footer-->
    <!--Navbar-->
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark sticky-top ">
        <div class="container-fluid">
          <a class="navbar-brand" href="index.php"> 
            <h2>
            <span class="text-white">Tech</span>
            <span class="text-primary">Store</span> 💻
            </h2>
         </a>
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        
          <div class="collapse navbar-collapse" id="mynavbar">
            <ul class="navbar-nav me-auto">
              <li class="nav-item">
                <a class="nav-link" href="errorPage.php">Acerca de</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="Articulos.php">Articulos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="Computadoras.php">Computadoras</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="Laptops.php">Laptops</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="Celulares.php">Celulares</a>
              </li>
            </ul>
            <form class="d-flex" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">
    <input class="form-control me-2" type="text" placeholder="Buscar computadoras" name="search">
    <button class="btn btn-primary" type="submit">Buscar</button>
    &nbsp;
    <button class="btn btn-primary" type="submit">All</button>
</form>

          </div>
        </div>
      </nav>
       <!--End Navbar-->

          <!--Footer de de articulos-->
     <footer class="bg-dark text-light py-2">
        <div class="container">
            <div class="row">
                
                    <h3 class="mb-0 text-center">Las mejores computadoras ⭐⭐⭐</h3>
                         
            </div>
        </div>
    </footer>
     <!--End Footer-->
      <!--Cards de articulos-->
      <div class="container mt-4">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php
        // Incluimos el archivo que contiene la clase Database
        include_once 'connection/dbconnection.php';

        try {
            // Creamos una instancia de la clase Database
            $database = new Database();
            // Obtenemos la conexión a la base de datos
            $conn = $database->getConnection();

            // Definimos la consulta SQL para obtener solo los artículos de la categoría "Laptops"
            $sql = "SELECT * FROM articulos WHERE category = 'Computadoras'";

            // Verificamos si se ha enviado el formulario de búsqueda y hay un término de búsqueda
            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search'])) {
                $search = $_GET['search'];
                // Añadimos la condición de búsqueda a la consulta SQL base
                $sql .= " AND (name LIKE :search OR description LIKE :search)";
            }

            // Preparamos y ejecutamos la consulta
            $stmt = $conn->prepare($sql);

            // Si hay un término de búsqueda, bind de parámetro
            if (isset($search)) {
                $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
            }

            $stmt->execute();
            // Obtenemos los resultados
            $articulos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Verificamos si se encontraron resultados
            if (count($articulos) > 0) {
                // Si se encontraron resultados, mostramos los artículos
                foreach ($articulos as $articulo) {
                    echo '<div class="col">';
                    echo '<div class="card h-100 d-flex flex-column">';
                    echo '<img src="img/articulos/' . $articulo['image'] . '" class="card-img-top" alt="' . $articulo['name'] . '">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $articulo['name'] . '</h5>';
                    echo '<p class="card-text">' . $articulo['description'] . '</p>';
                    echo '<a href="' . $articulo['category'] . '.php" class="btn btn-primary">Comprar</a>';
                    echo '</div></div></div>';
                }
            } else {
                // Si no se encontraron resultados, mostramos un mensaje
                echo '<div class="col text-center" style="margin-left: 420px;">';
                echo '<div class="alert alert-danger" role="alert">';
                echo 'No se encontraron computadoras que coincidan con la búsqueda.';
                echo '</div>';
                echo '</div>';
            }
        } catch (PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }
        ?>
    </div>
</div>



<!--End cards-->
       <!--End formulario de quejas o sugerencias-->
       <br>
       <br>
       <br>
       <!--Footer final-->
       <footer class="bg-dark text-light py-2 fixed-bottom">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-6">
                    <p class="mb-0"><i class="bi bi-house-door-fill"></i> Dirección: 123 Calle Principal, Ciudad</p>
                </div>
                <div class="col-md-6 d-flex flex-column flex-md-row-reverse align-items-center">
                    <a href="#" class="text-light me-3"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-light me-3"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="text-light me-3"><i class="bi bi-instagram"></i></a>
                    <a href="tel:+8441716912" class="text-light me-3"><i class="bi bi-telephone-fill text-danger"></i> +844 171 6912</a>
                    <a href="mailto:TechStore@hotmail.com" class="text-light"><i class="bi bi-envelope-fill"></i> TechStore@hotmail.com</a>
                </div>
            </div>
        </div>
    </footer>    
    <!--End Footer-->
</body>
</html>