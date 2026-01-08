<?php
session_start();
require("../metier/DB_connector.php");
require("../metier/Produit.php");
require("../Dao/ProduitDao.php");

// Ouverture de la connexion BDD
$cnx = new DB_connector();
$jeton = $cnx->openConnexion();

// Création du manager permettant les actions en BDD
$produitManager = new ProduitDao($jeton);

$produits = $produitManager->getList();

for ($i = 0; $i < count($produits); $i++) {
    
    // Construction de la structure HTML
    $produit = "<ul class='main-list'>";
    
    // Protection XSS sur le titre
    $produit .= "<li class='main-item'><p class='titre'>" . htmlspecialchars($produits[$i]->getTitre(), ENT_QUOTES, 'UTF-8') . "</p></li>";
    
    $produit .= "<li class ='main-item'><ul class ='sub-list'>";
    
    // Protection XSS sur la description
    $produit .= "<li class='sub-item'><p class='texte'>" . htmlspecialchars($produits[$i]->getDescr(), ENT_QUOTES, 'UTF-8') . "</p></li>";
    
    // Protection XSS sur le nom de l'image
    $produit .= "<li class='sub-item'><img class='image' alt='description' src='/images/" . htmlspecialchars($produits[$i]->getImg(), ENT_QUOTES, 'UTF-8') . "'></li>";        
    
    $produit .= "</ul></li></ul>";
    
    echo $produit;
}
?>
