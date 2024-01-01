<?php
require('database.php');
require('authentificationAction.php');

if (isset($_GET['username'])) {
    $checkUser = $bdd->prepare('SELECT * FROM user WHERE username = ?');
    $checkUser->execute(array($_GET['username']));
    $user = $checkUser->fetch();

    if(isset($_POST['submit'])) {
        if(!empty($_POST['password']) && !empty($_POST['password_confirm'])) {
            $password = htmlspecialchars($_POST['password']);
            $passwordConfirm = htmlspecialchars($_POST['password_confirm']);

            if($password == $passwordConfirm) {
                $password = password_hash($password, PASSWORD_DEFAULT);
                $insertUserNewpassword = $bdd->prepare('UPDATE user SET password = :password WHERE username = :username');
                $insertUserNewpassword->execute([
                    'password' => $password,
                    'username' => $username
                ]);
                $_SESSION['successMsg'] = "Connectez-vous avec votre nouveau mot de passe !";
                header('Location: index.php');
            } else {
                $errorMsg = "Mot de passe invalide !";
            }
        } else {
            $errorMsg = "Veuillez remplir tous les champs !";
        }
    }
}
?>