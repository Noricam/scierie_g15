<?php

/**
 * Classe gérant les messages du spport
 */
class Support {

   private $_suId;
   private $_suNom;
   private $_suEmail;
   private $_suSub;
   private $_suMsg;


	public function __construct($tab) {
	   if (!empty($tab)) {
		  $this->hydrate($tab);
	    }	
	}
	
	/**
	 * Hydration de l'objet en lui fournissant les données correspondant 
	 * à ses attributs
     */	 
	private function hydrate($tab) {
		
		foreach ($tab as $key => $value) {

        $method = 'set'.ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
       }
	}

	public function getSuId() {
	    return $this->_suId;
	}

	public function setSuId($suId) {
	     $this->_suId = $suId;
	}

	public function getSuNom() {
	    return $this->_suNom;
	}

	public function setSuNom($suNom) {
	     $this->_suNom = $suNom;
	}

	public function getSuEmail() {
	    return $this->_suEmail;
	}

	public function setSuEmail($suEmail) {
	     $this->_suEmail = $suEmail;
	}

	public function getSuSub() {
	    return $this->_suSub;
	}

	public function setSuSub($suMsg) {
	     $this->_suSub = $suMsg;
	}

	public function getSuMsg() {
	    return $this->_suMsg;
	}

	public function setSuMsg($suMsg) {
	     $this->_suMsg = $suMsg;
	}
	
}   
?>