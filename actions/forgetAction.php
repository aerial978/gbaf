<?php
require('actions/database.php');

if (isset($_POST['submit'])) {
    if (!empty($_POST['username'])) {
        $username = htmlspecialchars($_POST['username']);

        $checkUser = $bdd->prepare('SELECT username FROM user WHERE username = ?');
        $checkUser->execute([$username]);
        $getUsername = $checkUser->fetch();

        if($checkUser->rowCount() > 0) {
            session_start();
            $_SESSION['successMsg'] = "Veuillez saisir la réponse à votre question !";
            header('Location: question.php?username='.$getUsername['username']);
        } else {
            $errorMsg = "Pseudo invalide !";
        }
    } else {
        $errorMsg = "Pseudo invalide !";
    }
}




