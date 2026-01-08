<?php

/**
 * Classe gérant la création des users
 */
class User {

   /** Id de l'utilisant permettant de l'identifier ce sera une adresse mail*/	
   private $_userId;
   /** Mot de passe de l'utilisateur */	
   private $_userPwd;
   /** Role du user admin ou utilisateur*/	
   private $_userDroits;
   /** nom du user */	
   private $_userNom;
   /** Prenom du user */	
   private $_userPrenom;
   /** Adresse du user */	
   private $_userAdresse;
   /** Ville du user */	
   private $_userVille;
   /** Code postal du user */	
   private $_userCp;
   /** Telephone du user */	
   private $_userContact;
 
 

	public function __construct($tab) {
	   if (!empty($tab)) {
		  $this->hydrate($tab);
	    }	
	}
	
	/**
	 * Hydration de l'objet en lui fournissant les données correspondant 
	 * à ses attributs
	 * @param $tab tableau recensant les données à utiliser pour l'hydratation 
     */	 
	private function hydrate($tab) {
		
		foreach ($tab as $key => $value) {

        $method = 'set'.ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
       }
	}
	

	public function getUserId() {
	    return $this->_userId;
	}

	public function setUserId($userId) {
	     $this->_userId = $userId;
	}
	
	public function getUserPwd() {
	    return $this->_userPwd;
	}

	public function setUserPwd($userPwd) {
	     $this->_userPwd = MD5($userPwd);
	}
}   
?>