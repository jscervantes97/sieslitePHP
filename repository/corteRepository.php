<?php 
namespace Repository ;
use Repository\GenericRepository ; 
use Models\Cortes;


class CorteRepository extends GenericRepository{


    public function __construct(){
        parent::__construct('idCorte', 'cortes'); 
    }

    public function searchByQuery($query){
        $search = $this->findByQuery($query);
        return $search ; 
    }

    public function findCorteEnCurso(){
        $corte = null ; 
        $search = $this->findByQuery("SELECT idCorte, fechaInicio, fechaFin, idPrimerVenta, idUltimaVenta, totalVentas, totalVendido, status FROM cortes WHERE status = 0 order by idCorte desc limit 1;");
        if(count($search) > 0){
            $corte = new Cortes(); 
            $corte->setIdCorte($search[0][0]);
            $corte->setFechaInicio($search[0][1]);
            $corte->setFechaFin($search[0][2]);
            $corte->setIdPrimerVenta($search[0][3]);
            $corte->setIdUltimaVenta($search[0][4]);
            $corte->setTotalVentas($search[0][5]);
            $corte->setTotalVendido($search[0][6]);
            $corte->setStatus($search[0][7]);
        }
        return $corte ; 
    }


    public function create(){
        return $this->save("INSERT INTO cortes(fechaInicio, fechaFin, idPrimerVenta, idUltimaVenta, totalVentas, totalVendido, status) VALUES(now(),null, NULL, NULL, 0, 0, 0);"); 
    }

    public function update($params){
        return $this->executeQuery("UPDATE cortes SET idUltimaVenta=getUltimaVentaPorCorte($params->idCorte), totalVentas=(totalVentas+1), totalVendido=(totalVendido + $params->totalVenta) WHERE idCorte=$params->idCorte;"); 
    }


    public function remove($params){
        return $this->executeQuery("UPDATE cortes SET status=2 WHERE idVenta=$params->idVenta;"); 
    }
}