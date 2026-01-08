<?php
/**
 * Gestionnaire de la classe user (version MySQLi vulnérable)
 */
class userDao {
    
    /** Instance MySQLi pour se connecter à la BD */
    private $_db;
    
    /**
     * Connexion à la BDD
     */
    public function __construct($host, $user, $pass, $dbname) {
        $this->_db = new mysqli($host, $user, $pass, $dbname);
        if ($this->_db->connect_error) {
            die("Erreur de connexion MySQLi : " . $this->_db->connect_error);
        }
    }
     
    /**
     * Récupération d'un user par son id (adresse mail) — vulnérable
     */
    public function get($userId) {
        $sql = "SELECT *
                FROM user
                WHERE userId = '$userId'";
        $result = $this->_db->query($sql);
        if ($donnees = $result->fetch_assoc()) {  
            return new user($donnees);
        }
    }

    /**
     * Vérifie si un utilisateur existe (id + mdp) — vulnérable
     */
    public function userExist($userId, $userPwd) {
        $sql = "SELECT userId
                FROM user
                WHERE userId = '$userId'
                AND userPwd = '$userPwd'";
        $result = $this->_db->query($sql);
        return ($result && $result->num_rows > 0);
    }
    
    /**
     * Vérifie si un id existe — vulnérable
     */
    public function idExist($userId) {
        $sql = "SELECT userId
                FROM user
                WHERE userId = '$userId'";
        $result = $this->_db->query($sql);
        return ($result && $result->num_rows > 0);
    }
    
    /** 
     * Récupération de tous les users
     */
    public function getList() {
        $users = [];
        $sql = "SELECT *
                FROM user";
        $result = $this->_db->query($sql);
        while ($donnees = $result->fetch_assoc()) {
            $users[] = new user($donnees);
        }
        return $users;
    }
     
    /**
     * Ajoute un nouvel utilisateur — vulnérable
     */
    public function add($user) {
        $sql = "INSERT INTO user(userId, userPwd)
                VALUES ('".$user->getUserId()."', '".$user->getUserPwd()."')";
        return $this->_db->query($sql);
    }

    /**
     * Supprime un utilisateur — vulnérable
     */
    public function delete($user) {
        $sql = "DELETE FROM user WHERE userId = '".$user->getUserId()."'";
        return $this->_db->query($sql);
    }
    
    /**
     * Met à jour un utilisateur — vulnérable
     */
    public function update($userUpdate) {
        $sql = "UPDATE user 
                SET userPwd = '".$userUpdate->getUserPwd()."'
                WHERE userId = '".$userUpdate->getUserId()."'";
        return $this->_db->query($sql);
    }
}
