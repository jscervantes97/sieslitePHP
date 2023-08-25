<?php 
namespace Services ; 


use Exception;
use Repository\VentaRepository ;
use Repository\VentaArticulosRepository; 
use Models\ResultDTO ;
use Models\Venta ; 

class VentaService{

    private $ventaRepository ; 
    private $ventaArticulosRepository ; 

    public function __construct(){
        $this->ventaRepository = new VentaRepository();
        $this->ventaArticulosRepository = new VentaArticulosRepository();
    }

    public function createVentaNueva($params){
        $resultDTO = new ResultDTO("" , null);
        try{
            $idVentaNueva = 0 ;
            $ventaEnProceso = $this->ventaRepository->findVentaEnProceso();
            if($ventaEnProceso != null){
                $resultDTO->setMsg("Continuando con venta en proceso");
                $idVentaNueva = $ventaEnProceso->getIdVenta();
            }else{
                $resultDTO->setMsg("Venta Generada¡¡");
                $idVentaNueva = $this->ventaRepository->create($params); 
            }
            $resultDTO->setData($idVentaNueva);
        }catch(Exception $err){
            $resultDTO->setMsg("Ocurrio un error al generar una venta nueva ".$err->getMessage());
        }
        return $resultDTO ; 
    }

    public function findVentaById($params){
        $resultDTO = new ResultDTO("" , null);
        try{
            $venta = $this->ventaRepository->findByVentaId($params->idVenta);
            $articulos = $this->ventaArticulosRepository->findByVentaId($params->idVenta);
            $venta->setArticulos($articulos);
            $resultDTO->setMsg("Venta encontrada ¡");
            $resultDTO->setData($venta->toJson());
        }catch(Exception $err){
            $resultDTO->setMsg("Ocurrio el siguiente error " . $err->getMessage());
        }   
        return $resultDTO ; 
    }

    public function registrarVenta($params){
        $resultDTO = new ResultDTO("" , null);
        try{
            $articulosVenta = $params->articulos ; 
            foreach($articulosVenta as $articulo){
                $this->ventaArticulosRepository->create($articulo);
                $this->ventaArticulosRepository->updateIntentory($articulo);
            }
            $idVentaNueva = $this->ventaRepository->update($params); 
            $this->ventaArticulosRepository->executeQuery("UPDATE cortes SET idPrimerVenta = IF(idPrimerVenta is null, $params->idVenta , idPrimerVenta), idUltimaVenta=$params->idVenta, totalVentas=(totalVentas+1), totalVendido=(totalVendido + $params->totalVenta) WHERE idCorte=$params->idCorte;");
            $resultDTO->setMsg("Venta Terminada¡¡ articulos registrados " . count($articulosVenta) );
            $resultDTO->setData($idVentaNueva);
        }catch(Exception $err){
            $resultDTO->setMsg("Ocurrio un error al generar una venta nueva ".$err->getMessage());
        }
        return $resultDTO ; 
    }

    public function generateDataReport($params){
        $resultDTO = new ResultDTO("" , null);
        try{
            $opciones = $params->opciones ;
            $opcSize = count($opciones);
            $dataArray = array();

            $query = "SELECT v.idVenta, case when v.status = 0 then 'Cancelada' when v.status = 1 then 'Terminada' when v.status = 2 then 'Pendiente' end as 'statusVenta', v.totalArticulos, v.totalVenta, v.fechaVenta, u.nombreUsuario , if(metodoPago = 0 , 'Efectivo','Targeta de Credito/Debito') as metodoPago, v.idCorte FROM ventas v inner join usuarios u on v.idUsuario  = u.idUsuario where " ; 
            $contadorIfs = 0 ; 
            if(in_array(1,$opciones)){
                $query .= " v.idCorte = $params->idCorte " ; 
                $contadorIfs++ ; 
            }
            if(in_array(2,$opciones)){
                if($contadorIfs > 0){
                    $query .= " and " ; 
                }
                $query .= " v.metodoPago = $params->tipoPago " ; 
                $contadorIfs++ ;
            }
            if(in_array(3,$opciones)){
                if($contadorIfs > 0){
                    $query .= " and " ; 
                }
                $query .= " date(fechaVenta)  between '$params->fechaInicio' and '$params->fechaFin' " ; 
            }
            $query .= " ; " ; 
            $searchResult = $this->ventaRepository->findByQuery($query);
            foreach($searchResult as $reg){
                $searchVenta = new Venta() ; 
                $searchVenta->setIdVenta($reg[0]);
                $searchVenta->setStatus($reg[1]);
                $searchVenta->setTotalArticulos($reg[2]);
                $searchVenta->setTotalVenta($reg[3]);
                $searchVenta->setFechaVenta($reg[4]);
                $searchVenta->setIdUsuario($reg[5]);
                $searchVenta->setMetodoPago($reg[6]);
                $searchVenta->setIdCorte($reg[7]);
                $searchVenta->setArticulos(null);
                array_push($dataArray , $searchVenta->toJson());
            }
            $resultDTO->setMsg("Reporte Generado");
            $resultDTO->setData($dataArray);
        }catch(Exception $err){
            $resultDTO->setMsg("Ocurrio un error al generar el reporte de ventas ".$err->getMessage());
        }
        return $resultDTO ;   
    }
}
