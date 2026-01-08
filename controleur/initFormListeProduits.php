<?php
session_start();

require __DIR__ . "/../metier/DB_connector.php";
require __DIR__ . "/../metier/Produit.php";
require __DIR__ . "/../Dao/ProduitDao.php";

$cnx = new DB_connector();
$jeton = $cnx->openConnexion();

$produitManager = new ProduitDao($jeton);
$produits = $produitManager->getList();

// Petite fonction utilitaire anti-XSS
function e(string $s): string {
  return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

foreach ($produits as $p) {
  $titre = e($p->getTitre());
  $descr = e($p->getDescr());

  // Nom de fichier image: on évite les chemins chelous
  $img = basename((string)$p->getImg());

  echo "<article class='produit'>";
  echo "  <h2 class='titre'>{$titre}</h2>";
  echo "  <p class='texte'>{$descr}</p>";
  echo "  <img class='image' src='images/{$img}' alt='' loading='lazy' decoding='async'>";
  echo "</article>";
}
