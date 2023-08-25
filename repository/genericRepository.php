<?php 
namespace Repository ;

use conexion\Conexion ;
class GenericRepository{

    protected $id ; 
  
    protected $table ; 
    protected $db ; 

    public function __construct($id , $table) {
        $this->id = $id ; 
        $this->table = $table ; 

    }

    public function findAll(){
        $query = "select * from ".$this->table." ;" ; 
        $this->db = new Conexion;
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $this->db->close();
        return $result->fetch_all();
    }

    public function findById($id){
        $this->db = new Conexion;
        $query = "select * from $this->table where $this->id = $id ;" ; 
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $this->db->close();
        return $result->fetch_assoc();
    }

    public function findByQuery($query){
        $this->db = new Conexion;
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $this->db->close();
        return $result->fetch_all();
    }

    public function executeQuery($query){
        $this->db = new Conexion();
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->affected_rows;
        $stmt->close();
        $this->db->close();
        return $result;
    }

    public function save($query){
        $this->db = new Conexion();
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->insert_id;
        $stmt->close();
        $this->db->close();
        return $result;
    }

    public function getKeysFromTable($object){
        return array_keys($object) ; 
    }

    public function closeConection(){
        $this->db->close();
    }

}
?>


