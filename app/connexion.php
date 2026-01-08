<?php
require __DIR__ . '/bootstrap.php';
?>

<span class="err">
    <?php
        if (isset($_SESSION['errCnx'])) {
            // Protection XSS sur le message d'erreur
            echo htmlspecialchars($_SESSION['errCnx'], ENT_QUOTES, 'UTF-8');
            // On n'efface le message que si l'utilisateur n'est pas en train d'être bloqué
            if (!isset($_SESSION['expire_blocage']) || time() >= $_SESSION['expire_blocage']) {
                $_SESSION['errCnx'] = "";
            }
        }
    ?>
</span>
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

	<section>
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
	</section>
	
	<ul class="onglets">
		    <li class="onglet active"><a href="#login">Connexion</a></li>
		    <li class="onglet"><a href="#sinscrire">Inscription</a></li>
		</ul>
<!--*************** PIED DE PAGE ***************-->
<footer id="footer">
	<ul class="footer-links">
    	<li class="footer-item">©Projet 3iL</li>
    	<li class="footer-item"><a href="https://www.facebook.com/Scierie-du-Fargal-613509152159633/" target="_blank"><img id="logo" src="/images/facebook.png" alt="Logo facebook" loading="lazy" decoding="async"></a></li>
    	<li class="footer-item">Site test</li>
	</ul>
</footer>
<!--*************** PIED DE PAGE ***************-->

	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	<script type="text/javascript">
	$(document).ready(function(){
	      $('.onglet a').on('click', function (e) {
	      e.preventDefault();
	       
	      $(this).parent().addClass('active');
	      $(this).parent().siblings().removeClass('active');
	       
	      var href = $(this).attr('href');
	      $('.forms > form').hide();
	      $(href).fadeIn(333);
	    });
	});
</script>

</body>

</html>




