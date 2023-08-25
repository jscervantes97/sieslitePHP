<?php 
namespace Repository ;
use Repository\GenericRepository ; 
use Models\Venta;


class VentaRepository extends GenericRepository{


    public function __construct(){
        parent::__construct('idVenta', 'ventas'); 
    }

    public function searchByQuery($query){
        
        $search = $this->findByQuery($query);
        
        return $search ; 
    }

    public function findByVentaId($id){
        $searchVenta = null;  
        $search = $this->findByQuery("SELECT idVenta, status, totalArticulos, totalVenta, fechaVenta, (select * from usuarios where idUsuario = idUsuario) as 'usuario', metodoPago, idCorte FROM ventas where idVenta = $id;");
        if(count($search) > 0){
            $searchVenta = new Venta() ; 
            $searchVenta->setIdVenta($search[0][0]);
            $searchVenta->setStatus($search[0][1]);
            $searchVenta->setTotalArticulos($search[0][2]);
            $searchVenta->setTotalVenta($search[0][3]);
            $searchVenta->setFechaVenta($search[0][4]);
            $searchVenta->setIdUsuario($search[0][5]);
            $searchVenta->setMetodoPago($search[0][6]);
            $searchVenta->setIdCorte($search[0][7]);
            $searchVenta->setArticulos([]);
        }
        return $searchVenta  ; 
    }

    public function findVentaEnProceso(){
        $searchVenta = null;  
        $search = $this->findByQuery("SELECT idVenta, status, totalArticulos, totalVenta, fechaVenta, idUsuario, metodoPago, idCorte FROM ventas where status = 2  order by idVenta desc limit 1 ;");
        if(count($search) > 0){
            $searchVenta = new Venta() ; 
            $searchVenta->setIdVenta($search[0][0]);
            $searchVenta->setStatus($search[0][1]);
            $searchVenta->setTotalArticulos($search[0][2]);
            $searchVenta->setTotalVenta($search[0][3]);
            $searchVenta->setFechaVenta($search[0][4]);
            $searchVenta->setIdUsuario($search[0][5]);
            $searchVenta->setMetodoPago($search[0][6]);
            $searchVenta->setIdCorte($search[0][7]);
            $searchVenta->setArticulos([]);
        }
        return $searchVenta  ; 
    }


    public function create($params){
        return $this->save("INSERT INTO ventas (status, totalArticulos, totalVenta, fechaVenta, idUsuario,idCorte) VALUES($params->status, $params->totalArticulos , $params->totalVenta , now(), $params->idUsuario, $params->idCorte);"); 
    }

    public function update($params){
        return $this->executeQuery("UPDATE ventas SET status=$params->status, totalArticulos=$params->totalArticulos, totalVenta=$params->totalVenta, idUsuario=$params->idUsuario, metodoPago=$params->tipoPago WHERE idVenta=$params->idVenta;"); 
    }

    public function remove($params){
        return $this->executeQuery("UPDATE ventas SET status=0 WHERE idVenta=$params->idVenta;"); 
    }
}
?>