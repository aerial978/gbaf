<?php
try {
	session_start();
	$bdd = new pdo('mysql:host=localhost;dbname=gbaf;charset=utf8', 'root', '');
}
catch(Exception $e) {
	die('Erreur : '.$e->getMessage());
}
?>