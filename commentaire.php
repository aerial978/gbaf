<?php
        session_start();

        include 'bdd.php';

?>

        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Commentaire</title>
            <link  rel="stylesheet" href="style9.css"/> 
        </head>

        <body>
            <div id=bloc_page>
                <header>
                    <div id=logo>
                       <img src="images/gbaf.png" alt="logo_gbaf" />
                    </div>

                    <div id=userdecon>
                        <div id=avauser>
                            <div id=avatar>
                                <!-- Redirection à la page paramétres profil en cliquant sur l'icône avatar --> 
                                <a href="profil.php?id=<?php echo $_SESSION['id']; ?>"><img src="images/avataruser.png" alt="avataruser" title="Paramètres du compte" /></a>
                            </div>
                            <div id=username>

                            <?php
                                // Affichage du nom et prénom du salarié connecté
                                if(isset($_SESSION['id'])){ 
                                echo $_SESSION['nom'] .' '. $_SESSION['prenom'];
                                }   
                            ?>

                            </div>
                        </div>
                        <div id=decon>
                            <!-- Redirection vers la page connexion après déconnexion -->
                            <button><a href="deconnexion.php">DECONNEXION</a></button>
                        </div>
                    </div>
                </header>

            <?php
            // Récupération des données du partenaire
            $req = $bdd->prepare('SELECT id, logo, nompart, textecomplet FROM partenaires WHERE id = ?');
            $req->execute(array($_GET['partenaires']));
            $donnees = $req->fetch();
            ?>

            <div id=acteur>
                <div id=logoacteur>
                    <div id= logo2>
                        <!-- Affichage du logo -->
                        <?php echo ('<img style="width:400px;height:200px;" src = "' .$donnees['logo']. '"/>'); ?>
                    </div>
                </div>

                <div id=titreacteur>  
                    <!-- Affichage du nom du partenaire --> 
                    <h2><?php echo $donnees['nompart']; ?></h2>
                </div> 
                <div id=buttonretour>
                    <!-- Redirection vers page liste des partenaires -->
                    <button><a href="partenaires.php">Retour</a></button>
                </div>
                <div id=textecomplet>
                    <p>  <!-- Affichage texte complet du partenaire -->
                        <?php echo nl2br(htmlspecialchars($donnees['textecomplet']));?>
                    </p>
                </div>

            </div>

            <div id=cadrecomm>
                <div id=headercomm>
                    <div id=comm>
                        <p>COMMENTAIRES</p>
                    </div>

                    <div id=likedislike>
                        <div id=nbrelikedislike>
            <?php

            // Récupération du nombre de like du partenaire

            $likes = $bdd->prepare('SELECT COUNT(*) AS nbl FROM likes WHERE id_partenaire = ?');

            $likes->execute(array($_GET['partenaires']));

            while ($donnees = $likes->fetch()) {

                // On place le nombre de like dans une variable

                $nbl=$donnees['nbl'];
            }

            $likes->closeCursor();

            // Récupération du nombre de dislike du partenaire

            $dislikes = $bdd->prepare('SELECT COUNT(*) AS nbd FROM dislikes WHERE id_partenaire = ?');

            $dislikes->execute(array($_GET['partenaires']));

            while ($donnees = $dislikes->fetch()) {

                // On place le nombre de dislike dans une variable

                $nbd=$donnees['nbd'];
            }

            $dislikes->closeCursor();

            // On additionne le nbre de like/dislike

            $totld=$nbd+$nbl;

            // On affiche le total de like/dislike

            echo $totld;
        ?>

                        </div>

                        <div id=cadrelikedislike>
                            <div id=logolike>
                                <!-- on clique sur le logo like -->
                                <a href="likdis.php?ldis=1&id=<?=$_GET['partenaires']?>"><img src="images/thumbs_up.png" width="50" alt="logo_up" /></a>
                            </div>
                            <div id=logodislike>
                                <!-- on clique sur le logo dislike -->
                                <a href="likdis.php?ldis=2&id=<?=$_GET['partenaires']?>"><img src="images/thumbs_down.png" width="50" alt="logo_down" /></a>
                            </div>
                        </div>
                    </div>
                
            </div>



            <div id=nouvcommentaire>
                <!-- formulaire saisie nouveau commentaire -->
                <form method="post" action="commentairepost.php?id=<?=$_GET['partenaires']?>">
                    <ol>
                        <li>
                            <label for="prenom">Prénom : </label><input type="text" name="prenom" value="<?php echo $_SESSION['prenom'];?>" id="prenom" maxlength="20" size="50" /><br />
                            <br />
                            <label for="texte">Texte : </label><textarea name="texte" id="texte" rows="10" autofocus></textarea><br />
                            <input type="submit" name="envoyer" value="NOUVEAU COMMENTAIRE"/>
                        </li>
                    </ol>
                </form>
            </div>

            <?php

            // récupération des 5 derniers commentaires dans bdd
            $req = $bdd->prepare('SELECT prenom, DATE_FORMAT(dates, \'%d/%m/%Y à %Hh%imin%ss\') AS dates_fr, texte FROM commentaire WHERE id_partenaire = ? ORDER BY dates DESC LIMIT 5');
            $req->execute(array($_GET['partenaires']));

            while ($donnees = $req->fetch())
            {

                ?> 

                <div id=commentaire>
                    <div id=prenomcomm>
                        <!-- affichage du prénom -->
                        <?php echo $donnees['prenom'];?>
                    </div>

                    <div id=datecomm>
                        <!-- affichage de la date -->
                        <?php echo $donnees['dates_fr'];?>
                    </div>

                    <div id=textecomm>
                        <!-- affichage du commentaire -->
                        <?php echo $donnees['texte'];?>
                    </div>
                </div>

                <?php
            }

            $req->closeCursor();
            ?>

        </div>
        <footer>
            
                <div id=mention>
                    <h3>Mentions légales</h3>
                </div>
                <div id=barre>
                    <p>|</p>
                </div>

                <div id=contact>
                    <h3>Contact</h3>
                </div>
            
        </footer>

        </div>
       

        </body>
        </html>