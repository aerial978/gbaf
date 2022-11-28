<?php
require('actions/database.php');

if (isset($_POST['submit'])) {
    if (!empty($_POST['username']) | !empty($_POST['password'])) {
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

    $checkUser = $bdd->prepare('SELECT * FROM user WHERE username = ?');
    $checkUser->execute(array($username));

        if($checkUser->rowCount() > 0) {
            $userInfo = $checkUser->fetch();
            if(password_verify($password, $userInfo['password'])) {
                $_SESSION['auth'] = $userInfo;
                $_SESSION['firstname'] = $userInfo['first_name'];
                $_SESSION['lastname'] = $userInfo['last_name'];

                header('Location: home.php');
            } else {
                $errorMsg = "Invalid username or password !";
            }
        } else {
            $errorMsg = "Invalid username or password !";
        }
    } else {
        $errorMsg = "Please complete all fields !";
    }
}