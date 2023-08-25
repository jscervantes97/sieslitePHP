<?php
session_start();

require_once 'conexion/Conexion.php';
require_once 'repository/genericRepository.php';
require_once 'repository/usuarioRepository.php';
require_once 'services/loginService.php';
require_once 'models/resultDTO.php';
require_once 'models/usuario.php';



use Services\LoginService ;
$loginService = new LoginService();
$msgInicioSesion = "" ;
if(isset($_POST['cajaUsuario']) && isset($_POST['cajaContra'])){
    $resultado = $loginService->logIn($_POST['cajaUsuario'], $_POST['cajaContra']);
    if($resultado->getData() != null){
        //$msgInicioSesion = $resultado->getMsg();
        $_SESSION['logeado'] = "si"  ;
        $_SESSION['usuario']  = $resultado->getData()->getNombreUsuario();
        $_SESSION['rol'] = $resultado->getData()->getRol();
        $_SESSION['idUsuario'] = $resultado->getData()->getIdUsuario();
    }
    else {
        $msgInicioSesion = $resultado->getMsg();
    }
} 

if(isset($_SESSION['usuario']) && isset($_SESSION['logeado'])){
    if($_SESSION['logeado'] == "si"){
        header('Location: index.php');
    }
}
?>

<!doctype html>
<html lang="es">
  <?php
    require_once 'components/head.php'
  ?>
    <body>
        <div class="container-fluid">
            <div class="row justify-content-center text-center align-items-center" style="padding-top : 5%;">
                
                <form method="post" action = "login.php" style="width:50%">
                <!-- Email input -->
                <h2>Bienvenido</h2>
                    <div class="form-outline mb-4">
                        <input type="text" id="cajaUsuario" name="cajaUsuario"  class="form-control" />
                        <label class="form-label" for="form2Example1">Usuario</label>
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <input type="password" id="cajaContra" name="cajaContra" class="form-control" />
                        <label class="form-label" for="form2Example2">Contraseña</label>
                    </div>

                    <!-- 2 column grid layout for inline styling -->
                    <div class="row mb-4">
                        <div class="col">
                        <!-- Simple link -->
                        <a href="#!">Has olvidado la contraseña?</a>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                        <!-- Simple link -->
                        <?php echo $msgInicioSesion ?>
                        </div>
                    </div>

                    <!-- Submit button -->
                    <input type="submit" class="btn btn-primary btn-block mb-4" value="Iniciar sesion"></input>

                </form>                   
                
            </div>
        </div>
        <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
    </body>
</html>
