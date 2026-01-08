<?php
session_start();
require("../metier/DB_connector.php");
require("../metier/Produit.php");
require("../Dao/ContenuDao.php");


$id = trim($_POST['lbContenuModif']);
echo "update";

// Connexion à la BDD 
$cnx = new DB_Connector();
$jeton = $cnx->openConnexion();

$contenuManager = new contenuDao($jeton);

$contenuSelect = $contenuManager->getById($id);
$titre = $contenuSelect->getTitre();
$descr = $_POST['lbDescrModif'];
$img = $_POST['lbImgModif'];

$updateContenu = new Produit([
		'id' => $id,
		'titre' => $titre,
		'descr' => $descr,
		'img' => $img
]);

if ($contenuManager->update($updateContenu)) {
    $_SESSION['msgModif2Ok'] = "Contenu modifié avec succès";
	$cnx->closeConnexion();
	header("Location:../administration.php");
} else {
	$_SESSION['msgModif2Nok'] = "Contenu non modifié";
	$cnx->closeConnexion();
	header("Location:../administration.php");
}

?>
