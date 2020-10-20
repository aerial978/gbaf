<?php

session_start();

include 'bdd.php';

// Gestion des messages d'erreur

$success=false; // Déclaration de la variable réussite de la création du compte sur faux
$error=array(); // Variable des messages d'erreur
$showerror=false; // Déclaration affichage des erreurs sur faux


if(isset($_POST['inscription'])) {

	$nom = htmlspecialchars($_POST['nom']);
	$prenom = htmlspecialchars($_POST['prenom']);
	$username = $_POST['username'];
	$password = htmlspecialchars($_POST['password']);
	$password2 = htmlspecialchars($_POST['password2']);
	$question = htmlspecialchars($_POST['question']);
	$reponse = htmlspecialchars($_POST['reponse']);


	// comparaison des mdp et condition des erreurs si champs vide
	if ($password == $password2) {
		if (empty($nom)) {
			$error[]='Le nom ne peut être vide';
		}
		if (empty($prenom))	{
			$error[]='le prenom ne peut être vide';
		} 
		if (empty($username)) {
			$error[]='le pseudo ne peut être vide';
		} 
		if (empty($question)) {
			$error[]='la question ne peut être vide';
		}
		if (empty($reponse)) {
			$error[]='la réponse ne peut être vide';
		}
	} else {
		$error[]='<p>mot de passe est invalide !</p>';
	}

	// si il existent des erreurs
	if (count($error) > 0) {
		
		// Alors l'affichage des erreurs est vrai
		$showerror = true;
	} else {
		// Traitement du hachage du mdp et réponse
		$pass_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$reponse_hache = password_hash($_POST['reponse'], PASSWORD_DEFAULT);

		// On ajoute le compte d'un salarié
		$req = $bdd->prepare('INSERT INTO salaries(nom, prenom, username, password, question, reponse) VALUES(:nom, :prenom, :username, :password, :question, :reponse)');
		$req->execute(array(
			'nom' => $nom,
			'prenom' => $prenom,
			'username' => $username,
			'password' => $pass_hache,
			'question' => $question,
			'reponse' => $reponse_hache));
		
		// Donc la saisie de l'inscription est bonne
		header('Location:index.php');

	}
}	

?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style4.css"> 
	<title>inscription</title>
</head>
<body>
	<div id=bloc_page>
		<div id=logoform>
			<header>
				<div id=logo>
					<img src="images/gbaf.png" alt="logo_gbaf" />
				</div>
				<div id=nom_logo>
					<h3>Le Groupement Bancaire-Assurance Francais</h3>
				</div>
			</header>
			<section>
				<form method="post" action="">
					<fieldset>
						<legend>INSCRIPTION DU COMPTE</legend>
						<ol>
							<li>
								<div id=message1>
									<?php 
									// On affiche le message de réussite
									if($success) {echo '<p>Votre compte a été créé avec succès !</p>';} ?><br />
								</div>
								<div id=message2>
									<?php	
									// On affiche les messages d'erreur
									if($showerror) {echo implode(', ',$error);}
									?><br />	
								</div>

								<div id=label>
								
								<label for="nom">Nom</label><input type="text" name="nom" id="nom" autofocus /><br />
	
								<label for="prenom">Prénom</label><input type="text" name="prenom" id="prenom" /><br />
								
								<label for="pseudo">Pseudo</label><input type="text" name="username" id="pseudo" /><br />
								
								<label for="pass">Mot de passe</label><input type="password" name="password" id="password" /><br />

								<label for="pass2">Confirmer mot de passe</label><input type="password" name="password2" id="password2" /><br />

								<label for="question">Question secrète</label><input type="text" name="question" id="question" /><br />

								<label for="reponse">Réponse</label><input type="text" name="reponse" id="reponse" /><br />

								</div>
								
								<p><input type="submit" name="inscription" value="VALIDER"></p><br />
						
							</li>
							<p>Vous avez déjà un compte ? <a href="index.php">Connectez-vous !</a></p>		
						</ol>	
					</fieldset>
				</form>
			</section>
		</div>
		<footer>		
		</footer>
	</div>
</body>
</html>