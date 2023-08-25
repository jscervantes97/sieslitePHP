<?php
namespace Models;  
class ResultDTO {

    private $msg ; 

    private $data  ; 

    public function __construct($msg , $data){
        $this->msg = $msg ; 
        $this->data = $data; 

    }

    

	/**
	 * @return mixed
	 */
	public function getMsg() {
		return $this->msg;
	}
	
	/**
	 * @param mixed $msg 
	 * @return self
	 */
	public function setMsg($msg): self {
		$this->msg = $msg;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getData() {
		return $this->data;
	}
	
	/**
	 * @param mixed $data 
	 * @return self
	 */
	public function setData($data): self {
		$this->data = $data;
		return $this;
	}

    public function toJson(){
        return 
        [
            'msg' => $this->getMsg(),
            'data' => $this->getData()
        ];
    }
} 

?>