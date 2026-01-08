<?php

	/* Connexion à la bdd */
	$con = mysqli_connect("localhost", "root", "", "scierie");

	/* Gestion des erreurs de connexion */
	if (mysqli_connect_errno($con)){
		echo "Erreur de connexion: " . mysqli_connect_error();
	}
	// Encodage utf8
	mysqli_set_charset($con,"utf8");
	$req = "UPDATE home SET home.desc='".$_POST["areaModifAccueil"]."' WHERE id=1";

	/* Gestion des erreurs de requête sql */
	if (!mysqli_query($con, $req)){
		echo "Echec de l'update" . mysqli_error($con);
	}
	$requete = $con->query($req);

	
	/* Déconnexion de la bdd */
	mysqli_close($con);
	header('Location: ../index.php'); 

?>