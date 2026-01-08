<?php
session_start();
require("../metier/DB_connector.php");

// Vérification de sécurité : seul un admin connecté peut modifier
if (!isset($_SESSION['id'])) {
    header("Location: ../connexion.php");
    exit();
}

if (isset($_POST["areaModifAccueil"])) {
    try {
        $cnx = new DB_Connector();
        $jeton = $cnx->openConnexion();

        // Requête préparée pour éviter les injections SQL
        $req = "UPDATE home SET descr = ? WHERE id = 1";
        $stmt = $jeton->prepare($req);
        
        if ($stmt->execute([$_POST["areaModifAccueil"]])) {
            $_SESSION['msgModifOk'] = "Description mise à jour avec succès.";
        } else {
            $_SESSION['msgModifNok'] = "Erreur lors de la mise à jour.";
        }

        $cnx->closeConnexion();
    } catch (Exception $e) {
        $_SESSION['msgModifNok'] = "Erreur système lors de la modification.";
    }
}

header('Location: ../index.php'); 
exit();
?>