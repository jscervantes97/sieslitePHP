<?php
namespace Models ; 
class VentaArticulos
{
    private $id ; 

    private $idArticulo ; 
    private $idVenta ; 
    private $cantidad ; 
    private $precioUnitario ;
    private $total ; 
    private $status ; 
    public function __construct() {

    }
    
	/**
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 * @param mixed $id 
	 * @return self
	 */
	public function setId($id): self {
		$this->id = $id;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getIdArticulo() {
		return $this->idArticulo;
	}

	/**
	 * @param mixed $idArticulo 
	 * @return self
	 */
	public function setIdArticulo($idArticulo): self {
		$this->idArticulo = $idArticulo;
		return $this;
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
	public function getCantidad() {
		return $this->cantidad;
	}
	
	/**
	 * @param mixed $cantidad 
	 * @return self
	 */
	public function setCantidad($cantidad): self {
		$this->cantidad = $cantidad;
		return $this;
	}

    

	/**
	 * @param mixed $precioUnitario 
	 * @return self
	 */
	public function setPrecioUnitario($precioUnitario): self {
		$this->precioUnitario = $precioUnitario;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getPrecioUnitario() {
		return $this->precioUnitario;
	}

    

	/**
	 * @return mixed
	 */
	public function getTotal() {
		return $this->total;
	}

	/**
	 * @param mixed $total 
	 * @return self
	 */
	public function setTotal($total): self {
		$this->total = $total;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getStatus() {
		return $this->status;
	}

    public function setStatus($status): self {
		$this->status = $status;
		return $this;
	}

	public function toJson(){
		return 
		[
			'id' => $this->getId(),
            'idVenta' => $this->getIdVenta(),
			'cantidad' => $this->getCantidad(),
			'precioUnitario' => $this->getPrecioUnitario(),
			'total' => $this->getTotal(),
            'status' => $this->getStatus()
		];
	}

}
?>