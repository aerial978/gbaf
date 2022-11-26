<?php
require('actions/indexAction.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="assets/images/logo-gbaf.png" />
    <title>Connexion - GBAF</title>
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
                <h1 class="form-title">Connexion</h1>
                
                <?php include 'includes/messageFlash.php'; ?>
                
                <form class="sign-form" method="POST">
                    <div class="field">
                        <label for="username">Pseudo</label>
                        <input class="input" type="text" name="username">
                    </div>
                    <div class="field">
                        <label for="password">Mot de passe</label>
                        <input class="input" type="password" name="password">
                    </div>
                    <button class="btn" type="submit" name="submit">Se connecter</button>
                    <div class="form-link">
                        <a href="signup.php"><p>Pas encore de compte ? Inscrivez-vous !</p></a>
                    </div>
                </form>
            </div>
        </div>
    <div class="bottom-band"></div>
</body>
</html>