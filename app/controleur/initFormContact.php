<?php
session_start();
require("../metier/DB_connector.php");
require("../metier/User.php");
require("../Dao/UserDao.php");

// On vérifie que la variable de session est existante
if (isset($_SESSION['id'])) {
	// On récupère les infos de l'utilisateur connecté
	$cnx = new DB_Connector();
	$jeton = $cnx->openConnexion();

	// Création du user
	$userManager = new UserDao($jeton);
	$util = $userManager->get($_SESSION['id']);

	echo '
	    	<p> Vous pouvez consulter ou mettre à jour vos informations.</p>
			
	        <form name="form_monCompte" method="POST" action="controleur/updateFormMonCompte.php">
				
				<div class="identifiant">
					<label for="inputID" class="labelID"> Identifiant</label>

					<input type="text" name="inputID" id="inputID" value="'.$util->getUserId().'" disabled="true"/><br />
				</div>

				<div class="motDePasse">
					<label for="inputPwd" class="labelPwd"> Mot de Passe<p class="etoile"> *</p> </label>

					<input type="password" name="inputPwd" id="inputPwd"/ required><br />
				</div>

				<div class="nom">
					<label for="inputNom" class="labelNom"> Nom </label>
					<input type="text" name="inputNom" id="inputNom" value="'.$util->getUserNom().'"/>
				</div>

				<div class="prenom">		
					<label for="inputPrenom" class="labelPrenom"> Prénom </label>
					<input type="text" name="inputPrenom" id="inputPrenom" value="'.$util->getUserPrenom().'"/><br />
				</div>

				<div class="telephone">
					<label for="inputTel" class="labelTel"> Téléphone </label>

					<input type="text" name="inputTel" id="inputTel"  maxlength="10" value="'.$util->getUserContact().'"/><br />
				</div>

				<div class="codePostal">
					<label for="inputCP" class="labelCP"> Code Postal </label>

					<input type="text" name="inputCP" id="inputCP" maxlength="5" value="'.$util->getUserCp().'" /><br />
				</div>

				<div class="adresse">
					<label for="inputAdresse" class="labelAdresse"> Adresse </label>

					<input type="text" name="inputAdresse" id="inputAdresse" value="'.$util->getUserAdresse().'"/><br />
				</div>

				

				<div class="ville">
					<label for="inputVille" class="labelVille"> Ville </label>

					<input type="text" name="inputVille" id="inputVille"  value="'.$util->getUserVille().'"/><br />
				</div>


				<div class="subBtnContainer">
					<input class="subForm" type="submit" name="upvote" value="Soumettre" />
				</div>
			</form>';
}


?>