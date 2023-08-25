<?php
require_once '../conexion/Conexion.php';
require_once '../repository/genericRepository.php';
require_once '../models/resultDTO.php';
require_once '../models/cortes.php';
require_once '../repository/corteRepository.php';
require_once '../services/corteService.php';

header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Content-Type: text/html; charset=utf-8');
header('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"');


use Services\CorteService ; 
$corteService = new CorteService();
$opcion = $_GET['opc'] ;
switch ($opcion){
    case 1 :
        $json = file_get_contents('php://input');
        //$data = json_decode($json);
        $corte = $corteService->crearCorteNuevo(); 
        http_response_code(200);
        echo json_encode($corte->toJson()) ;
        break  ;
    case 2 :
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        $corte = $corteService->getCorteEnCurso(); 
        http_response_code(200);
        echo json_encode($corte->toJson()) ;
        break  ;
    case 3 :
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        $result = $corteService->terminarCorte();
        http_response_code(200);
        echo json_encode($result->toJson()) ; 
        break  ;

}
?>