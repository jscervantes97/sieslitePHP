<?php 
namespace Repository ;
use Repository\GenericRepository ; 
//use Models\Articulo;


class ArticuloRepository extends GenericRepository{

    public function __construct(){
        parent::__construct('idArticulo', 'articulos'); 
    }

    public function searchByQuery($query){
        
        $search = $this->findByQuery($query);
        
        return $search ; 
    }
}
?>