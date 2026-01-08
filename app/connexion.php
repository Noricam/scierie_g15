<?php
require __DIR__ . '/bootstrap.php';

function e(string $s): string {
  return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

$errCnx = $_SESSION['errCnx'] ?? '';
$creationOk = $_SESSION['creationOk'] ?? '';
$creationNok = $_SESSION['creationNok'] ?? '';
$errMdp = $_SESSION['errMdp'] ?? '';
$errId = $_SESSION['errId'] ?? '';

if (!isset($_SESSION['expire_blocage']) || time() >= $_SESSION['expire_blocage']) {
  $_SESSION['errCnx'] = '';
}
$_SESSION['creationOk'] = '';
$_SESSION['creationNok'] = '';
$_SESSION['errMdp'] = '';
$_SESSION['errId'] = '';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="page de connexion">

	<title>CONNEXION</title>
	<link rel="icon" href="/images/Scie-ico.ico" sizes="any">
	<link rel="icon" type="image/png" href="/images/Scie-ico.png" sizes="32x32">
	<link rel="stylesheet" href="/style.css">
	<link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
</head>

<body>
<!--*************** MENU ***************-->
	<nav class="navbar">
		<button class="menu-btn" type="button" aria-label="Ouvrir/fermer le menu" aria-expanded="false">
			<svg width="24" height="24" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
			<path d="M4 6h16M4 12h16M4 18h16" stroke="currentColor" stroke-width="2" fill="none"/>
			</svg>
		</button>
		<ul class="nav-links" id="navLinks">
			<li class="nav-item"><a href="index.php">ACCUEIL</a></li>
			<li class="nav-item"><a href="produits.php">LES PRODUITS</a></li>
			<li class="nav-item"><a href="video.php">VIDEO</a></li>
			<li class="nav-item"><a href="contact.php">NOUS CONTACTER</a></li>
			<?php if (isset($_SESSION['id'])): ?>
				<li class="nav-item"><a href="administration.php">ADMINISTRATION</a></li>
				<li class="nav-item"><a href="deconnexion.php">DECONNEXION</a></li>
			<?php else: ?>
				<li class="nav-item"><a href="connexion.php">CONNEXION</a></li>
			<?php endif; ?>
		</ul>

		<img src="/images/scierie.gif" alt="Logo de la scierie" style="width:70px; margin:5px;">
	</nav>

<!-- Requete JQuery initiale supprimée pour améliorer la performance et l'accessibilité
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">

	$(document).ready(function(){

		$('.menu').click(function(){
			
			$('ul').toggleClass('active');
		})
	})

</script>
-->

<!-- Remplacement par un JavaScript natif pour une meilleure performance et accessibilité -->
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const btn = document.querySelector('.menu-btn');
    const nav = document.getElementById('navLinks');
    if (!btn || !nav) return;

    btn.addEventListener('click', () => {
      const open = nav.classList.toggle('active');
      btn.setAttribute('aria-expanded', open ? 'true' : 'false');
    });
  });
</script>
<!--*************** END MENU ***************-->
	<main class="forms" role="main">
    <ul class="onglets" role="tablist" aria-label="Connexion / Inscription">
      <li class="onglet active" role="presentation">
        <a href="#login" role="tab" aria-controls="login" aria-selected="true">Connexion</a>
      </li>
      <li class="onglet" role="presentation">
        <a href="#sinscrire" role="tab" aria-controls="sinscrire" aria-selected="false">Inscription</a>
      </li>
    </ul>

    <!-- Messages -->	
    <?php if ($errCnx || $creationOk || $creationNok): ?>
      <p class="err" aria-live="polite">
        <?= e($errCnx ?: ($creationOk ?: $creationNok)) ?>
      </p>
    <?php endif; ?>

    <form action="controleur/traitementFormConnexion.php" method="POST" id="login">
      <h1>Connexion</h1>

      <div class="input-field">
        <label for="idUtil">Identifiant</label>
        <input type="text" name="idUtil" id="idUtil" autocomplete="username" required>

        <label for="mdpUtil">Mot de passe</label>
        <input type="password" name="mdpUtil" id="mdpUtil" autocomplete="current-password" required>

        <button type="submit" class="button">Se connecter</button>
      </div>
    </form>

    <form action="controleur/traitementFormInscription.php" id="sinscrire" method="POST" hidden>
      <h1>S'inscrire</h1>

      <?php if ($errMdp || $errId): ?>
        <p class="err" aria-live="polite"><?= e($errMdp ?: $errId) ?></p>
      <?php endif; ?>

      <div class="input-field">
        <label for="idUtilCreation">Identifiant</label>
        <input type="text" name="idUtilCreation" id="idUtilCreation" autocomplete="username" required>

        <label for="pwdCreation">Mot de passe</label>
        <input type="password" name="pwdCreation" id="pwdCreation" autocomplete="new-password" required>

        <label for="pwdBis">Confirmez le mot de passe</label>
        <input type="password" name="pwdBis" id="pwdBis" autocomplete="new-password" required>

        <button type="submit" class="button">S'inscrire</button>
      </div>
    </form>
  </main>

<!--*************** PIED DE PAGE ***************-->
	<footer id="footer">
		<ul class="footer-links">
			<li class="footer-item">©Projet 3iL</li>
			<li class="footer-item"><a href="https://www.facebook.com/Scierie-du-Fargal-613509152159633/" target="_blank"><img id="logo" src="/images/facebook.png" alt="Logo facebook" loading="lazy" decoding="async"></a></li>
			<li class="footer-item">Site test</li>
		</ul>
	</footer>
<!--*************** PIED DE PAGE ***************-->

	<script>
    document.addEventListener('DOMContentLoaded', () => {
      const tabs = document.querySelectorAll('.onglet a');
      const forms = document.querySelectorAll('.forms > form');

      function show(id) {
        forms.forEach(f => {
          const isTarget = ('#' + f.id) === id;
          f.hidden = !isTarget;
        });

        tabs.forEach(a => {
          const active = a.getAttribute('href') === id;
          a.parentElement.classList.toggle('active', active);
          a.setAttribute('aria-selected', active ? 'true' : 'false');
        });
      }

      tabs.forEach(a => {
        a.addEventListener('click', (e) => {
          e.preventDefault();
          show(a.getAttribute('href'));
        });
      });

      show('#login');
    });
  </script>
</body>
</html>




