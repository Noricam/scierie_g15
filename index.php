<?php
session_start();
?>

<!DOCTYPE html>

<html lang="fr">

<head>
<title>TEST GREEN IT</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="index">
	
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
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

	<img src="./images/scierie.gif" alt="Logo de la scierie" style="width:70px; margin:5px;">
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
	<section>
	<?php 
		include"includes/slider.php";
	?>
	</section>
	<main>
	<?php
		include"controleur/initIndex.php";
	?>
	</main>
<!--*************** PIED DE PAGE ***************-->
<footer id="footer">
	<ul class="footer-links">
    	<li class="footer-item">©Projet 3iL</li>
    	<li class="footer-item"><a href="#" target="_blank"><img id="logo" src="images/facebook.png" loading="lazy" decoding="async"></a></li>
    	<li class="footer-item">Site test</li>
	</ul>
</footer>
<!--*************** PIED DE PAGE ***************-->
	<script type="text/javascript" src="scripts/slider.js"></script>

</body>

</html>
