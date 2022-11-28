<?php
require('actions/database.php');

if (isset($_GET['username'])) {
    $checkUser = $bdd->prepare('SELECT * FROM user WHERE username = ?');
    $checkUser->execute(array($_GET['username']));
    $user = $checkUser->fetch();

    if (isset($_POST['submit'])) {
        if(!empty($_POST['answer'])) {
        $answer = htmlspecialchars($_POST['answer']);
            if (password_verify($answer,$user['answer'])) {
                $_SESSION['successMsg'] = "Veuillez saisir votre nouveau mot de passe !";
                header('Location: resetPassword.php?username='.$user['username']);
            } else {
                $errorMsg = "Mauvaise réponse !";
            }
        } else {
            $errorMsg = "Veuillez saisir une réponse !";
        }
    }
}