<?php
require('database.php');

$req = $bdd->prepare('SELECT * FROM questions');
$req->execute();
$selectQuestions = $req->fetchAll(\PDO::FETCH_ASSOC);

if (isset($_POST['submit'])) {
    if (!empty($_POST['username']) && !empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['question']) && !empty($_POST['answer']) 
    && !empty($_POST['password'] && !empty($_POST['password_confirm']))) {
        $username = htmlspecialchars($_POST['username']);
        $firstname = htmlspecialchars($_POST['firstname']);
        $lastname = htmlspecialchars($_POST['lastname']);
        $question = htmlspecialchars($_POST['question']);
        $answer = htmlspecialchars($_POST['answer']);
        $password = htmlspecialchars($_POST['password']);
        $passwordConfirm = htmlspecialchars($_POST['password_confirm']);

        $checkUser = $bdd->prepare('SELECT username FROM user WHERE username = ?');
        $checkUser->execute(array($username));

        if ($checkUser->rowCount() == 0) {
            if ($password == $passwordConfirm) {
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $insertUser = $bdd->prepare('INSERT INTO user (username, first_name, last_name, id_questions, answer, password) 
                VALUES(:username, :first_name, :last_name, :question, :answer, :password)');
                $insertUser->execute([
                    'username' => $username,
                    'first_name' => $firstname,
                    'last_name' => $lastname,
                    'question' => $question,
                    'answer' => $answer,
                    'password' => $password
                ]);

                $getUser = $bdd->prepare('SELECT * FROM user WHERE first_name = ? AND last_name = ?');
                $getUser->execute(array($firstname, $lastname));

                $_SESSION['auth'] = $getUser->fetch()['id'];
                $_SESSION['firstname'] = $firstname;
                $_SESSION['lastname'] = $lastname;

                header('Location: index.php');
            } else {
                $errorMsg = "Mot de passe invalide !";
            }
        } else {
            $errorMsg = "Utilisateur existe déjà !";
        }
    } else {
        $errorMsg = "Veuillez remplir tous les champs !";
    }
}
