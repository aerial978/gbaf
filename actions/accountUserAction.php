<?php
require('database.php');
require('authentificationAction.php');

$req = $bdd->prepare('SELECT * FROM questions');
$req->execute();
$selectQuestions = $req->fetchAll(\PDO::FETCH_ASSOC);

if(isset($_SESSION['id'])) {
    $user = $bdd->prepare('SELECT *, user.id as userId FROM user 
    LEFT JOIN questions ON user.id_questions = questions.id
    WHERE user.id = ?');
    $user->execute(array($_SESSION['id']));
    $account = $user->fetch();
} else {
    $errorsMsg['id'] = "Vous avez besoin d'un identifiant pour le modifier !";
}

if(isset($_POST['submit'])) {
    $username = htmlspecialchars($_POST['username']);
    $firstName = htmlspecialchars($_POST['firstname']);
    $lastName = htmlspecialchars($_POST['lastname']);
    $question = htmlspecialchars(($_POST['question']));
    $answer = htmlspecialchars($_POST['answer']);
    $password = htmlspecialchars($_POST['password']);
    $passwordConfirm = htmlspecialchars($_POST['password_confirm']);

    if(empty($_POST['username'])) {
        $errorUsername = 'Pseudo invalide !';
    } else {
        $updateUsername = $bdd->prepare('UPDATE user SET username = ? WHERE id = ?');
        $updateUsername->execute(array($username,$_SESSION['id']));
    }

    if(empty($_POST['firstname'])) {
        $errorFirstName = 'Prénom invalide !';
    } else {
        $updateFirstName = $bdd->prepare('UPDATE user SET first_name = ? WHERE id = ?');
        $updateFirstName->execute(array($firstName,$_SESSION['id']));
    }

    if(empty($_POST['lastname'])) {
        $errorLastName = 'Nom invalide !';
    } else {
        $updateLastName = $bdd->prepare('UPDATE user SET last_name = ? WHERE id = ?');
        $updateLastName->execute(array($lastName,$_SESSION['id']));
    }

    if(empty($_POST['question'])) {
        $errorQuestion = 'Question invalide !';
    } else {
        $updateQuestion = $bdd->prepare('UPDATE user SET id_questions = :question WHERE id = :id');
        $updateQuestion->execute([
            'question' => $question,
            'id' => $_SESSION['id']
        ]);
    }

    if(empty($_POST['answer'])) {
        $errorAnswer = 'Réponse invalide !';
    } else {
        $updateAnswer = $bdd->prepare('UPDATE user SET answer = ? WHERE id = ?');
        $updateAnswer->execute(array($answer,$_SESSION['id']));
    }

    if(empty($_POST['password'])) {
        $error['Password'] = 'Mot de passe invalide !';
    } else {
        if($password == $passwordConfirm) {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $updatePassword = $bdd->prepare('UPDATE user SET password = ? WHERE id = ?');
            $updatePassword->execute(array($password,$_SESSION['id']));
        } else {
            $errorPassword = 'Mot de passe & et sa confirmation sont différents !';
        }
    }
    if(!$error) {
        header('Location: actions/logoutAction.php');
    }
}
?>

