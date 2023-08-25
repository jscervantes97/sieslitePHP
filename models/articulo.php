<?php
namespace Models ; 

class Articulo {

    private $idArticulo ; 

    private $codigo ; 

    private $nombre ; 

    private $precio ; 

    private $existencia ; 

    private $status ; 

    public function __construct() {

    }

	
	public function getIdArticulo() {
		return $this->idArticulo;
	}
	
	
	public function setIdArticulo($idArticulo): self {
		$this->idArticulo = $idArticulo;
		return $this;
	}

	
	public function getCodigo() {
		return $this->codigo;
	}
	
	
	public function setCodigo($codigo): self {
		$this->codigo = $codigo;
		return $this;
	}

	
	public function getNombre() {
		return $this->nombre;
	}
	
	
	public function setNombre($nombre): self {
		$this->nombre = $nombre;
		return $this;
	}

	
	public function getPrecio() {
		return $this->precio;
	}
	
	
	public function setPrecio($precio): self {
		$this->precio = $precio;
		return $this;
	}

	
	public function getExistencia() {
		return $this->existencia;
	}
	
	
	public function setExistencia($existencia): self {
		$this->existencia = $existencia;
		return $this;
	}

	
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
            'idArticulo' => $this->getIdArticulo(),
            'codigo' => $this->getCodigo(),
			'nombre' => $this->getNombre(),
			'precio' => $this->getPrecio(),
			'existencia' => $this->getExistencia(),
			'status' => $this->getStatus()
        ];
    }
}

?>