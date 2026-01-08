<?php
/**
 * Gestionnaire de la classe Produit
 */
class ProduitDao {
	
	/** Instance de PDO pour se connecter à la BD */
	private $_db;
	
	/**
	 * Connexion à la BDD
	 */
	public function __construct($db) {
        $this->setDb($db);
    }
     
	/**
	 * Récupération d'un produit en précisant son titre 
	 * @return $produit le produit choisie
	 */
    public function get($titre) {
        $rqt= $this->_db->prepare("SELECT id, titre, descr, img
		                           FROM produits
								   WHERE titre= ?");	
		$rqt->bindParam(1, $titre);	
		$rqt->execute();

		if ($donnees = $rqt->fetch()) {  
		    return new Produit($donnees);
		}	
    }
	
	/**
	 * Récupération d'un produit en précisant son id
	 */
    public function getById($id) {
        $rqt= $this->_db->prepare("SELECT id, titre, descr, img
		                           FROM produits
								   WHERE id= ?");	
		$rqt->bindParam(1, $id);	
		$rqt->execute();

		if ($donnees = $rqt->fetch()) {  
		    return new Produit($donnees);
		}	
    }
    
	
   /** 
    * Récupération de tous les produits de la bdd
    */
    public function getList() {
        $produits = [];
	    $compteur = 0;
        $rqt = $this->_db->prepare('SELECT id, titre, descr, img
		                           FROM produits
								   ORDER BY titre');
        $rqt->execute();

        while ($donnees = $rqt->fetch()) {
            $produits[$compteur] = new Produit($donnees);
		    $compteur ++;
        }
        return $produits;
    }
	
	
 
   /**
	* Ajout d'un nouveau produit
	* @param $produit le produit à ajouter
	*/
    public function add($produit) {
        $rqt = $this->_db->prepare('INSERT INTO produits(titre, descr, img)
							         VALUES(?,?,?)');

		$rqt->bindValue(1, $produit->getTitre());
		$rqt->bindValue(2, $produit->getDescr());
		$rqt->bindValue(3, $produit->getImg());
		return $rqt->execute();
    }

    /**
	 * Suppression d'un produit 
	 * @param $produit le produit à supprimer
	 */
    public function delete($produit) {
           $rqt = $this->_db->prepare('DELETE FROM produits WHERE titre = ?'); 
		   $rqt->bindValue(1, $produit->getTitre());
		   
		   return $rqt->execute(); 
    }
	
	/**
	 * Mise à jour des informations concernant un produit
	 */
	public function update($produit) {
        $rqt = $this->_db->prepare('UPDATE produits 
	                          SET titre = ?, descr = ?, img = ?
                    	      WHERE id = ?');

		$rqt->bindValue(1, $produit->getTitre());
		$rqt->bindValue(2, $produit->getDescr());
		$rqt->bindValue(3, $produit->getImg());
		$rqt->bindValue(4, $produit->getId());


		return $rqt->execute();
    }
  
     public function setDb(PDO $db) {
        $this->_db = $db;
    }
	
}
