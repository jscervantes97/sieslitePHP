<?php
namespace Models ; 
class Usuario
{
    private $idUsuario ; 

    private $nombreUsuario ; 

    private $contra ; 

    private $status ; 
    

    private $rol ; 
    
    public function __construct() {

    }


	/**
	 * @return mixed
	 */
	public function getRol() {
		return $this->rol;
	}
	
	/**
	 * @param mixed $rol 
	 * @return self
	 */
	public function setRol($rol): self {
		$this->rol = $rol;
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
	public function getContra() {
		return $this->contra;
	}
	
	/**
	 * @param mixed $contra 
	 * @return self
	 */
	public function setContra($contra): self {
		$this->contra = $contra;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getNombreUsuario() {
		return $this->nombreUsuario;
	}
	
	/**
	 * @param mixed $nombreUsuario 
	 * @return self
	 */
	public function setNombreUsuario($nombreUsuario): self {
		$this->nombreUsuario = $nombreUsuario;
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
			'idUsuario' => $this->getIdUsuario(),
			'nombreUsuario' => $this->getNombreUsuario(),
			'contra' => $this->getContra(),
			'rol' => $this->getRol(),
			'status' => $this->getStatus()
		];
	}
}
 
?>