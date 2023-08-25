<?php 
namespace Repository ;
use Repository\GenericRepository ; 
//use Models\Articulo;
use Models\VentaArticulos;

class VentaArticulosRepository extends GenericRepository{

    public function __construct(){
        parent::__construct('id', 'venta_tiene_articulos'); 
    }

    public function searchByQuery($query){
        
        $search = $this->findByQuery($query);
        
        return $search ; 
    }

    public function findByVentaId($id){
        $dataArray = array(); 
        $search = $this->findByQuery("SELECT id, idArticulo, idVenta, cantidad, precioUnitario, total, status FROM venta_tiene_articulos where idVenta = $id;");
        foreach($search as $reg){
            $artVenta = new VentaArticulos();
            $artVenta->setId($reg[0]);
            $artVenta->setIdArticulo($reg[1]); 
            $artVenta->setIdVenta($reg[2]);
            $artVenta->setCantidad($reg[3]);
            $artVenta->setPrecioUnitario($reg[4]);
            $artVenta->setTotal($reg[5]);
            $artVenta->setStatus($reg[6]);
            array_push($dataArray,$artVenta->toJson());
        }
        return $dataArray  ; 
    }


    public function create($params){
        return $this->save("INSERT INTO venta_tiene_articulos (idArticulo, idVenta, cantidad, precioUnitario, total, status) VALUES($params->idArticulo, $params->idVenta, $params->cantidad, $params->precioUnitario, $params->total, 1);"); 
    }

    public function update($params){
        return $this->executeQuery("UPDATE venta_tiene_articulos SET idArticulo=$params->idArticulo, idVenta=$params->idVenta, cantidad=$params->cantidad, precioUnitario=$params->precioUnitario, total=$params->total, status=$params->status WHERE id=$params->id;"); 
    }

    public function remove($params){
        return $this->executeQuery("DELETE * FROM venta_tiene_articulos where id = $params->id ; "); 
    }

    public function updateIntentory($params){
        return $this->executeQuery("UPDATE articulos set existencia = existencia - $params->cantidad where idArticulo = $params->idArticulo ; ");
    }


}
?>