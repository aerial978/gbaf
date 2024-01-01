<?php
require('database.php');
require('authentificationAction.php');

/*$getPartners = $bdd->prepare('SELECT * FROM partner');
$getPartners->execute();*/

$sql = "SELECT * FROM `partner`";

$getPartners = $bdd->prepare($sql);

$getPartners->execute();

?>