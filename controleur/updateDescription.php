<?php
session_start();
require("../metier/DB_connector.php");

// Vérification de la session pour s'assurer que l'utilisateur est autorisé
if (!isset($_SESSION['id'])) {
    header("Location: ../connexion.php");
    exit();
}

// Vérification de la présence de la donnée à mettre à jour
if (isset($_POST["areaModifAccueil"])) {
    
    try {
        // Utilisation du connecteur existant du projet 
        $cnx = new DB_Connector();
        $jeton = $cnx->openConnexion();

        // Requête préparée pour sécuriser l'entrée utilisateur 
        // Note : Dans scierie.sql, la table est 'home' et la colonne est 'descr'
        $req = "UPDATE home SET descr = ? WHERE id = 1";
        
        $stmt = $jeton->prepare($req);
        
        // Exécution sécurisée : la donnée de $_POST n'est jamais concaténée directement
        if ($stmt->execute([$_POST["areaModifAccueil"]])) {
            $_SESSION['msgModifOk'] = "Description mise à jour avec succès.";
        } else {
            $_SESSION['msgModifNok'] = "Erreur lors de la mise à jour.";
        }

        $cnx->closeConnexion();
        
    } catch (Exception $e) {
        // En production, il vaut mieux logger l'erreur plutôt que de l'afficher
        $_SESSION['msgModifNok'] = "Erreur système lors de la modification.";
    }
}

// Redirection vers la page d'accueil ou d'administration
header('Location: ../index.php'); 
exit();
?>