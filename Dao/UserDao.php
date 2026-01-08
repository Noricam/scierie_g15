<?php
/**
 * Gestionnaire de la classe user
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
	 * Recherche d'un utilisateur en ce basant sur le couple ident/mdp
	 */
    public function userExist($userId, $userPwd) {

		$req = "SELECT userId FROM user WHERE userId = '$userId' and userPwd = '$userPwd'";
		$stmt = $this->_db->query($req);

		if ($donnees = $stmt->fetch()) {  
		    return true;
		}else{
			return false;
		}
    }
	
	/**
	 * Recherche de l'existance d'un id
	 */
    public function idExist($userId) {
		$req = "SELECT userId FROM user WHERE userId = '$userId'";
		$stmt = $this->_db->query($req);

		if ($donnees = $stmt->fetch()) {  
		    return true;
		}else{
			return false;
		}   
    }
    
	
   /** 
    * Récupération de tous les users de la BDD
    */
    public function getList() {
       
        $rqt = $this->_db->prepare('SELECT *
		                           FROM user');
        $rqt->execute();
	
        while ($donnees = $rqt->fetch()) {
            $users[$compteur] = new user($donnees);
		    $compteur ++;
        }
        return $users;
    }
	
     
	/**
	 * Ajout d'un nouvel utilisateur à la BDD
	 */
   public function add($user) {
  
		$rqt = $this->_db->prepare('INSERT INTO user(userId, userPwd)
									VALUES(?,?)');
		$rqt->bindValue(1, $user->getUserId());
		$rqt->bindValue(2, $user->getUserPwd());

    	$rqt->execute();
	}
  
    /**
	 * Modifieur sur l'instance pdo de connexion 
	 */
     public function setDb(PDO $db) {
        $this->_db = $db;
    }
	
}
