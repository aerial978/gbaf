<?php

session_start();

include 'bdd.php';

$success=false; // Déclaration de la variable réussite de la connection sur faux
$error=array(); // Variable des messages d'erreur
$showerror=false; // Déclaration affichage des erreurs sur faux

if(!empty($_POST)){
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

        if(empty($username)) {
			$error[]='Le pseudo ne peut être vide !';	
		} 
		if (empty($password)) { 
			$error[]='Le mot de passe ne peut être vide !';
		} 
		if (count($error) == 0) {
       		$req = $bdd->prepare('SELECT * FROM salaries WHERE username = :checkName');
        	$req->bindValue(':checkName', $username);
	        if($req->execute()) {
	        	$user = $req->fetch();
	        	if(!empty($user)) {
				    //Comparaison du mdp saisi et celui dans la bdd
	        		if(password_verify($_POST['password'], $user['password'])){
						$success = true;
			                $_SESSION['id'] = $user['id'];
			                $_SESSION['nom'] = $user['nom'];
			                $_SESSION['prenom'] = $user['prenom'];
			                $_SESSION['username'] = $user['username'];
							header("Location: partenaires.php");

	        		} else {
						// Le mot de passe est invalide
						$error[] = 'Le couple identifiant/mot de passe est invalide';
					}							
	        	} else {
					//utilisateur inconnu
					$error[] = 'Le couple identifiant/mot de passe est invalide';
				}
			}
		}
	}
	 if(count($error) != 0) {
	 	$showerror = true;
	 }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style8.css" />
	<title>connexion</title>
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
						<legend>CONNEXION AU COMPTE</legend>
						<ol>
							<li>
								<div id=message1>
									<?php
									// On affiche le message de réussite
									 if($success) {echo 'Connexion effectué !';} ?>
								</div>
								<div id=message2>
									<?php 
									// On affiche les messages d'erreur
									if($showerror) {echo implode(' ',$error);} ?>
								</div>
							
								<label for="pseudo">Pseudo</label><input type="text" name="username" id="pseudo" /><br />

								<label for="password">Mot de passe</label><input type="password" name="password" id="pass" /><br />

								<p><input type="submit" name="connexion" value="SE CONNECTER" /></p><br />
							</li>
							<p><a href="mdpoublie.php">Mot de passe oublié ?</a></p>
							<p>Vous n'avez pas encore de compte ? <a href="inscription.php">Inscrivez-vous !</a></p>
						</ol>
					</fieldset>
				</form>
			</section>
		</div>
<footer>
</footer>
</body>
</html>