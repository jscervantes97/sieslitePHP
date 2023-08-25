<?php 
namespace Services ; 


use Exception;
use Repository\UsuarioRepository ; 
use Models\ResultDTO ;
use Models\Usuario ; 

class UsuarioService{
    private $usuarioRepository ; 

    public function __construct(){
        $this->usuarioRepository = new UsuarioRepository();
    }

    public function saveUser($params){
        $result = new ResultDTO("" , null);
        try{
            $idInserted = $this->usuarioRepository->create($params); 
            $result->setMsg("Usuario Creado¡");
            $result->setData($idInserted);
        }catch(Exception $err){
            $result->setMsg("Ocurrio un error al crear al usuario " . $err->getMessage());
        }
        return $result ; 
    }

    public function updateUser($params){
        $result = new ResultDTO("" , null);
        try{
            $idInserted = $this->usuarioRepository->update($params); 
            $result->setMsg("Usuario Modificado con exito¡");
            $result->setData($idInserted);
        }catch(Exception $err){
            $result->setMsg("Ocurrio un error al modificar al usuario al usuario " . $err->getMessage());
        }
        return $result ; 
    }

    public function removeUser($params){
        $result = new ResultDTO("" , null);
        try{
            $idInserted = $this->usuarioRepository->remove($params); 
            $result->setMsg("Usuario dado de baja con exito¡");
            $result->setData($idInserted);
        }catch(Exception $err){
            $result->setMsg("Ocurrio un error al dar de baja al usuario al usuario " . $err->getMessage());
        }
        return $result ; 
    }

    public function searchByParams($params){
        
        $dataArray = array();
        $query = "Select * from usuarios where status = 1 "; 
        if($params->nombreUsuario != ""){
            $query .= "and nombreUsuario like '$params->nombreUsuario%' " ; 
        }
        if($params->limite > 0){
            $query .= " limit $params->limite ;" ; 
        }
        $data = $this->usuarioRepository->findByQuery($query);
        
        foreach($data as $reg){
           
            $usuario = new Usuario();
            $usuario->setIdusuario($reg[0]);
            $usuario->setNombreUsuario($reg[1]);
            $usuario->setContra(base64_decode($reg[2]));
            $usuario->setStatus($reg[3]);
            $usuario->setRol($reg[4]);
            array_push($dataArray , $usuario->toJson());
        }
        return new ResultDTO("Data fetched" , $dataArray);
    }

    public function searchById($params){
        $resultDTO = new ResultDTO("El usuario a buscar no existe con ese id ", null);
        try{
            $usuario = $this->usuarioRepository->findByUserId($params->idUsuario); 
            if($usuario != null){
                $resultDTO->setMsg("Usuario encontrado ¡") ;
                $resultDTO->setData($usuario->toJson()); 
            }
        }catch(Exception $err){
            $resultDTO->setMsg("Ocurrio un error al buscar por id ".$err->getMessage());
        }
        return $resultDTO; 
    }
}

?>