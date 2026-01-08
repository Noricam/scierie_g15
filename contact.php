<?php
session_start();
?>
<!DOCTYPE html>

<html lang="fr">
	<head>
		<meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">

		<title>TRUC</title>

		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

	</head>

	<body>
<!--*************** MENU ***************-->
<nav class="navbar">
	<li class="toggle">
		<ul class ="toggle-item"><i class="fa fa-bars menu" aria-hidden="true"> </i></ul>
	</li>
   <ul class="nav-links">
      	<li class="nav-item"><a href="index.php">ACCUEIL</a></li>
      	<li class="nav-item"><a href="produits.php">LES PRODUITS</a></li>
	  	<li class="nav-item"><a href="video.php">VIDEO</a></li>
		<li class="nav-item"><a href="contact.php">NOUS CONTACTER</a></li>
<?php 
	if (isset($_SESSION['id'])) {	
		echo "<li class='nav-item'><a href='administration.php'>ADMINISTRATION</a></li>";
	}
	if(isset($_SESSION['id'])) {
		echo "<li class='nav-item'><a href='deconnexion.php'>DECONNEXION</a></li>";
	}else{
		echo "<li class='nav-item'><a href='connexion.php'>CONNEXION</a></li>";
	}
?>
    </ul>

	<img src="./images/scierie.gif" style="width:70px; margin:5px;">
</nav>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">

	$(document).ready(function(){

		$('.menu').click(function(){
			
			$('ul').toggleClass('active');
		})
	})

</script> 
<!--*************** END MENU ***************-->

		<div class="contactContainer">

			<div class="rightContainer">

				<div class = "email">
					<h2> EMAIL </h2>
					<p> scierie.gineste@wanadoo.fr <p>
				</div>

				<div class = "telephone">
					<h2> TELEPHONE </h2>
					<p> +33 9 70 35 54 09 <p>
				</div>

				<div class = "adresse">
					<h2> ADRESSE </h2>
					<ul>
						<li> Route de Rodez <li>
						<li> 12220 <li>
						<li> MONTBAZENS <li>
					</ul>
				</div>

				<div class = "reseauxSociaux">
					<h2> NOUS SUIVRE </h2>

					<ul class="logo">
						<li class="facebook"><a href="https://www.facebook.com/Scierie-du-Fargal-613509152159633/" target="_blank"><img src="images/facebook.png"></a></li>
					</ul>
				</div>

			</div>

		</div>

<!--*************** PIED DE PAGE ***************-->
<footer id="footer">
	<ul class="footer-links">
    	<li class="footer-item">©Projet 3iL</li>
    	<li class="footer-item"><a href="#" target="_blank"><img id="logo" src="images/facebook.png"></a></li>
    	<li class="footer-item">Site test</li>
	</ul>
</footer>
<!--*************** PIED DE PAGE ***************-->

	</body>

</html>
