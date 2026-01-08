<?php
/**
 * Gestionnaire de la classe Contenu
 */
class ContenuDao {
	
	/** Instance de PDO pour se connecter à la BD */
	private $_db;
	
	/**
	 * Connexion à la BDD
	 */
	public function __construct($db) {
        $this->setDb($db);
    }
     
	/**
	 * Récupération d'un contenu en précisant son titre 
	 * @return $contenu le contenu choisie
	 */
    public function get($titre) {
        $rqt= $this->_db->prepare("SELECT id, titre, descr, img
		                           FROM home
								   WHERE titre= ?");	
		$rqt->bindParam(1, $titre);	
		$rqt->execute();

		if ($donnees = $rqt->fetch()) {  
		    return new Produit($donnees);
		}	
    }
	
	/**
	 * Récupération d'un contenu en précisant son id
	 */
    public function getById($id) {
        $rqt= $this->_db->prepare("SELECT id, titre, descr, img
		                           FROM home
								   WHERE id= ?");	
		$rqt->bindParam(1, $id);	
		$rqt->execute();

		if ($donnees = $rqt->fetch()) {  
		    return new Produit($donnees);
		}	
    }
    
	
   /** 
    * Récupération de tous les contenus de la bdd
    */
    public function getList() {
        $contenus = [];
	    $compteur = 0;
        $rqt = $this->_db->prepare('SELECT id, titre, descr, img
		                           FROM home
								   ORDER BY titre');
        $rqt->execute();

        while ($donnees = $rqt->fetch()) {
            $contenus[$compteur] = new Produit($donnees);
		    $compteur ++;
        }
        return $contenus;
    }
	
	
 
   /**
	* Ajout d'un nouveau contenu
	* @param $contenu le contenu à ajouter
	*/
    public function add($contenu) {
        $rqt = $this->_db->prepare('INSERT INTO home(titre, descr, img)
							         VALUES(?,?,?)');

		$rqt->bindValue(1, $contenu->getTitre());
		$rqt->bindValue(2, $contenu->getDescr());
		$rqt->bindValue(3, $contenu->getImg());
		return $rqt->execute();
    }

    /**
	 * Suppression d'un contenu 
	 * @param $contenu le contenu à supprimer
	 */
    public function delete($contenu) {
           $rqt = $this->_db->prepare('DELETE FROM home WHERE titre = ?'); 
		   $rqt->bindValue(1, $contenu->getTitre());
		   
		   return $rqt->execute(); 
    }
	
	/**
	 * Mise à jour des informations concernant un contenu
	 */
	public function update($contenu) {
        $rqt = $this->_db->prepare('UPDATE home 
	                          SET titre = ?, descr = ?, img = ?
                    	      WHERE id = ?');

		$rqt->bindValue(1, $contenu->getTitre());
		$rqt->bindValue(2, $contenu->getDescr());
		$rqt->bindValue(3, $contenu->getImg());
		$rqt->bindValue(4, $contenu->getId());


		return $rqt->execute();
    }
  
     public function setDb(PDO $db) {
        $this->_db = $db;
    }
	
}
