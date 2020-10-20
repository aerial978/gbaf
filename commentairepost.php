<?php

include 'bdd.php';

//création du nouveau commentaire

$req = $bdd->prepare('INSERT INTO commentaire(id_partenaire, prenom, dates, texte) VALUES(:id_partenaire,:prenom,NOW(),:texte)') or die(print_r($bdd->errorInfo()));
$req->execute(array(
	'id_partenaire'=> $_GET['id'],
	'prenom'=> $_POST['prenom'],
	'texte'=> $_POST['texte']
));

header('Location:commentaire.php?partenaires='.$_GET['id']);



?>

