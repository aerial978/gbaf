<?php
require('actions/database.php');

if (isset($_POST['submit'])) {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

    $checkUser = $bdd->prepare('SELECT * FROM user WHERE username = ?');
    $checkUser->execute(array($username));
    

        if($checkUser->rowCount() > 0) {
            $userInfo = $checkUser->fetch();
            var_dump($userInfo['password']);
            
            if(password_verify($password, $userInfo['password'])) {
                session_start();
                $_SESSION['auth'] = $userInfo;
                $_SESSION['id'] = $userInfo['id'];
                $_SESSION['firstname'] = $userInfo['first_name'];
                $_SESSION['lastname'] = $userInfo['last_name'];

                header('Location: home.php');
            } else {
                $errorMsg = "Pseudo ou mot de passe invalide 1 !";
            }
        } else {
            $errorMsg = "Pseudo ou mot de passe invalide 2 !";
        }
    } else {
        $errorMsg = "Veuillez remplir tous les champs !";
    }
}