<?php
session_start();
require("../metier/DB_connector.php");
require("../metier/Produit.php");
require("../Dao/ProduitDao.php");


// Connexion à la BDD 
$cnx = new DB_Connector();
$jeton = $cnx->openConnexion();

// Création du manager permettant la manipulation de l'objet produit en BDD
$produitManager = new ProduitDao($jeton);

// Récupération de tout les produits
$produits = $produitManager->getList();
 
$select = "  <div class='col-40'>           
					<label for='lbProduitModif'>Libellé produit</label>
				</div>	
				<div class='col-40' id='selectNomProduit'>
				 ";

$select .= " <select id='lbProduitModif' name='lbProduitModif'>";
for ($i = 0; $i < count($produits); $i++) {
    $select .= "<option value='".$produits[$i]->getId()."'>".$produits[$i]->getTitre()."</option>";	
}

$select .= "</select>
			</div>";

echo $select;

?>
