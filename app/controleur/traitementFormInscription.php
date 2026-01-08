<?php
session_start();
require("../metier/DB_connector.php");
require("../metier/User.php");
require("../Dao/UserDao.php");

if (isset($_GET['idUtilCreation']) || isset($_GET['pwdCreation']) || isset($_GET['pwdBis'])) {

    $cnx = new DB_Connector();
    $jeton = $cnx->openConnexion();

    $userManager = new UserDao($jeton);

	$id = trim($_GET['idUtilCreation']);
	$pwd = trim($_GET['pwdCreation']);
	$pwdBis = trim($_GET['pwdBis']);
    
	if (($userManager->idExist($id))) {
		 $_SESSION['errId'] = "Cette identifiant est déjà utilisé";	
		 $cnx->closeConnexion();
		 header('Location:../connexion.php');
	} else {
		if ($pwd != $pwdBis) {
			$_SESSION['errMdp'] = "Mot de passe non identique";	
			$cnx->closeConnexion();
			header('Location:../connexion.php');
			
		} else {
			$newUser = new User([
				'userId' => $id,
				'userPwd' => $pwd
			]);
		
			if ($userManager->add($newUser)) {
				 $_SESSION['creationOk'] = "Nouvel utilisateur créé";
				 $cnx->closeConnexion();
				 header('Location:../connexion.php');
			} else {
				$_SESSION['creationNok'] = "Utilisateur non créé";
				$cnx->closeConnexion();
				header('Location:../connexion.php');
			}
		}
	
	}
}
?>