<?php
require('actions/database.php');

$getPartners = $bdd->prepare('SELECT * FROM partner');
$getPartners->execute();