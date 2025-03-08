<?php
/*try {
	session_start();
	$bdd = new pdo('mysql:host=localhost;dbname=gbaf;charset=utf8', 'root', '');
}
catch(Exception $e) {
	die('Erreur : '.$e->getMessage());
}*/

session_start();

if (str_contains($_SERVER['HTTP_HOST'], 'michel-hathier.fr')) {

	define("DBHOST", "localhost");
	define("DBUSER", "einx0252_gbaf");
	define("DBPASS", "iyUP7L4aDspE");
	define("DBNAME", "einx0252_gbaf");

} else {

	define("DBHOST", "localhost");
	define("DBUSER", "root");
	define("DBPASS", "");
	define("DBNAME", "gbaf");
}

	$dsn = "mysql:dbname=".DBNAME.";host=".DBHOST;

try {
    $bdd = new PDO($dsn, DBUSER, DBPASS);

    $bdd->exec("SET NAMES utf8");

    $bdd->SetAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

}catch(PDOException $e){
	die("Erreur: ".$e->getMessage());
}

?>