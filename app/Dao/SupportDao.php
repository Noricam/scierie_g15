<?php
/**
 * Gestionnaire de la classe Support
 */
class SupportDao {
	
	/** Instance de PDO pour se connecter à la BD */
	private $_db;
	
	/**
	 * Connexion à la BDD
	 */
	public function __construct($db) {
        $this->setDb($db);
    }
     
	/**
	 * Récupération d'un message en fonction de son id

	 */
    public function get($suId) {
		$tab = array(); 
        $rqt= $this->_db->prepare("SELECT suId, suNom, suEmail, suSub, suMsg
		                           FROM Support
								   WHERE suId= ?");	
		$rqt->bindParam(1, $suId);	
		$rqt->execute();

		if ($donnees = $rqt->fetch()) {  
		    return new Support($donnees);
		}	
    }
    
	
   /** 
    * Récupération de tous les messages de la bdd
    */
    public function getList() {
        $supports = [];
	    $compteur = 0;
        $rqt = $this->_db->prepare('SELECT suId, suNom, suEmail, suSub, suMsg
		                            FROM Support');
        $rqt->execute();

        while ($donnees = $rqt->fetch()) {
            $supports[$compteur] = new Support($donnees);
		    $compteur ++;
        }
        return $supports;
    }
	
	
     
   /**
	* Ajout d'un nouveau message
	*/
    public function add($support) {
        $rqt = $this->_db->prepare('INSERT INTO Support(suNom, suEmail, suSub, suMsg)
							         VALUES(?,?,?,?)');

		$rqt->bindValue(1, $support->getSuNom());
		$rqt->bindValue(2, $support->getSuEmail());
		$rqt->bindValue(3, $support->getSuSub());
		$rqt->bindValue(4, $support->getSuMsg());

		return $rqt->execute();
    }

    /**
	 * Suppression d'un message
	 */
    public function delete($support) {
           $rqt = $this->_db->prepare('DELETE FROM Support WHERE suId = ?'); 
		   $rqt->bindValue(1, $support->getSuId());
		   
		   return $rqt->execute(); 
    }
	
	/**
	 * Mise à jour d'un message 
	 */
	public function update($support) {
        $rqt = $this->_db->prepare('UPDATE Support 
	                          SET suNom = ?, suEmail = ?,suSub = ?, suMsg = ?
                    	      WHERE suId = ?');

		$rqt->bindValue(1, $support->getSuNom());
		$rqt->bindValue(2, $support->getSuEmail());
		$rqt->bindValue(3, $support->getSuSub());
		$rqt->bindValue(4, $support->getSuMsg());
		$rqt->bindValue(5, $support->getSuId());

		return $rqt->execute();
    }
  
    /**
	 * Modifieur sur l'instance pdo de connexion 
	 */
     public function setDb(PDO $db) {
        $this->_db = $db;
    }
	
}
