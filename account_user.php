<?php
require('actions/accountUserAction.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="assets/images/logo-gbaf.png" />
    <title>Account-user - GBAF</title>
    <link rel="stylesheet" href="assets/css/formStyle.css">
    <link rel="stylesheet" href="assets/css/msgStyle.css">
</head>
<body>
    <div class="top-band"></div>
        <div class="container">
            <div class="brand">
                <div class="logo">
                    <img src="assets/images/logo-gbaf.png" alt="logo" />
                </div>
                <div class="logo-title">
                    <h5>Groupement Bancaire-Assurance Francais</h5>
                </div>
            </div>
            <div class="form">
                <h1 class="form-title">Paramètres du compte</h1>
                
                <?php include 'includes/messageFlash.php'; ?>
                
                <form class="sign-form" method="POST">
                    <div class="field form-field">
                        <label for="username">Pseudo</label>
                        <input class="input" type="text" name="username" value="<?= isset($_POST['username']) ? $_POST['username'] : $account['username'] ?>">
                        <small class="error-field">
                            <?php if (isset($errorUsername)) : ?>
                                <?= $errorUsername; ?>
                            <?php endif; ?>
                        </small>   
                    </div>
                    <div class="field form-field">
                        <label for="firstname">Nom</label>
                        <input class="input" type="text" name="firstname" value="<?= isset($_POST['firstname']) ? $_POST['firstname'] :  $account['first_name'] ?>">
                        <small class="error-field">
                            <?php if (isset($errorFirstName)) : ?>
                                <?= $errorFirstName; ?>
                            <?php endif; ?>
                        </small> 
                    </div>
                    <div class="field form-field">
                        <label for="lastname">Prénom</label>
                        <input class="input" type="text" name="lastname" value="<?= isset($_POST['lastname']) ? $_POST['lastname'] :  $account['last_name'] ?>">
                        <small class="error-field">
                            <?php if (isset($errorLastName)) : ?>
                                <?= $errorLastName; ?>
                            <?php endif; ?>
                        </small> 
                    </div>
                    <div class="field form-field">
                        <label for="question">Question secrète</label>
                        <select name="question">
                            <option value="0">-- Choisissez une question --</option>
                            <?php if(count($selectQuestions)>0) : ?>
                                <?php for ($i=0; $i<count($selectQuestions); $i++) : ?>
                                    <option value="<?= $selectQuestions[$i]['id']?>"
                                        <?= isset($account['id_questions']) && $selectQuestions[$i]['id'] == $account['id_questions'] ? "selected" : "" ?>><?= $selectQuestions[$i]['content']?>
                                    </option>
                                <?php endfor; ?>    
                            <?php endif; ?>
                        </select>       
                    </div>
                    <div class="field form-field">
                        <label for="answer">Réponse secrète</label>
                        <input class="input" type="text" name="answer" value="<?= isset($_POST['answer']) ? $_POST['answer'] :  $account['answer'] ?>">
                        <small class="error-field">
                            <?php if (isset($errorAnswer)) : ?>
                                <?= $errorAnswer; ?>
                            <?php endif; ?>
                        </small>
                    </div>
                    <div class="field form-field">
                        <label for="password">Mot de passe</label>
                        <input class="input" type="password" name="password">
                        <small class="error-field">
                            <?php if (isset($error['Password'])) : ?>
                                <?= $error['Password']; ?>
                            <?php endif; ?>
                        </small>
                    </div>
                    <div class="field">
                        <label for="password">Confirmation<br>mot de passe</label>
                        <input class="input" type="password" name="password_confirm">
                    </div>
                    <button class="btn" type="submit" name="submit">Soumettre</button>
                    <div class="form-link">
                        <a href="home.php">Retour</a></p>
                    </div>
                </form>
            </div>
        </div>
    <div class="bottom-band"></div>
</body>
</html>