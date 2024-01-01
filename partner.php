<?php
require('actions/partnerAction.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/css/partnerStyle.css">
    <link rel="stylesheet" href="assets/css/commentStyle.css">
    <link rel="stylesheet" href="assets/css/msgStyle.css">
</head>
<body>
    <header>
        <nav>
            <div class="container">
                <div class="logo">
                    <a href="home.php"><img src="assets/images/logo-gbaf.png" alt="logo"></a>
                </div>
                <div class="user-session">
                    <?php if (isset($_SESSION['user'])) : ?>
                        <div class="avatar-user">  
                            <a href="account_user.php?id=<?= $_SESSION['user']['id']; ?>"><img src="assets/images/user-default.png" alt="avatar"></a>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['user'])) : ?>
                        <div class="username">
                            <p><?= $_SESSION['user']['firstName'] . ' ' . $_SESSION['user']['lastName']; ?></p>
                        </div>
                    <?php endif; ?>
                    <a class="rounded-button" href="actions/logoutAction.php"><i class="fas fa-sign-out-alt"></i></a>
                </div>
            </div>
        </nav>
    </header>
    <div class="container">
        <section class="partner">
            <img src="assets/images/partners/<?= $partner['logo']; ?>" alt="logo-partner" width="75%">
        </section>
    </div>
    <section class="block container">
        <div class="block-about">
            <div class="block-left">
                <div class="title-left">
                    <h5>Acteur / partenaire</h5>
                    <h2><?= $partner['name'] ?></h2>
                </div>
                <div class="content-left">
                    <p><?= $partner['outline'] ?></p>
                    <p><?= $partner['content'] ?></p>
                </div>
            </div>
        </div>
    </section>
    <!-- Comments -->
    <div class="container-comment">
        <section class="comment-block">
            <div class="top">
                <?php foreach($countCommentsPartners as $countCommentsPartner) : ?>
                    <h3 class="comment-count"><?= $countCommentsPartner['total']; ?> commentaire(s)</h3>
                <?php endforeach; ?>
                <?php if(empty($verifComment)) : ?>
                    <button id="show" onclick="show()" class="comment-button">Nouveau commentaire</button>
                <?php else : ?>
                    <div class="success-msg already-comment">
                        Vous avez déjà commenté cet acteur/partenaire !
                    </div>
                <?php endif; ?>
                <!-- Like dislike buttons -->
                <div class="likedislike">
                    <div class="like">
                    <a href="partner.php?likedislike=1&partner=<?= $_GET['partner'] ?>"><i class="fa fa-thumbs-up fa-xl"></i></a>
                        <span><?= $likes; ?></span>
                    </div>
                    <div class="dislike">
                        <a href="partner.php?likedislike=2&partner=<?= $_GET['partner'] ?>"><i class="fa fa-thumbs-down fa-xl"></i></a>
                        <span><?= $dislikes; ?></span>
                    </div>
                </div>
                <!-- End like dislike buttons -->
            </div>
            <div class="form" id="form">
                <div class="comment-top">
                    <div class="title-comment">
                        <h3 class="form-title">Nouveau commentaire</h3>
                    </div>
                    <button id="show" onclick="hide()" class="comment-button">Fermer</button>
                </div>
                <?php include 'includes/messageFlash.php'; ?>
                <form class="sign-form" method="POST">
                    <div class="field">
                        <label>Nom</label>
                        <input class="input" type="text" name="lastname" value="<?= $_SESSION['user']['lastName'];?>" disabled>
                    </div>
                    <div class="field">
                        <label>Texte</label>
                        <textarea class="input" type="text" name="texte" cols="50" rows="10"></textarea>
                    </div>
                    <div class="form-footer">
                        <button class="btn-comment" type="submit" name="submit">Envoyer</button>
                    </div> 
                </form>      
            </div>
            <?php foreach ($getCommentsLists as $getCommentsList) : ?>
                <div class="comment-list">
                    <div class="comment-name">
                        <?= $getCommentsList['last_name'];?>
                    </div>
                    <div>
                        <!-- affichage de la date -->
                        <?= $getCommentsList['created_at_fr'];?>
                    </div>
                    <div>
                        <!-- affichage du commentaire -->
                        <?= $getCommentsList['texte'];?>
                    </div>
                </div>
            <?php endforeach; ?>                
        </section>
    </div>
    <!-- End comments -->
    <footer>
        <div class="mention">
            <h3>Mentions légales</h3>
        </div>
        <div class="barre">
            <p>|</p>
        </div>
        <div class="contact">
            <h3>Contact</h3>
        </div>
    </footer>
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
    function show() {
        document.getElementById('form').style.display="block"
        document.getElementById('show').style.display="none"
    }
    function hide() {
        document.getElementById('form').style.display="none"
        document.getElementById('show').style.display="inline"
    }
</script>







