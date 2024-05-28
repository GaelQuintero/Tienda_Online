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
<!--API de reCAPTCHA-->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
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
                <div class="col-md-6 d-flex justify-content-end mt-2 mt-md-0">
                <a href="registration.php" class="text-light me-3">Registrarse <i class="bi bi-check2-circle"></i></a>
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
                
                    <h3 class="mb-0 text-center">Iniciar sesión <i class="bi bi-person-circle"></i></h3>
                         
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
                <form method="post" name="formLogin" id="formLogin">
    <div class="mb-3">
        <label for="inputEmail" class="form-label">Correo Electrónico</label>
        <input type="email" class="form-control" id="inputEmail" name="email" aria-describedby="emailHelp" placeholder="Ingrese su correo electrónico" required>
    </div>

    <div class="mb-3">
        <label for="inputPassword" class="form-label">Contraseña</label>
        <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Ingrese su contraseña" required>
    </div>
    <div class="g-recaptcha mb-3" data-sitekey="6LcPgOcpAAAAALd4y20EdFOP2K1giEvOJ3wrcd7Z" required></div>

    <div class="d-grid gap-2">
        <button type="submit" name="loginUser" id="loginUser" class="btn btn-outline-primary">Iniciar sesión</button>
    </div>
    <br>
    <div class="d-flex flex-column align-items-center">
        <a href="forgetpassword.php" class="text-primary text-decoration-none">¿No recuerdas tu contraseña? Haz clic aquí!</a>
    </div> 
</form>
<!--Codigo para iniciar sesión-->
<?php
class Authenticator {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function login($email, $password) {
        // Seleccionar el usuario por su email
        $stmt = $this->conn->prepare('SELECT * FROM userstechstore WHERE email = :email');
        $stmt->execute(array(':email' => $email));
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar si el usuario existe y la contraseña es correcta
        if ($user) {
            $_SESSION['idUser'] = $user['idUser'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['lastname'] = $user['lastname'];
            $_SESSION['phone'] = $user['phone'];
            $_SESSION['dateRegister'] = $user['dateRegister'];
            return true;
        } else {
            return false;
        }
    }
}

if (isset($_POST['loginUser'])) {
    $database = new Database();
    $db = $database->getConnection();
    $authenticator = new Authenticator($db);
    
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($authenticator->login($email, $password)) {
        echo '<script>
        window.location.href = "inicio.php";
    </script>';
        exit();
    } else {
        echo '<script>
        Swal.fire({
            icon: "question",
            position: "center",
            title: "Correo electronico o contraseña incorrecta",
            html: "<font color=grey><strong>Verifique sus datos de acceso</font>",
            position: "top-center",
            showConfirmButton: true,
            allowOutsideClick: false,
            confirmButtonText: "Aceptar"
               }).then(function(result){
                  if(result.value){                   
                  window.location = "login.php";
               }
         });
        </script>';
        exit();
    }
}
?>
<!--Fin del codigo-->


            </div>
        </div>
    </div>


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