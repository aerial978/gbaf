<?php
require('actions/database.php');

$getPartners = $bdd->prepare('SELECT * FROM partners');
$getPartners->execute();