<?php
require('actions/questionAction.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="assets/images/logo-gbaf.png" />
    <title>Question - GBAF</title>
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
                <h1 class="form-title">Question secrète</h1>
                
                <?php include 'includes/messageFlash.php'; ?>
                
                <form class="sign-form" method="POST">
                    <div class="field">
                        <label for="username">Pseudo</label>
                        <input class="input" type="text" name="username" disabled value="<?= $user['username'] ?>">
                    </div>
                    <div class="field">
                        <label for="question">Question secrète</label>
                        <select name="question">
                            <option value="0">-- Choisissez une question --</option>
                            <?php if(count($selectQuestions)>0) : ?>
                                <?php for ($i=0; $i<count($selectQuestions); $i++) : ?>
                                    <option value="<?= $selectQuestions[$i]['id']?>"
                                        <?= isset($user['id_questions']) && $selectQuestions[$i]['id'] == $user['id_questions'] ? "selected" : "" ?>><?= $selectQuestions[$i]['content']?>
                                    </option>
                                <?php endfor; ?>    
                            <?php endif; ?>
                        </select>     
                    </div>
                    <div class="field">
                        <label for="answer">Répondre</label>
                        <input class="input" type="text" name="answer">
                    </div>
                    <button class="btn" type="submit" name="submit">Soumettre</button>
                </form>
            </div>
        </div>
    <div class="bottom-band"></div>
</body>
</html>
