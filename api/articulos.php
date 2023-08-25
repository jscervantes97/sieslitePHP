<?php
require_once '../conexion/Conexion.php';
require_once '../repository/genericRepository.php';
require_once '../models/resultDTO.php';
require_once '../models/articulo.php';
require_once '../repository/articuloRepository.php';
require_once '../services/articulosService.php';

header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Content-Type: text/html; charset=utf-8');
header('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"');


use Services\ArticulosService ; 
$articuloService = new ArticulosService();
$opcion = $_GET['opc'] ;
switch ($opcion){
    case 1 :
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        if($data->nombre== null){
            $articulos = $articuloService->searchByCodigo($data);  
        }
        else{
            $articulos = $articuloService->searchByParams($data);  
        }
        http_response_code(200);
        echo json_encode($articulos->toJson()) ;
        break  ;
    case 2 :
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        $result = $articuloService->save($data);
        http_response_code(200);
        echo json_encode($result->toJson()) ; 
        break  ;
    case 3 :
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        $result = $articuloService->update($data);
        http_response_code(200);
        echo json_encode($result->toJson()) ; 
        break  ;
    case 4 :
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        $result = $articuloService->remove($data);
        http_response_code(200);
        echo json_encode($result->toJson()) ; 
        break  ;

}
?>