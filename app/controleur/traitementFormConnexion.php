<?php
require __DIR__ . '/../bootstrap.php';

require __DIR__ . '/../metier/DB_connector.php';
require __DIR__ . '/../metier/User.php';
require __DIR__ . '/../Dao/UserDao.php';

// Initialisation des variables de tentative si elles n'existent pas
if (!isset($_SESSION['tentatives'])) {
    $_SESSION['tentatives'] = 0;
}

// Vérification du blocage (ex: blocage de 30 secondes)
if (isset($_SESSION['expire_blocage']) && time() < (int)$_SESSION['expire_blocage']) {
    $attente = (int)$_SESSION['expire_blocage'] - time();
    $_SESSION['errCnx'] = "Trop d'échecs. Veuillez patienter {$attente} secondes.";
    header('Location: /app/connexion.php', true, 303);
    exit;
}

// On exige POST (et pas GET)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /app/connexion.php', true, 303);
    exit;
}

// Récupération des champs
$userId = trim($_POST['idUtil'] ?? '');
$mdp    = (string)($_POST['mdpUtil'] ?? '');

if ($userId === '' || $mdp === '') {
    $_SESSION['errCnx'] = "Identifiant ou mot de passe manquant.";
    header('Location: /app/connexion.php', true, 303);
    exit;
}

$cnx = null;

try {
    $cnx = new DB_Connector();
    $jeton = $cnx->openConnexion();
    $userManager = new UserDao($jeton);

    // Note: On utilise MD5 car c'est le format actuel de notre BDD
    $jetonExistance = $userManager->userExist($userId, md5($mdp));

    if ($jetonExistance) {
        // Succès : on réinitialise le compteur
        $_SESSION['id'] = $userId;
        $_SESSION['tentatives'] = 0;
        unset($_SESSION['expire_blocage']);
        $_SESSION['errCnx'] = "";

        if ($cnx) $cnx->closeConnexion();
        header('Location: /app/index.php', true, 303);
        exit;

    } else {
        // Échec : on incrémente le compteur
        $_SESSION['tentatives']++;

        if ($_SESSION['tentatives'] >= 3) {
            // Blocage de 30 secondes après 3 échecs
            $_SESSION['expire_blocage'] = time() + 30;
            $_SESSION['errCnx'] = "Compte bloqué pour 30 secondes (3 échecs).";
        } else {
            $restant = 3 - (int)$_SESSION['tentatives'];
            $_SESSION['errCnx'] = "Identifiants incorrects. Tentatives restantes : {$restant}";
        }

        if ($cnx) $cnx->closeConnexion();
        header('Location: /app/connexion.php', true, 303);
        exit;
    }

} catch (Throwable $e) {
    // Ne pas exposer l'erreur
    $_SESSION['errCnx'] = "Erreur serveur. Réessaie plus tard.";
    if ($cnx) $cnx->closeConnexion();
    header('Location: /app/connexion.php', true, 303);
    exit;
}
