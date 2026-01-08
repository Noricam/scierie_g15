<?php

/**
 * Classe gérant la création des produits
 */
class Produit {

   /** Id du produit */	
   private $_id;
   /** Titre du produit */	
   private $_titre;
   /** le descriptif du produit */	
   private $_descr;
   /** L'image du produit */	
   private $_img;


 
 
    /**
	 * Création d'un produit
	 */
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

	public function getId() {
	    return $this->_id;
	}

	public function setId($id) {
	     $this->_id = $id;
	}

	public function getTitre() {
	    return $this->_titre;
	}

	public function setTitre($titre) {
	     $this->_titre = $titre;
	}
	
	public function getDescr() {
	    return $this->_descr;
	}

	public function setDescr($descr) {
	     $this->_descr = $descr;
	}

	public function getImg() {
	    return $this->_img;
	}

	public function setImg($img) {
	     $this->_img = $img;
	}

}   
?>