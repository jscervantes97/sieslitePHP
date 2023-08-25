<?php
namespace Models ; 
class Venta
{
    private $idVenta ; 

    private $status ; 

    private $totalArticulos ; 

    private $totalVenta ; 

    private $fechaVenta ; 

    private $idUsuario ; 

	private $metodoPago ; 

    private $articulos ; 

	private $idCorte ; 
    
    public function __construct() {

    }
    
	/**
	 * @return mixed
	 */
	public function getIdVenta() {
		return $this->idVenta;
	}
	
	/**
	 * @param mixed $idVenta 
	 * @return self
	 */
	public function setIdVenta($idVenta): self {
		$this->idVenta = $idVenta;
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

	/**
	 * @return mixed
	 */
	public function getTotalArticulos() {
		return $this->totalArticulos;
	}
	
	/**
	 * @param mixed $totalArticulos 
	 * @return self
	 */
	public function setTotalArticulos($totalArticulos): self {
		$this->totalArticulos = $totalArticulos;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getTotalVenta() {
		return $this->totalVenta;
	}
	
	/**
	 * @param mixed $totalVenta 
	 * @return self
	 */
	public function setTotalVenta($totalVenta): self {
		$this->totalVenta = $totalVenta;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getFechaVenta() {
		return $this->fechaVenta;
	}
	
	/**
	 * @param mixed $fechaVenta 
	 * @return self
	 */
	public function setFechaVenta($fechaVenta): self {
		$this->fechaVenta = $fechaVenta;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getIdUsuario() {
		return $this->idUsuario;
	}
	
	/**
	 * @param mixed $idUsuario 
	 * @return self
	 */
	public function setIdUsuario($idUsuario): self {
		$this->idUsuario = $idUsuario;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getArticulos() {
		return $this->articulos;
	}
	
	/**
	 * @param mixed $articulos 
	 * @return self
	 */
	public function setArticulos($articulos): self {
		$this->articulos = $articulos;
		return $this;
	}

    public function toJson(){
		return 
		[
            'idVenta' => $this->getIdVenta(),
            'status' => $this->getStatus(),
            'totalArticulos' => $this->getTotalArticulos(),
            'totalVenta' => $this->getTotalVenta(),
            'fechaVenta' => $this->getFechaVenta(),
			'idUsuario' => $this->getIdUsuario(),
            'articulos' => $this->getArticulos(),
			'metodoPago' => $this->getMetodoPago(),
			'idCorte' => $this->getIdCorte()
		];
	}


	/**
	 * @return mixed
	 */
	public function getMetodoPago() {
		return $this->metodoPago;
	}
	
	/**
	 * @param mixed $metodoPago 
	 * @return self
	 */
	public function setMetodoPago($metodoPago): self {
		$this->metodoPago = $metodoPago;
		return $this;
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
}
?>