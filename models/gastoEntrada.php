<?php
namespace Models ; 
class GastoEntrada
{
    private $idGastoEntrada ; 

    private $tipo ; 

    private $titulo ; 

    private $descripcion ; 

    private $fechaCreacion ; 

    private $status ; 

    private $idUsuario ; 

    public function __construct() {

    }

	/**
	 * @return mixed
	 */
	public function getIdGastoEntrada() {
		return $this->idGastoEntrada;
	}
	
	/**
	 * @param mixed $idGastoEntrada 
	 * @return self
	 */
	public function setIdGastoEntrada($idGastoEntrada): self {
		$this->idGastoEntrada = $idGastoEntrada;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getTipo() {
		return $this->tipo;
	}
	
	/**
	 * @param mixed $tipo 
	 * @return self
	 */
	public function setTipo($tipo): self {
		$this->tipo = $tipo;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getTitulo() {
		return $this->titulo;
	}
	
	/**
	 * @param mixed $titulo 
	 * @return self
	 */
	public function setTitulo($titulo): self {
		$this->titulo = $titulo;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getFechaCreacion() {
		return $this->fechaCreacion;
	}
	
	/**
	 * @param mixed $fechaCreacion 
	 * @return self
	 */
	public function setFechaCreacion($fechaCreacion): self {
		$this->fechaCreacion = $fechaCreacion;
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

    public function toJson(){
		return 
		[
            'idGastoEntrada' => $this->getIdGastoEntrada(),
            'tipo' => $this->getTipo() , 
            'titulo' => $this->getTitulo() , 
            'descripcion' => $this->getDescripcion() , 
            'fechaCreacion' => $this->getFechaCreacion(),
            'status' => $this->getStatus(),
            'idUsuario' => $this->getIdUsuario()
		];
	}


	/**
	 * @return mixed
	 */
	public function getDescripcion() {
		return $this->descripcion;
	}
	
	/**
	 * @param mixed $descripcion 
	 * @return self
	 */
	public function setDescripcion($descripcion): self {
		$this->descripcion = $descripcion;
		return $this;
	}
}
?>