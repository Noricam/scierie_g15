<?php
session_start();
require("../metier/DB_connector.php");
require("../metier/Produit.php");
require("../Dao/produitDao.php");


// Connexion à la BDD 
$cnx = new DB_Connector();
$jeton = $cnx->openConnexion();

// Création du manager permettant la manipulation de l'objet produit en BDD
$produitManager = new ProduitDao($jeton);

// Récupération de tout les produits
$produits = $produitManager->getList();
 
$select = "  <div class='col-40'>           
					<label for='lbproduitSupp'>Libellé produit</label>
				</div>	
				<div class='col-40' id='selectNomProduitSupp'>
				 ";

$select .= " <select id='lbProduitSupp' name='lbProduitSupp'>";
for ($i = 0; $i < count($produits); $i++) {
    $select .= "<option value='".$produits[$i]->getId()."'>".$produits[$i]->getTitre()."</option>";	
}

$select .= "</select>
			</div>";

echo $select;

?>
