
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
</head>
<!--Codigo para registrar los usuarios-->
<?php
class ConexionBD {
    private $conexion;

    public function __construct($db) {
        $this->conexion = $db;
    }

    public function insertarUsuario($email, $name, $lastname, $phone, $password) {
        try {
            // Hashear la contraseña usando bcrypt
            $password_hash = password_hash($password, PASSWORD_BCRYPT);

            $consulta = "INSERT INTO userstechstore (email, name, lastname, phone, password) VALUES (?, ?, ?, ? , ?)";
            $declaracion = $this->conexion->prepare($consulta);
            $declaracion->bindParam(1, $email);
            $declaracion->bindParam(2, $name);
            $declaracion->bindParam(3, $lastname);
            $declaracion->bindParam(4, $phone);
            $declaracion->bindParam(5, $password_hash);

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
    $lastname = $_POST["lastname"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];
    

    // Insertar el nuevo usuario en la base de datos
    $registroExitoso = $conexionBD->insertarUsuario($email, $name, $lastname, $phone,$password);

    if ($registroExitoso) {
        // Registro exitoso, redirigir a la página de inicio de sesión
        header("Location: login.php");
        exit();
    } else {
        // Error en el registro, mostrar mensaje
        $mensajeError = "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error al enviar el formulario',
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
                <a class="nav-link" href="index.php">Volver</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="javascript:void(0)"></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="javascript:void(0)"></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="javascript:void(0)"></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="javascript:void(0)"></a>
              </li>
            </ul>
            <form class="d-flex">
              <input class="form-control me-2" type="text" placeholder="Buscar articulo">
              <button class="btn btn-primary" type="button">Buscar</button>
            </form>
          </div>
        </div>
      </nav>
       <!--End Navbar-->

          <!--Footer de de articulos-->
     <footer class="bg-dark text-light py-2">
        <div class="container">
            <div class="row">
                
                    <h3 class="mb-0 text-center">Crear una cuenta <i class="bi bi-person-fill-add text-primary"></i></h3>
                         
            </div>
        </div>
    </footer>
     <!--End Footer-->
      
<br>
       <!--Formulario de quejas o sugerencias-->

       <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <hr>
                <form method="post" name="formRegistration" id="formRegistration">
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
                        <label for="inputlastName" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="inputlastName" name="lastname" placeholder="Ingrese su apellido">
                    </div>
                    <div class="mb-3">
                        <label for="inputPhone" class="form-label">Teléfono</label>
                        <input type="number" class="form-control" id="inputPhone" name="phone" placeholder="Ingrese su teléfono">
                    </div>
                    <div class="mb-3">
                        <label for="inputPassword" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Ingrese su contraseña">
                    </div>
                    <div class="mb-3">
                        <label for="inputconfirmPassword" class="form-label">Confirmar contraseña</label>
                        <input type="password" class="form-control" id="inputconfirmPassword" placeholder="Ingrese su contraseña nuevamente">
                    </div>
                   
                    <div class="d-grid gap-2">
                    <button type="submit" name="sendRegister" id="sendRegister" class="btn btn-outline-primary">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById("formRegistration").addEventListener("submit", function(event){
            event.preventDefault(); // Prevenir el envío del formulario
            
            let email = document.getElementById("inputEmail").value;
            let name = document.getElementById("inputName").value;
            let lastname = document.getElementById("inputlastName").value;
            let phone = document.getElementById("inputPhone").value;
            let password = document.getElementById("inputPassword").value;
            let confirmPassword = document.getElementById("inputconfirmPassword").value;
            
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const noNumberRegex = /^[^0-9]*$/;

            if (!email || !name || !lastname || !phone || !password || !confirmPassword) {
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
            } else if (!noNumberRegex.test(lastname)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Apellido no válido',
                    text: 'El apellido no debe contener números.',
                });
            } else if (password !== confirmPassword) {
                Swal.fire({
                    icon: 'error',
                    title: 'Contraseñas no coinciden',
                    text: 'Las contraseñas ingresadas no coinciden.',
                });
            } else {
                Swal.fire({
                    icon: 'success',
                    title: 'Cuenta registrada correctamente.',
                    text: 'Gracias por crear su cuenta.',
                    timer: 2000, // tiempo en milisegundos (2 segundos)
                    showConfirmButton: false // no mostrar botón de confirmación
                }).then(() => {
                    document.getElementById("formRegistration").submit(); // Enviar el formulario después del tiempo especificado
                });
            }
        });
    </script>
    <!--Fin del Script-->
       <!--End formulario de quejas o sugerencias-->
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