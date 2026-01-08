<?php
session_start();
require("../metier/DB_connector.php");
require("../metier/Produit.php");
require("../Dao/ProduitDao.php");

// ouverture de la connexion BDD
$cnx = new DB_connector();
$jeton = $cnx->openConnexion();


// Création du manager permettant les actions en BDD
$produitManager = new ProduitDao($jeton);

$produits = $produitManager->getList();



for ($i = 0; $i < count($produits); $i++) {
	
	$produit = "<ul class='main-list'>";
	$produit .= "<li class='main-item'><p class='titre'>".$produits[$i]->getTitre()."</p></li>";
	$produit .= "<li class ='main-item'><ul class ='sub-list'>";
	$produit .= "<li class='sub-item'><p class='texte'>".$produits[$i]->getDescr()."</p></li>";
	$produit .= "<li class='sub-item'><img class='image' src='images/".$produits[$i]->getImg()."'></li>";		
	$produit .= "</ul></li></ul>";
	echo $produit;
}



?>