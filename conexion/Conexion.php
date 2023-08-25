<?php
namespace conexion ; 
define("HOST","localhost");
define("USER","root");
define("PASS","");
define("DBNAME","sieslitedb");

class Conexion extends \mysqli {
    public function __construct() {
        parent::__construct(HOST, USER, PASS,DBNAME);
        $conexion = new \mysqli(HOST, USER, PASS,DBNAME);

        if (mysqli_connect_error()) {
            die('Error de Conexión (' . mysqli_connect_errno() . ') '
                . mysqli_connect_error());
        }
    }

    public function consulta(){

    }

}