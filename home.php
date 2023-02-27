<?php
require('actions/homeAction.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/homeStyle.css">
</head>

<body>
    <header>
        <nav>
            <div class="container">
                <div class="logo">
                    <img src="../assets/images/logo-gbaf.png" alt="logo">
                </div>
                <div class="user-session">
                    <?php if (isset($_SESSION['id'])) : ?>
                        <div class="avatar-user">  
                            <a href="account_user.php?id=<?= $_SESSION['id']; ?>"><img src="../assets/images/user-default.png" alt="avatar"></a>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['auth'])) : ?>
                        <div class="username">
                            <p><?= $_SESSION['firstname'] . ' ' . $_SESSION['lastname']; ?></p>
                        </div>
                    <?php endif; ?>
                    <a class="rounded-button" href="actions/logoutAction.php"><i class="fas fa-sign-out-alt"></i></a>
                </div>
            </div>
        </nav>
    </header>
    <section class="hero">
        <h1>Groupe Bancaire-Assurance Francais<h1>
                <h2>Un modèle de banque coopèrative universelle</h2>
                <h2>au service de ses clients et de l'économie</h2>
    </section>
    <section class="group">
        <div class="container">
            <div class="group-description">
                <h1>Le Groupe GBAF est une fédération représentant les 6 grands groupes français.</h1>
            </div>
            <div class="group-banner">
            </div>
        </div>
    </section>
    <section class="slider">
        <div class="container">
            <div class="logos-bank">
                <div class="customer-logos">
                    <div class="slide"><a href=""><img src="assets/images/banks/bnp-paribas.svg"></a></div>
                    <div class="slide-bp"><a href=""><img src="assets/images/banks/banque-postale.svg" alt=""></a></div>
                    <div class="slide"><a href=""><img src="assets/images/banks/bpce.png" alt=""></a></div>
                </div>
                <div class="customer-logos">
                    <div class="slide"><a href=""><img src="assets/images/banks/credit-agricole.svg" alt=""></a></div>
                    <div class="slide"><a href=""><img src="assets/images/banks/credit-mutuel.svg" alt=""></a></div>
                    <div class="slide"><a href=""><img src="assets/images/banks/societe-generale.svg" alt=""></a></div>
                </div>
                <p class="rights">All Rights Reserved &copy;</p>
            </div>
        </div>
    </section>
    <section class="block container">
        <div class="block-about">
            <div class="block-left">
                <div class="title-left">
                    <h5>Présentation</h5>
                    <h2>Le Groupe</h2>
                </div>
                <div class="content-left">
                    <p>Même s'il existe une forte concurrence entre ces entités, elles vont toutes travailler de la même façon pour gérer près de 80 millions de comptes sur le territoire national.
                        Le GBAF est le représentant de la profession bancaire et des assureurs sur tous les axes de la réglementation financière française. Sa mission est de promouvoir l'activité bancaire à l'échelle nationale. C'est aussi un interlocuteur privilégié des pouvoirs publics.</p>
                </div>
            </div>
            <div class="block-right">
                <img src="../assets/images/meeting.jpg">
            </div>
        </div>
    </section>
    <section class="partners">
        <div class="container">
            <div class="cards">
                <div class="cards-title">
                    <h1>Nos acteurs et partenaires</h1>
                </div>
                <div class="cards-text">
                    Le GBAF vous propose un point d'entrée unique, répertoriant un grand nombre d'information
                    sur les partenaires et acteurs du groupe ainsi que sur les produits et services bancaires et financiers.
                </div>
                <?php foreach ($getPartners as $getPartner) : ?>
                    <div class="card">
                        <div class="card-image">
                            <img src="assets/images/partners/<?= $getPartner['logo']; ?>">
                        </div>
                        <div class="card-content">
                            <h2 class="partner-title"><?= $getPartner['name']; ?></h2>
                            <p class="exercpt">
                                <?= $getPartner['outline']; ?>
                            </p>
                            <div class="partner-cta">
                                <a href="partner.php?partner=<?= $getPartner['id']; ?>" class="button">Suite</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
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