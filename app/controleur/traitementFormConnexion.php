<?php
session_start();
require("../metier/DB_connector.php");
require("../metier/User.php");
require("../Dao/UserDao.php");

// Initialisation des variables de tentative si elles n'existent pas
if (!isset($_SESSION['tentatives'])) {
    $_SESSION['tentatives'] = 0;
}

// Vérification du blocage (ex: blocage de 30 secondes pour le challenge)
if (isset($_SESSION['expire_blocage']) && time() < $_SESSION['expire_blocage']) {
    $attente = $_SESSION['expire_blocage'] - time();
    $_SESSION['errCnx'] = "Trop d'échecs. Veuillez patienter " . $attente . " secondes.";
    header('Location:../connexion.php');
    exit();
}

if (isset($_GET['idUtil']) && isset($_GET['mdpUtil'])) {

    $cnx = new DB_Connector();
    $jeton = $cnx->openConnexion();
    $userManager = new UserDao($jeton);
    
    $userId = $_GET['idUtil'];
    $mdp = $_GET['mdpUtil'];
	
    // Note: On utilise MD5 car c'est le format actuel de notre BDD 
    $jetonExistance = $userManager->userExist($userId, MD5($mdp));

    if ($jetonExistance) {
        // Succès : on réinitialise le compteur
        $_SESSION['id'] = $userId;
        $_SESSION['tentatives'] = 0;
        unset($_SESSION['expire_blocage']);
         
        $cnx->closeConnexion();
        header('Location:../index.php');
        exit();
    } else {
        // Échec : on incrémente le compteur
        $_SESSION['tentatives']++;

        if ($_SESSION['tentatives'] >= 3) {
            // Blocage de 30 secondes après 3 échecs
            $_SESSION['expire_blocage'] = time() + 30;
            $_SESSION['errCnx'] = "Compte bloqué pour 30 secondes (3 échecs).";
        } else {
            $restant = 3 - $_SESSION['tentatives'];
            $_SESSION['errCnx'] = "Identifiants incorrects. Tentatives restantes : " . $restant; 
        }

        $cnx->closeConnexion();
        header('Location:../connexion.php');
        exit();
    }
}
?>
