<?php
session_start();

if ((!(isset($_SESSION['id'])) || empty($_SESSION['id'])) && $_SESSION['role'] != "admin") {
	header("Location:connexion.php");
}
?>
<!DOCTYPE html>

<html lang="fr">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="page d'administration">


	<title>TEST GREEN IT</title>

	<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="content/administration.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
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
	<!-- Ajout d'un produit -->
	<div class="row">
	<div class="containerAjoutProduit col-90">
		<h1> Ajout d'un nouveau produit</h1>
		<span class="reussite"> 
			<?php
				if (isset($_SESSION['msgAddOk'])) {
					echo $_SESSION['msgAddOk'];
					$_SESSION['msgAddOk'] = "";
				}
			
			?>
		</span>	
		<span class="err"> 
			<?php
				if (isset($_SESSION['msgAddNok'])) {
					echo $_SESSION['msgAddNok'];
					$_SESSION['msgAddNok'] = "";
				}
			
			?>
		</span>
		<form  id="formAjoutProduit" action="" method="post">
			<div class="row">
				<div class="col-40">
					<label for="lbProduit">Titre du produit</label>
				</div>
				<div class="col-40">
					<input type="text" id="lbProduit" name="lbProduit" placeholder="Entrer le titre du produit" required/>
				</div>
			</div>
			<div class="row">
				<div class="col-40">
					<label for="lbDescr">Description</label>
				</div>
				<div class="col-40" id="description">
					<input type="text" id="lbDescr" name="lbDescr" placeholder="Entrer la description" required/>
				</div>
			</div>
			<div class="row">
				<div class="col-40">
					<label for="lbImg">Image</label>
				</div>
				<div class="col-40" id="image">
					<input type="text" id="lbImg" name="lbImg" placeholder="Entrer le nom d'une image" required/>
				</div>
			</div>

			<div class="row">
				<input id="btnAjoutProduit" type="button" value="Ajouter">
			</div>
		</form>
	</div>

	
	
	
	<!-- Modification de produit -->
	<div class="containerModifProduit col-90">
		<h1> Modification d'un produit</h1>
		<span class="reussite"> 
			<?php
				if (isset($_SESSION['msgModifOk'])) {
					echo $_SESSION['msgModifOk'];
					$_SESSION['msgModifOk'] = "";
				}
			
			?>
		</span>	
		<span class="err"> 
			<?php
				if (isset($_SESSION['msgModifNok'])) {
					echo $_SESSION['msgModifNok'];
					$_SESSION['msgModifNok'] = "";
				}
			
			?>
        </span>			
			<form  id="formModifproduit" action="#" method="post">
				<div class="row" id="rowModificationProduit">
				</div>	
				<div class="row">
					<div class="col-40">
						<label for="lbDescrModif">Description</label>
					</div>
					<div class="col-40" id="descriptionModif">
						<input type="text" id="lbDescrModif" name="lbDescrModif" placeholder="Entrer la description" required/>
					</div>
				</div>
				<div class="row">
					<div class="col-40">
						<label for="lbImgModif">Image</label>
					</div>
					<div class="col-40" id="imageModif">
						<input type="text" id="lbImgModif" name="lbImgModif" placeholder="Entrer le nom d'une image" required/>
					</div>
				</div>
				<div class="row">
					<input id="btnModifProduit" type="button" value="Modifier">
				</div>
			
			</form>
	</div>
	</div>
	<!-- Suppression de produit -->
	<div class="row">
	<div class="containerSuppProduit col-90">
		<h1> Suppression d'un produit</h1>
		<span class="reussite"> 
			<?php
				if (isset($_SESSION['msgSuppOk'])) {
					echo $_SESSION['msgSuppOk'];
					$_SESSION['msgSuppOk'] = "";
				}
			
			?>
        </span>	
		<span class="err"> 
			<?php
				if (isset($_SESSION['msgSuppNok'])) {
					echo $_SESSION['msgSuppNok'];
					$_SESSION['msgSuppNok'] = "";
				}
			
			?>
        </span>			
			<form  id="formSuppProduit" action="#" method="post">
				<div class="row" id="rowSuppression">
				</div>
				<div class="row">
				<input id="btnSuppProduit" type="button" value="Supprimer">
			</div>
		    </form>
	</div>
<!--*************** PIED DE PAGE ***************-->
<footer id="footer">
	<ul class="footer-links">
    	<li class="footer-item">©Projet 3iL</li>
    	<li class="footer-item"><a href="#" target="_blank"><img id="logo" src="images/facebook.png" loading="lazy" decoding="async"></a></li>
    	<li class="footer-item">Site test</li>
	</ul>
</footer>
<!--*************** PIED DE PAGE ***************-->
	
	<script src="scripts/initSelectModifProduit.js"></script>
	<script src="scripts/initSelectModifAccueil.js"></script>
	<script src="scripts/initSelectSuprProduit.js"></script>
</body>

</html>
