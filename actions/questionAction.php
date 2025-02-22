<?php
require('database.php');
require('authentificationAction.php');

$req = $bdd->prepare('SELECT * FROM questions');
$req->execute();
$selectQuestions = $req->fetchAll(\PDO::FETCH_ASSOC);

if (isset($_GET['username'])) {
    $checkUser = $bdd->prepare('SELECT *, user.id as userId FROM user 
    LEFT JOIN questions ON user.id_questions = questions.id
    WHERE username = ?');
    $checkUser->execute(array($_GET['username']));
    $user = $checkUser->fetch();

    if (isset($_POST['submit'])) {
        if(!empty($_POST['answer'])) {
        $answer = htmlspecialchars($_POST['answer']);
            if ($answer == $user['answer']) {
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
?>