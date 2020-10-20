	<?php

	session_start();
	 
	include 'bdd.php';
	 
	if(isset($_GET['id']) AND $_GET['id'] > 0) {
		$getid=($_GET['id']);
		// récupération des données du salarié connecté
	   $req = $bdd->prepare("SELECT * FROM salaries WHERE id = ?");
	   $req->execute(array($getid));
	   $userinfo = $req->fetch();
	   // insertion du nouveau nom
	   if(isset($_POST['newnom']) AND !empty($_POST['newnom']) AND $_POST['newnom'] != $userinfo['nom']) {
	      $newnom = htmlspecialchars($_POST['newnom']);
	      $insertnom = $bdd->prepare("UPDATE salaries SET nom = ? WHERE id = ?");
	      $insertnom->execute(array($newnom, $_SESSION['id']));
	      
	   } 
	   // insertion du nouveau prénom
	   if(isset($_POST['newprenom']) AND !empty($_POST['newprenom']) AND $_POST['newprenom'] != $userinfo['prenom']) {
	      $newnom = htmlspecialchars($_POST['newprenom']);
	      $insertnom = $bdd->prepare("UPDATE salaries SET prenom = ? WHERE id = ?");
	      $insertnom->execute(array($newprenom, $_SESSION['id']));
	      
	   } 
	   // insertion du nouveau pseudo
	   if(isset($_POST['newusername']) AND !empty($_POST['newusername']) AND $_POST['newusername'] != $userinfo['username']) {
	      $newusername = htmlspecialchars($_POST['newusername']);
	      $insertusername = $bdd->prepare("UPDATE salaries SET username = ? WHERE id = ?");
	      $insertusername->execute(array($newusername, $_SESSION['id']));
	      
	   } 
	   // insertion du nouveau mdp
	   if(isset($_POST['newpassword']) AND !empty($_POST['newpassword']) AND isset($_POST['newpassword2']) AND !empty($_POST['newpassword2'])) {
	      $pass_hache = password_hash($_POST['newpassword'], PASSWORD_DEFAULT);
	      $pass_hache2 = password_hash($_POST['newpassword2'], PASSWORD_DEFAULT);
	      if($pass_hache == $pass_hache2) {
	         $insertpassword = $bdd->prepare("UPDATE salaries SET password = ? WHERE id = ?");
	         $insertpassword->execute(array($pass_hache, $_SESSION['id']));
	         
	      } else {
	         $msg='Les mots de passe ne correspondent pas !';
	      }
	  	} //insertion de la nouvelle question
	      if(isset($_POST['newquestion']) AND !empty($_POST['newquestion']) AND $_POST['newquestion'] != $userinfo['question']) {
	      $newquestion = htmlspecialchars($_POST['newquestion']);
	      $insertquestion = $bdd->prepare("UPDATE salaries SET question = ? WHERE id = ?");
	      $insertquestion->execute(array($newquestion, $_SESSION['id']));
	      
	   } 
	   		//insertion de la nouvelle réponse
	   if(isset($_POST['newreponse']) AND !empty($_POST['newreponse']) AND $_POST['newreponse'] != $userinfo['reponse']) {
	      $newreponse = htmlspecialchars($_POST['newreponse']);
	      $insertreponse = $bdd->prepare("UPDATE salaries SET reponse = ? WHERE id = ?");
	      $insertreponse->execute(array($newreponse, $_SESSION['id']));
	      
	   } 
	}
	?>
<!DOCTYPE html>
<html lang="fr">
	<head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="style2.css" />
      <title>parametres du compte</title>
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
   							<legend>PARAMETRES DU COMPTE</legend>
   							<ol>
   								<li>
   									<div id=message1>
   									<?php 
   									//affichage des messages d'erreur
   									if(isset($msg)) { echo $msg; } ?><br />
   									</div>
				               			<div id=label>
							               <label for="newnom">Nom</label><input type="text" name="newnom" value="<?php echo $userinfo['nom']; ?>" autofocus /><br />
							               
							               <label for="newprenom">Prénom</label><input type="text" name="newprenom" value="<?php echo $userinfo['prenom']; ?>" /><br />
							               
							               <label for="newusername">Pseudo</label><input type="text" name="newusername" value="<?php echo $userinfo['username']; ?>" /><br />
							               
							               <label for="newpassword">Mot de passe</label><input type="password" name="newpassword" /><br />
							               
							               <label for="newpassword2">Confirmer mot de passe</label><input type="password" name="newpassword2" /><br />
							               
							               <label for="newquestion">Question secrète</label><input type="text" name="newquestion" value="<?php echo $userinfo['question']; ?>" /><br />
							               
							               <label for="newreponse">Réponse</label><input type="text" name="newreponse" /><br />
						               	</div>
						               	<br />
					     				<p><input type="submit" value="Modifier" /></p><br />
				     			</li>
				     			<p><a href="index.php" >Connectez-vous !</a></p>
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
