<?php
// Page racine sans session.
// Nettoie l'ancien cookie de session (Path=/) pour éviter qu'il soit envoyé aux ressources statiques,
// puis redirige vers l'application (cookie session limité à /app).

@setcookie(session_name(), '', time() - 3600, '/');

header('Location: /app/index.php', true, 302);
exit;
