<?php
session_start();
require("../metier/DB_connector.php");
require("../metier/Produit.php");
require("../Dao/ContenuDao.php");


// Connexion à la BDD 
$cnx = new DB_Connector();
$jeton = $cnx->openConnexion();

// Création du manager permettant la manipulation de l'objet Contenu en BDD
$contenuManager = new ContenuDao($jeton);

// Récupération de tout les contenus
$contenus = $contenuManager->getList();
 
$select = "  <div class='col-40'>           
					<label for='lbContenuModif'>Libellé Contenu</label>
				</div>	
				<div class='col-40' id='selectNomContenu'>
				 ";

$select .= " <select id='lbContenuModif' name='lbContenuModif'>";
for ($i = 0; $i < count($contenus); $i++) {
    $select .= "<option value='".$contenus[$i]->getId()."'>".$contenus[$i]->getTitre()."</option>";	
}

$select .= "</select>
			</div>";

echo $select;

?>
