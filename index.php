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
    <title>Tech Store 💻</title>
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
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-12G983F99E"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-12G983F99E');
</script>
</head>
<!--Codigo para registrar los comentarios-->
<?php
class ConexionBD {
    private $conexion;

    public function __construct($db) {
        $this->conexion = $db;
    }

    public function insertarComentario($email, $name, $comment) {
        try {

            $consulta = "INSERT INTO mailbox (email, name, comment) VALUES (?, ?, ?)";
            $declaracion = $this->conexion->prepare($consulta);
            $declaracion->bindParam(1, $email);
            $declaracion->bindParam(2, $name);
            $declaracion->bindParam(3, $comment);

            $declaracion->execute();
            return true;
        } catch (PDOException $e) {
            die("Error en la consulta: " . $e->getMessage());
        }
    }
}

// Incluir la clase de conexión a la base de datos
require_once('connection/dbconnection.php');

// Crear una instancia de la clase Database
$database = new Database();

// Obtener la conexión a la base de datos
$db = $database->getConnection();

// Crear una instancia de la clase ConexionBD y pasarle la conexión
$conexionBD = new ConexionBD($db);

// Procesar el formulario si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $name = $_POST["name"];
    $comment = $_POST["comment"];
    

    // Insertar el nuevo usuario en la base de datos
    $registroExitoso = $conexionBD->insertarComentario($email, $name, $comment);

    if ($registroExitoso) {
        // Registro exitoso, redirigir a la página de inicio de sesión
        header("Location: index.php");
        exit();
    } else {
        // Error en el registro, mostrar mensaje
        $mensajeError = "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error al enviar el comentario',
            text: 'Por favor, intentelo de nuevo.',
        });
        </script>";
    }
}
?>
<!--Fin del codigo-->
<body>
     <!--Footer de inicio-->
     <footer class="bg-dark text-light py-2">
        <div class="container">
            <div class="row">
                <div class="col-md-6 d-flex flex-column flex-md-row align-items-center">
                    <p class="mb-0 me-md-3"><i class="bi bi-telephone-fill text-danger"></i> Teléfono: +844 171 6912</p>
                    <p class="mb-0"><i class="bi bi-envelope-fill"></i> Email: TechStore@hotmail.com</p>
                </div>
                <div class="col-md-6 d-flex justify-content-end mt-2 mt-md-0">
                    <a href="registration.php" class="text-light me-3">Registrarse <i class="bi bi-check2-circle"></i></a>
                    <a href="login.php" class="text-light"> Iniciar sesión <i class="bi bi-person-circle"></i></a>
                </div>
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
    <input class="form-control me-2" type="text" placeholder="Buscar artículo" name="search">
    <button class="btn btn-primary" type="submit">Buscar</button>
    &nbsp;
    <button class="btn btn-primary" type="submit">All</button>
</form>

          </div>
        </div>
      </nav>
       <!--End Navbar-->

       <!--Carousel de imagenes-->
       <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/computadoras.png" class="d-block w-100" alt="Computadoras" width="400" height="400">
              
            </div>            
            <div class="carousel-item">
                <img src="img/laptops.jpg" class="d-block w-100" alt="Laptops"  width="400" height="400">
              
            </div>
            <div class="carousel-item">
                <img src="img/celulares.jpg" class="d-block w-100" alt="Celulares"  width="400" height="400">
               
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
       <!--Fin de carousel-->

          <!--Footer de de articulos-->
     <footer class="bg-dark text-light py-2">
        <div class="container">
            <div class="row">
                
                    <h3 class="mb-0 text-center">Articulos destacados ⭐⭐⭐</h3>
                         
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

            // Definimos la consulta SQL base para obtener todos los artículos
            $sql = "SELECT * FROM articulos";

            // Verificamos si se ha enviado el formulario de búsqueda y hay un término de búsqueda
            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search'])) {
                $search = $_GET['search'];
                // Añadimos la condición de búsqueda a la consulta SQL base
                $sql .= " WHERE name LIKE :search OR description LIKE :search OR category LIKE :search";
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
                echo 'No se encontraron artículos que coincidan con la búsqueda.';
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

       <!--End cards-->
       <br>
       <!-- Card de ubicación -->
       <center>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Ubicación</h5>
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3604.3486255079797!2d-101.01882508820314!3d25.39313837749183!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x868872fce4107015%3A0x7b7cc325375fbb31!2sC%2F%20Cordova%2C%20Buenos%20Aires%2C%2025076%20Saltillo%2C%20Coah.!5e0!3m2!1ses-419!2smx!4v1716877241938!5m2!1ses-419!2smx" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </center>
       <br>
       <!--Formulario de quejas o sugerencias-->

       <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mb-4">Buzón de Quejas o Sugerencias</h2>
                <form method="post" name="formBuzon" id="formBuzon">
                    <div class="mb-3">
                        <label for="inputEmail" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="inputEmail" name="email" aria-describedby="emailHelp" placeholder="Ingrese su correo electrónico">
                        <div id="emailHelp" class="form-text">No compartiremos su correo con terceros.</div>
                    </div>
                    <div class="mb-3">
                        <label for="inputName" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="inputName" name="name" placeholder="Ingrese su nombre">
                    </div>
                    <div class="mb-3">
                        <label for="inputFeedback" class="form-label">Queja o Sugerencia</label>
                        <textarea class="form-control" id="inputFeedback" name="comment" rows="3" placeholder="Escriba aquí su queja o sugerencia"></textarea>
                    </div>
                    <div class="d-grid gap-2">
                    <button type="submit" name="sendBuzon" id="sendBuzon" class="btn btn-outline-primary">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--Scrip de validación del formulario del buzón-->
    <script>
        document.getElementById("formBuzon").addEventListener("submit", function(event){
            event.preventDefault(); // Prevenir el envío del formulario
            
            let email = document.getElementById("inputEmail").value;
            let name = document.getElementById("inputName").value;
            let comment = document.getElementById("inputFeedback").value;
            
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const noNumberRegex = /^[^0-9]*$/;

            if(!email || !name || !comment) {
                Swal.fire({
                    icon: 'error',
                    title: 'Campos incompletos',
                    text: 'Por favor, completa todos los campos antes de enviar el formulario.',
                });
            } else if (!emailRegex.test(email)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Correo electrónico no válido',
                    text: 'Por favor, ingresa un correo electrónico válido.',
                });
            } else if (!noNumberRegex.test(name)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Nombre no válido',
                    text: 'El nombre no debe contener números.',
                });
            } else if (!noNumberRegex.test(comment)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Queja o Sugerencia no válida',
                    text: 'La queja o sugerencia no debe contener números.',
                });
            } else {
                Swal.fire({
                    icon: 'success',
                    title: 'Formulario enviado',
                    text: 'Gracias por tu feedback.',
                    timer: 2000, // tiempo en milisegundos (2 segundos)
                    showConfirmButton: false // no mostrar botón de confirmación
                }).then(() => {
                    document.getElementById("formBuzon").submit(); // Enviar el formulario después del tiempo especificado
                });
            }
        });
    </script>
    <!--Fin del Script-->
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