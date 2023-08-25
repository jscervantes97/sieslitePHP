<?php 

namespace Models ; 
class Cortes
{

    private $idCorte ; 

    private $fechaInicio ; 

    private $fechaFin ; 

    private $idPrimerVenta ; 

    private $idUltimaVenta ; 

    private $totalVentas ;

    private $totalVendido ; 

    private $status ; 

    public function __construct() {

    }

	/**
	 * @return mixed
	 */
	public function getIdCorte() {
		return $this->idCorte;
	}
	
	/**
	 * @param mixed $idCorte 
	 * @return self
	 */
	public function setIdCorte($idCorte): self {
		$this->idCorte = $idCorte;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getFechaInicio() {
		return $this->fechaInicio;
	}
	
	/**
	 * @param mixed $fechaInicio 
	 * @return self
	 */
	public function setFechaInicio($fechaInicio): self {
		$this->fechaInicio = $fechaInicio;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getFechaFin() {
		return $this->fechaFin;
	}
	
	/**
	 * @param mixed $fechaFin 
	 * @return self
	 */
	public function setFechaFin($fechaFin): self {
		$this->fechaFin = $fechaFin;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getIdPrimerVenta() {
		return $this->idPrimerVenta;
	}
	
	/**
	 * @param mixed $idPrimerVenta 
	 * @return self
	 */
	public function setIdPrimerVenta($idPrimerVenta): self {
		$this->idPrimerVenta = $idPrimerVenta;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getIdUltimaVenta() {
		return $this->idUltimaVenta;
	}
	
	/**
	 * @param mixed $idUltimaVenta 
	 * @return self
	 */
	public function setIdUltimaVenta($idUltimaVenta): self {
		$this->idUltimaVenta = $idUltimaVenta;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getTotalVentas() {
		return $this->totalVentas;
	}
	
	/**
	 * @param mixed $totalVentas 
	 * @return self
	 */
	public function setTotalVentas($totalVentas): self {
		$this->totalVentas = $totalVentas;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getTotalVendido() {
		return $this->totalVendido;
	}
	
	/**
	 * @param mixed $totalVendido 
	 * @return self
	 */
	public function setTotalVendido($totalVendido): self {
		$this->totalVendido = $totalVendido;
		return $this;
	}

    /**
	 * @return mixed
	 */
	public function getStatus() {
		return $this->status;
	}
	
	/**
	 * @param mixed $status 
	 * @return self
	 */
	public function setStatus($status): self {
		$this->status = $status;
		return $this;
	}

    public function toJson(){
		return 
		[
            'idCorte' => $this->getIdCorte(),
            'fechaInicio' => $this->getFechaInicio(),
            'fechaFin' => $this->getFechaFin(),
            'idPrimerVenta' => $this->getIdPrimerVenta(),
            'idUltimaVenta' => $this->getIdUltimaVenta(),
			'totalVentas' => $this->getTotalVentas(),
            'totalVendido' => $this->getTotalVendido(),
            'status' => $this->getStatus()
		];
	}


}

?>