<?php 

    session_start();
/*    if (empty($_SESSION) && !isset($_SESSION['username'])){
        header('Location: index.php'); 
    } 


$error = [];
$showSuccess = false;
$userExist = false;*/
 include 'bdd.php';
$errorUpdate  = []; // erreur lors de la mise Ã  jour de la table 
$showError = false;
$showSuccess = false;
$userOk    = false;




/*if(isset($_GET['username'])) {
    if( $req->execute()) {
        $userExist = true;
    } else {
            echo 'accès bdd échouer';
        }
}*/ 
if(!empty($_POST['username'])) {
    $username = htmlspecialchars($_POST['username']);

    //Récupération du visiteur
    $req = $bdd->prepare('SELECT * FROM salaries WHERE username = :username');
    $req->bindValue('username', $username, PDO::PARAM_STR);
    if($req->execute()) {
        $user = $req->fetch(PDO::FETCH_ASSOC);
        if (!empty($user) && is_array($user)) {
            $userOk = true;
            $userExist = $user['username'];
        }
    }   
    
    //Si le pseudo saisie n'existe pas : message d'erreur
    if(!$userExist){            
        $error[] = 'le pseudo n\'existe pas';   
    }
    if(!$username) {
        $error[] = 'merci d\'enter un pseudonyme';
    }
    
    if(count($error) > 0) {
        $showError = true;
    } else {
        header('Location: mdpoublie.php?username='.$user['username']);

    }
} 
if(isset($_GET['username']) AND !empty($_GET['username']) AND is_string($_GET['username'])) {
    $username = $_GET['username'];
    $req = $bdd->prepare('SELECT * FROM salaries WHERE username = :username');
    $req->bindValue('username', $username, PDO::PARAM_STR);
    if($req->execute()) {
        $user = $req->fetch(PDO::FETCH_ASSOC);
        if (!empty($user) && is_array($user)) {
            $userOk = true;
            $userExist = $user['username'];
            $userResponse = $user['reponse'];
            $userQuestion = $user['question'];
        }
    }
}
if (!empty($_POST) && $userOk == true) {
    foreach ($_POST as $key => $value) {
        $post[$key] = htmlspecialchars($value);
    }
    if (empty($post['reponse']) && !isset($post['reponse'])) {
        $errorUpdate[] = 'La réponse ne peut être vide'; 
    }
    if(empty($post['password2']) && !isset($post['password2'])) {
        $errorUpdate[] = 'Le password ne peut être vide'; 
    }
    if(empty($post['newpassword']) && !isset($post['newpassword'])) {
        $errorUpdate[] = 'Le password ne peut être vide'; 
    }
    if($post['newpassword'] != $post['password2']) {
        $errorUpdate[] = 'Les mots de passe ne sont pas les mêmes'; 
    }
    if (password_verify($userResponse, $post['reponse'])) {
        $errorUpdate[] = 'Réponse éronée';
    }
    if (count($errorUpdate) > 0) {
        $showError = true;
    } else {
        $newPws = password_hash($post['newpassword'], PASSWORD_DEFAULT);
        $upd = $bdd->prepare('UPDATE salaries   SET password = :password WHERE username = :username');
        $upd->bindValue(':username', $userExist,           PDO::PARAM_STR);
        $upd->bindValue(':password', $newPws, PDO::PARAM_STR);
        if ($upd->execute()) {
            $showSuccess = true;
        }
        else {
            $errorUpdate = true;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset=UTF-8>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="texte/css" href="style5.css"> 
        <title>Mot de passe oublié</title>
    </head>
    <body>
        <div id=bloc_page>
            <div id=logoform>
                <header>
                    <div id=logo>
                        <img src="images/gbaf.png" alt="logo_gbaf" />
                    </div>
                    <div id=nom_logo>
                        <h3>Le Groupement Bancaire-Assurance Francais</h3>
                    </div>
                </header>
                <section>
                <?php if(!isset($_GET['username'])): ?> 
                    <form method="post" action="">
                        <fieldset>
                            <legend>MODIFIER MOT DE PASSE</legend>
                                
                                <div id=message1>
                                    <ol>
                                        <?php 
                                        if ($showError) {
                                            echo implode('<li>', $error) .'</li>';
                                        }?>
                                    </ol>
                                </div> 
                                <p><label for="pseudo">Pseudo</label><input type="text" name="username" id="pseudo"></p>
                               <p> <input type="submit" name="mdpoublie" value="VALIDER" /></p>
                               
                        </fieldset>
                     </form>
                <?php endif; ?>
                   
                <?php if(isset($_GET['username'])): ?>
               
                    <form method="post" action="">
                        <?php 
                        if ($showError) {
                            echo implode('<br>', $errorUpdate) . '<br>';
                        }
                        if($showSuccess) {
                            echo 'Mot de passe modifié avec success<br>';
                        }
                        ?> 

                        <label for="question">Question</label>
                        <input type="text" id="question" value="<?= $userQuestion; ?>"/><br />
                     
                        <label for="reponse">Réponse</label>
                        <input type="text" id="reponse" name="reponse"><br />
                  
                        <label for="newpassword">Nouveau mot de passe</label>
                        <input type="password" id="newpassword" name="newpassword"><br />
                   
                        <label for="password2">Confirmation mot de passe</label>
                        <input type="password" id="password2" name="password2"><br />
                   
                        <p><input type="submit" name="mdpoublie" value="VALIDER" /></p><br />
            
                    </form>
                <?php endif; ?>
                </section>
            </div>  
    <footer>
    </footer>
    </div>
    </body>
</html>
