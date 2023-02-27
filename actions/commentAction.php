<?php
require('actions/database.php');

if (isset($_POST['submit'])) {
    if (!empty($_POST['texte'])) {
        $texte = htmlspecialchars($_POST['texte']);

        $insertComment = $bdd->prepare("INSERT INTO comment (id_partenaire, last_name, date, texte) VALUES (:id_partenaire, :last_name, NOW(), :texte ");
        $insertComment->execute([
            'id_partenaire' => $_SESSION['auth']['id'],
            'lastname' => $_SESSION['lastname'],
            'texte' => $texte
        ]);

    }
}