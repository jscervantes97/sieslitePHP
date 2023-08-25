<?php
namespace Services ; 
//require_once '../repository/usuarioRepository.php';
//require_once '../models/resultDTO.php';
//include 'repository/usuarioRepository.php';

use Repository\UsuarioRepository ; 

//include '../models/resultDTO.php';
use Models\ResultDTO ;
class LoginService {

    private $usuarioRepository ; 

    public function __construct(){
        $this->usuarioRepository = new UsuarioRepository(); 
    }

    public function logIn($nombreUsuario, $pass){
        $searchUser = $this->usuarioRepository->findUserByNombreUsuario($nombreUsuario); 
        
        if($searchUser == null){ 
            return new ResultDTO("El usuario a buscar $nombreUsuario  no existe..." , null);
        }else if($pass == base64_decode($searchUser->getContra())) {
            return new ResultDTO("Encontrado" , $searchUser);
        }
        else{
            return new ResultDTO("Contraseña Incorrecta" , null);
        }

    }

} 
/*
//}else if(password_verify($pass , $searchUser->getContra())) {
$test = new LoginService();
echo json_encode($test->logIn("ROOT1" , "14141414")->toJson());
*/

