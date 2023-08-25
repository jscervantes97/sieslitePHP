<?php 
namespace Services ; 


use Exception;
use Repository\CorteRepository ;
use Models\ResultDTO ;
use Models\Cortes ; 

class CorteService{

    private $corteRepository ; 
    public function __construct(){
        $this->corteRepository = new CorteRepository();
    }

    public function crearCorteNuevo(){
        $resultDTO = new ResultDTO("" , null);
        try{
            $idCorte = 0 ; 
            $idCorte = $this->corteRepository->create();
            $resultDTO->setMsg("Corte nuevo creado");
            $resultDTO->setData($idCorte);
        }catch(Exception $err){
            $resultDTO->setMsg("Ocurrio un error al crear un corte : " . $err->getMessage());
        }
        return $resultDTO ;
    }
    public function getCorteEnCurso(){
        $resultDTO = new ResultDTO("" , null);
        try{
            $corteEnCurso = $this->corteRepository->findCorteEnCurso();
            if($corteEnCurso == null){
                $resultDTO->setMsg("No hay ningun corte en curso... favor de crear uno nuevo"); 
            }else{
                $resultDTO->setMsg("Corte en curso ");
                $resultDTO->setData($corteEnCurso->toJson());
            }
        }catch(Exception $err){
            $resultDTO->setMsg("Ocurrio el siguiente error" . $err->getMessage());
        }
        return $resultDTO ;
    }

    public function terminarCorte(){
        $resultDTO = new ResultDTO("" , null);
        try{
            $corteEnCurso = $this->corteRepository->findCorteEnCurso();
            if($corteEnCurso == null){
               $resultDTO->setMsg("No hay ningun corte en curso... favor de crear uno nuevo"); 
            }else{
                $idCorte = $corteEnCurso->getIdCorte();
                $this->corteRepository->executeQuery("UPDATE cortes SET fechaFin=now(),status=1 WHERE idCorte=$idCorte;");
                $resultDTO->setMsg("Terminado.... favor de generar otro");
                $resultDTO->setData($corteEnCurso->toJson());
            }
        }catch(Exception $err){

        } 
        return $resultDTO;
    }
    

}