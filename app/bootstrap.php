<?php
declare(strict_types=1);

// Encodage côté header
header('Content-Type: text/html; charset=UTF-8');

// Cookie de session limité à /app/
session_set_cookie_params([
  'path' => '/app/',
  'httponly' => true,
  'samesite' => 'Lax',
  'secure' => (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'),
]);

session_start();

// Optionnel: timezone pour éviter warnings
date_default_timezone_set('Europe/Paris');
