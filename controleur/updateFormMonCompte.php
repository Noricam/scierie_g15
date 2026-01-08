<?php
session_start();
require("../metier/DB_connector.php");
require("../metier/User.php");
require("../Dao/UserDao.php");

// Tester l'existance des données passées par le formulaire et de la variable de session_cache_expire
// pour tester
if (isset($_SESSION['id'])) {

	// Récupération des valeur du formaulaire et formatage des chaines
	$id = $_SESSION['id'];
	$pwd = trim($_POST["inputPwd"]);
	$nom = trim($_POST["inputNom"]);
	$prenom = trim($_POST["inputPrenom"]);
	$tel = trim($_POST["inputTel"]);
	$cp = trim($_POST["inputCP"]);
	$adresse = trim($_POST["inputAdresse"]);
	$ville = trim($_POST["inputVille"]);

	// Connexion à la base de données
	$cnx = new DB_connector();
	$jeton = $cnx->openConnexion();
		
	// Création du manager
	$userManager = new UserDao($jeton);
		
	// Création du user avec les nouvelles infos
	$updateUser = new User([
			'userId' => $id,
			'userPwd' => $pwd,
			'userDroits' => "user",
			'userNom' => $nom,
			'userPrenom' => $prenom,
			'userAdresse' => $adresse,
			'userCp' => $cp,
			'userVille' => $ville,
			'userContact' => $tel
		]);

	// Mise à jour du user 
	if ($userManager->update($updateUser)) {
		header("Location:../monCompte.php");	
	} else {
		echo "Erreur lors de la mise à jour du profil";	
	}
}	
?>