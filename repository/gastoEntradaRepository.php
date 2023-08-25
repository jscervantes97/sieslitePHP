<?php 
namespace Repository ;
use Repository\GenericRepository ; 
use Models\GastoEntrada;


class GastoEntradaRepository extends GenericRepository{

    public function searchByQuery($query){
        
        $search = $this->findByQuery($query);
        $dataArray = array() ; 
        foreach($search as $row){
            $gastoEntrada = new GastoEntrada() ; 
            $gastoEntrada->setIdGastoEntrada($row[0]); 
            $gastoEntrada->setTipo($row[1]);
            $gastoEntrada->setTitulo($row[2]);
            $gastoEntrada->setDescripcion($row[3]);
            $gastoEntrada->setFechaCreacion($row[4]);
            $gastoEntrada->setStatus($row[5]); 
            $gastoEntrada->setIdUsuario($row[6]);
            array_push($dataArray , $gastoEntrada->toJson());
        }
        
        return $dataArray ; 
    }

    
    public function create($params){
        return $this->save("INSERT INTO gasto_entrada(tipo, titulo, descripcion, fechaCreacion, status, idUsuarioCreo) VALUES($params->tipo,'$params->titulo', '$params->descripcion', now(), $params->status, $params->idUsuarioCreo);"); 
    }

    public function update($params){
        return $this->executeQuery("UPDATE gasto_entrada SET tipo=$params->tipo, titulo='$params->titulo', descripcion='$params->descripcion', fechaCreacion='$params->fechaCreacion', status=$params->status, idUsuarioCreo=$params->idUsuarioCreo WHERE idGastoEntrada=$params->idGastoEntrada;"); 
    }

    public function remove($params){
        return $this->executeQuery("UPDATE gasto_entrada SET status=0 WHERE idGastoEntrada=$params->idVenta;"); 
    }


}

?>