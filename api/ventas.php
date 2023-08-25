<?php
require_once '../conexion/Conexion.php';
require_once '../repository/genericRepository.php';
require_once '../models/resultDTO.php';
require_once '../models/venta.php';
require_once '../models/ventaArticulos.php';
require_once '../repository/ventaArticuloRepository.php';
require_once '../repository/ventaRepository.php';
require_once '../services/ventaService.php';

header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Content-Type: text/html; charset=utf-8');
header('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"');


use Services\VentaService ; 
$ventaService = new VentaService();
$opcion = $_GET['opc'] ;
switch ($opcion){
    case 1 :
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        $venta = $ventaService->findVentaById($data); 
        http_response_code(200);
        echo json_encode($venta->toJson()) ;
        break  ;
    case 2 :
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        $venta = $ventaService->generateDataReport($data); 
        http_response_code(200);
        echo json_encode($venta->toJson()) ;
        
        break  ;
    case 3 :
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        $result = $ventaService->createVentaNueva($data);
        http_response_code(200);
        echo json_encode($result->toJson()) ; 
        break  ;
    case 4 :
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        $result = $ventaService->registrarVenta($data);
        http_response_code(200);
        echo json_encode($result->toJson()) ; 
        break  ;

}
?>