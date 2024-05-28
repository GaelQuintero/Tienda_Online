<!-- reset_password.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Restablecer Contraseña</title>
</head><!DOCTYPE html>
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
    <link rel="stylesheet" href="css/registration.css">
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
            
          </div>
        </div>
       
      </nav>
       <!--End Navbar-->

          <!--Footer de de articulos-->
     <footer class="bg-dark text-light py-2">
        <div class="container">
            <div class="row">
                
                    <h3 class="mb-0 text-center">Restablecer contraseña </h3>
                         
            </div>
        </div>
    </footer>
     <!--End Footer-->
     </body>
</html>

    <?php
    if (isset($_GET['email']) && isset($_GET['token'])) {
        $email = $_GET['email'];
        $token = $_GET['token'];
    ?>
            <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <hr>
    <form action="process_reset_password.php" method="POST">
        <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
        <div class="mb-3">
            <label for="password">Nueva Contraseña:</label>
            <input type="password" name="password" id="password"  class="form-control">
        </div>
        <div class="mb-3">
            <label for="confirm_password">Confirmar Nueva Contraseña:</label>
            <input type="password" name="confirm_password" id="confirm_password"  class="form-control">
        </div>
        <div class="d-grid gap-2">
            <button type="submit">Restablecer contraseña </button>
        </div>
        </div>
        </div>
    </div>
    <script>
        document.getElementById("formRegistration").addEventListener("submit", function(event){
            event.preventDefault(); // Prevenir el envío del formulario
           
            let password = document.getElementById("password").value;
            let confirmPassword = document.getElementById("confirm_password").value;
            
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const noNumberRegex = /^[^0-9]*$/;

            if (!password || !confirmPassword) {
                Swal.fire({
                    icon: 'error',
                    title: 'Campos incompletos',
                    text: 'Por favor, completa todos los campos antes de enviar el formulario.',
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
                    title: 'Contraseña cambiada exitosamente.',
                    text: 'Contraseña cambiada exitosamente',
                    timer: 2000, // tiempo en milisegundos (2 segundos)
                    showConfirmButton: false // no mostrar botón de confirmación
                }).then(() => {
                    document.getElementById("formRegistration").submit(); // Enviar el formulario después del tiempo especificado
                });
            }
        });
    </script>
    </form>
    <?php
    } else {
        echo "Parámetros inválidos.";
    }
    ?>

