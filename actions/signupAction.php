<?php
require('actions/database.php');

if (isset($_POST['submit'])) {
    if (!empty($_POST['username']) && !empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['question']) && !empty($_POST['answer']) && !empty($_POST['password'] && !empty($_POST['confirmpassword']))) {
        $username = htmlspecialchars($_POST['username']);
        $firstname = htmlspecialchars($_POST['firstname']);
        $lastname = htmlspecialchars($_POST['lastname']);
        $question = htmlspecialchars($_POST['question']);
        $answer = password_hash($_POST['answer'], PASSWORD_DEFAULT);
        $password = htmlspecialchars($_POST['password']);
        $passwordConfirm = htmlspecialchars($_POST['password_confirm']);

        $checkUser = $bdd->prepare('SELECT username FROM user WHERE username = ?');
        $checkUser->execute(array($username));

        if ($checkUser->rowCount() == 0) {
            if ($password == $password_confirm) {
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $insertUser = $bdd->prepare('INSERT INTO user (username, first_name, last_name, question, answer, password) VALUES(?, ?, ?, ?, ?, ?)');
                $insertUser->execute(array($username,$firstname,$lastname,$question,$answer,$password));

                $getUser = $bdd->prepare('SELECT * FROM user WHERE first_name = ? AND last_name = ?');
                $getUser->execute(array($firstname, $lastname));

                $_SESSION['auth'] = $getUser->fetch()['id'];
                $_SESSION['firstname'] = $firstname;
                $_SESSION['lastname'] = $lastname;

                header('Location: home.php');
            } else {
                $errorMsg = "Invalid password !";
            }
        } else {
            $errorMsg = "User already used !";
        }
    } else {
        $errorMsg = "Please complete all fields !";
    }
}
