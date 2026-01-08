<?php
/**
 * Gestionnaire de la classe user sécurisé contre les injections SQL
 */
class userDao {
	
	/** Instance de PDO pour se connecter à la BD */
	private $_db;
	
	/**
	 * Connexion à la BDD
	 */
	public function __construct($db) {
        $this->setDb($db);
    }
     
	/**
	 * Recherche d'un utilisateur en se basant sur le couple ident/mdp
     * Utilise des requêtes préparées pour la sécurité 
	 */
    public function userExist($userId, $userPwd) {
        // Préparation de la requête avec des marqueurs "?" 
		$req = "SELECT userId FROM user WHERE userId = ? AND userPwd = ?";
		$stmt = $this->_db->prepare($req);

        // Exécution sécurisée : les variables ne sont jamais concaténées directement 
        $stmt->execute([$userId, $userPwd]);

		if ($donnees = $stmt->fetch()) {  
		    return true;
		} else {
			return false;
		}
    }
	
	/**
	 * Recherche de l'existence d'un identifiant
	 */
    public function idExist($userId) {
		$req = "SELECT userId FROM user WHERE userId = ?";
		$stmt = $this->_db->prepare($req);
        $stmt->execute([$userId]);

		if ($donnees = $stmt->fetch()) {  
		    return true;
		} else {
			return false;
		}   
    }

    /**
     * Récupération d'un utilisateur par son ID
     */
    public function get($userId) {
        $req = "SELECT * FROM user WHERE userId = ?";
        $stmt = $this->_db->prepare($req);
        $stmt->execute([$userId]);

        if ($donnees = $stmt->fetch()) {
            return new User($donnees);
        }
        return null;
    }
    
	/** * Récupération de tous les utilisateurs de la BDD
    */
    public function getList() {
        $users = [];
        $compteur = 0;
        
        $rqt = $this->_db->prepare('SELECT * FROM user');
        $rqt->execute();
	
        while ($donnees = $rqt->fetch()) {
            $users[$compteur] = new User($donnees);
		    $compteur ++;
        }
        return $users;
    }
	
	/**
	 * Ajout d'un nouvel utilisateur à la BDD
	 */
    public function add($user) {
		$rqt = $this->_db->prepare('INSERT INTO user(userId, userPwd) VALUES(?,?)');
		$rqt->bindValue(1, $user->getUserId());
		$rqt->bindValue(2, $user->getUserPwd());

    	return $rqt->execute();
	}

    /**
     * Mise à jour d'un utilisateur (ex: changement de mot de passe)
     */
    public function update($userUpdate) {
        $rqt = $this->_db->prepare('UPDATE user SET userPwd = ? WHERE userId = ?');
        return $rqt->execute([
            $userUpdate->getUserPwd(),
            $userUpdate->getUserId()
        ]);
    }

    /**
     * Suppression d'un utilisateur
     */
    public function delete($user) {
        $rqt = $this->_db->prepare('DELETE FROM user WHERE userId = ?');
        return $rqt->execute([$user->getUserId()]);
    }
  
    /**
	 * Modifieur sur l'instance PDO de connexion 
	 */
    public function setDb(PDO $db) {
        $this->_db = $db;
    }
}
?>