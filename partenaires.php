<?php

session_start();

include 'bdd.php';

?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="style7.css"> 
		<title>partenaires</title>
	</head>
<body>
	<div id=bloc_page>
		<header>
			<div id=logo>
				<img src="images/gbaf.png" alt="logo_gbaf" />
			</div>

			<div id=userdecon>
				<div id=avauser>
				<div id=avatar>
					<!-- Redirection à la page paramétres profil en cliquant sur l'icône avatar --> 
					<a href="profil.php?id=<?php echo $_SESSION['id']; ?>"><img src="images/avataruser.png" alt="avataruser" title="Paramètres du compte" /></a>
				</div>
				<div id=username>
				<?php
					// Affichage du nom et prénom du salarié connecté
					if(isset($_SESSION['id'])){ 
						echo $_SESSION['nom'] .' '. $_SESSION['prenom'];
					}
            	?>
				</div>
			</div>
				<div id=decon>
					<!-- Redirection vers la page connexion après déconnexion -->
					<button><a href="deconnexion.php">DECONNEXION</a></button>
				</div>
			</div>
		</header>

		<div id=titre>
			<h1>LE GROUPEMENT BANCAIRE-ASSURANCE FRANCAISE</h1>
		</div>
		<div id=descgbab>
				<h4>Le Groupement Banque Assurance Français (GBAF) est une fédération représentant les 6 grands groupes français :</h4>

				<div id=liste>
				<ul>
					<li>BNP Paribas</li>
					<li>BPCE</li>
					<li>Crédit Agricole</li>
					<li>Crédit Mutuel-CIC</li>
					<li>Société Générale</li>
					<li>La Banque Postale</li>
				</ul>
				</div>

				<h4>Le GBAF est le représentant de la profession bancaire et des assureurs sur tous les axes de la réglementation financière francaise.</h4>

				<p>Même s'il existe une forte concurrence entre ces entités, elles vont toutes travailler de la même façon pour gérer près de 80 millions de comptes sur le territoire national.
				Le GBAF est le représentant de la profession bancaire et des assureurs sur tous les axes de la réglementation financière française. Sa mission est de promouvoir l'activité bancaire à l'échelle nationale. C'est aussi un interlocuteur privilégié des pouvoirs publics.</p>

			</div>

		<div id=picture>
			<img src="images/money.jpg" alt="illustration">
		</div>
		<div id=presentpartenaires>
			<div id=titrepartenaires>
				<h2>ACTEUR ET PARTENAIRES</h2>
			</div>
			<div id=textepartenaires>
				<p>Le GBAF vous propose un point d'entrée unique, répertoriant un grand nombre d'informations sur les partenaires et acteurs du groupe ainsi que sur les produits et services bancaires et financiers.</p>
			</div>
		</div>

		<?php 
			// Récupération des données du partenaire
			$reponse = $bdd->query('SELECT * FROM partenaires');
			while ($donnees = $reponse->fetch()) {
			?>
			
			<div id=listacteur>
				<div id=acteur>
					<div id=logoacteur>
						<!-- Affichage du logo du partenaire -->
						<?php echo ('<img style="border-radius:10px;" src = "' .$donnees['logo']. '"/>'); ?>
					</div>
					<div id=contenuacteur>
						<div id=titreacteur>
							<!-- Affichage du nom du partenaire -->
							<?php echo $donnees['nompart']; ?>
						</div>
						<div id=presentationacteur>
							<!-- Affichage du résumé texte du partenaire -->
							<?php echo $donnees['texte']; ?>
						</div>
					</div>
					<div id=buttonsuite>
						<!-- Redirection vers la page du partenaire en cliquant sur bouton -->
						<button><a href="commentaire.php?partenaires=<?php echo $donnees['id']; ?>">Lire la suite</a></button>
					</div>
				</div>	
			</div>

		<?php
			
			}

			$reponse->closeCursor();

		?>
		<footer>
			
				<div id=mention>
					<h3>Mentions légales</h3>
				</div>
				<div id=barre>
					<p>|</p>
				</div>

				<div id=contact>
					<h3>Contact</h3>
				</div>
			
		</footer>
	</div>	
</body>
</html>