	<?php

	include 'bdd.php';

		// Déclaration variables id partenaire et like/dislike

		$idpart = $_GET['id'];
		$ldis = $_GET['ldis'];

		// Récupération du partenaire

		$verif = $bdd->prepare('SELECT id FROM partenaires WHERE id = ?');
		$verif->execute(array($idpart));

			if($ldis == 1) {

				// Si  variable like/dislike = like alors on ajoute un like à ce partenaire

				$req = $bdd->prepare('INSERT INTO likes (id_partenaire) VALUES (?)');
				$req->execute(array($idpart));

			}  else  {

				// Sinon on ajoute un dislike à ce partenaire

				$req = $bdd->prepare('INSERT INTO dislikes (id_partenaire) VALUES (?)');
				$req->execute(array($idpart));
			}

			// Redirection vers la page commentaire du partenaire

			header('Location:commentaire.php?partenaires='.$_GET['id']);

			

		
	
		
	?>





