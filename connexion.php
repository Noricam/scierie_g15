<?php
session_start();
?>
<!DOCTYPE html>

<html lang="fr">

<head>
	<title>TEST GREEN IT</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>

<body>

	<section>
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
	</section>
	
	<div class="forms">

		<ul class="onglets">
		    <li class="onglet active"><a href="#login">Connexion</a></li>
		    <li class="onglet"><a href="#sinscrire">Inscription</a></li>
		</ul>

		<form action="controleur/traitementFormConnexion.php" method="GET" id="login">
			<h1>Connexion</h1>
            <span class="err">
				<?php
					if (isset($_SESSION['errCnx'])) {
						echo $_SESSION['errCnx'];
						$_SESSION['errCnx'] = "";
					}
					
					if (isset($_SESSION['creationOk'])) {
						echo $_SESSION['creationOk'];
						$_SESSION['creationOk'] = "";
					}
					
					if (isset($_SESSION['creationNok'])) {
						echo $_SESSION['creationNok'];
						$_SESSION['creationNok'] = "";
					}
					
				?>
            </span>
			<div class="input-field">

				<label for="idUtil">Identifiant</label>
				<input type="text" placeholder="Entrer le nom d'utilisateur" name="idUtil" id="idUtil" required>

				<label for="mdpUtil">Mot de Passe</label> 
				<input type="password" placeholder="Entrer le mot de passe" name="mdpUtil" id="mdpUtil" required>

				<input type="submit" value="Se connecter" class="button">
				

			</div>
		</form>

		<form action="controleur/traitementFormInscription.php" id="sinscrire" method="GET">
			<h1>S'inscrire</h1>
			<span class="err">
				<?php
					if (isset($_SESSION['errMdp'])) {
						echo $_SESSION['errMdp'];
						$_SESSION['errMdp'] = "";
					}
					if (isset($_SESSION['errId'])) {
						echo $_SESSION['errId'];
						$_SESSION['errId'] = "";
					}
				?>
            </span>
			<div class="input-field">
	            <label for="idUtilCreation">Identifiant</label> 
	            <input type="text" placeholder="Choisir un nom d'utilisateur" name="idUtilCreation" id="idUtilCreation" required>

	            <label for="pwdCreation">Mot de Passe</label> 
	            <input type="password" placeholder="Choisir un mot de passe" name="pwdCreation" id="pwdCreation" required>

	            <label for="pwdBis">Confirmez le Mot de Passe</label> 
	            <input type="password" placeholder="Ressaisir le mot de passe" name="pwdBis" id="pwdBis" required>
	            
	            <input type="submit" value="S'inscrire" class="button" />
			</div>
	    </form>
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




