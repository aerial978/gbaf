<?php
require('database.php');
require('authentificationAction.php');

// PARTNER DATA
$req = $bdd->prepare('SELECT * FROM partner WHERE id = ?');
$req->execute(array($_GET['partner']));
$partner = $req->fetch();

if ($partner == false) {
    header('location: ../404page.php');
}

// LIKE DISLIKE PROCESSING
$id = $partner['id'];
// Nombre de like du partner //
$likes = $bdd->prepare('SELECT id FROM likes WHERE id_partner = ?');
$likes->execute([$id]);
$likes = $likes->rowCount();

// Nombre de dislike du partner //
$dislikes = $bdd->prepare('SELECT id FROM dislikes WHERE id_partner = ?');
$dislikes->execute([$id]);
$dislikes = $dislikes->rowCount();

if (isset($_GET['likedislike']) AND isset($_GET['partner']) AND !empty($_GET['likedislike']) AND !empty($_GET['partner'])) {
    $getId = (int) $_GET['partner'];
    $getLikeDislike = (int) $_GET['likedislike'];
    // Contrôle si le partner existe
    $checkPartner = $bdd->prepare('SELECT id FROM partner WHERE id = ?');
    $checkPartner->execute([$getId]);
    // Si le partner existe
    if ($checkPartner->rowCount() > 0) {
        // Si le vote est à like, on récupère le like de l'utilisateur attribué au partner
        if ($getLikeDislike == 1) {
            $checkLike = $bdd->prepare('SELECT id FROM likes WHERE id_partner = ? AND id_user = ?');
            $checkLike->execute([$getId,$_SESSION['user']['id']]);
            // On change de choix, on retire simultanément le dislike pour ajouter le like
            $delete = $bdd->prepare('DELETE FROM dislikes WHERE id_partner = ? AND id_user = ?');
            $delete->execute([$getId,$_SESSION['user']['id']]);
            // Si l'utilisateur à déjà voter like pour ce partner et qu'il clique à nouveau sur like, on retire le like
            if ($checkLike->rowcount() == 1) {
                $delete = $bdd->prepare('DELETE FROM likes WHERE id_partner = ? AND id_user = ?');
                $delete->execute([$getId,$_SESSION['user']['id']]);
            } else {
                // Sinon l'utilisateur n'a pas encore voté like pour ce partner et qu'il clique sur like, on ajoute le like
                $insert = $bdd->prepare('INSERT INTO likes (id_partner,id_user) VALUES (?,?)');
                $insert->execute([$getId,$_SESSION['user']['id']]);
            }
        // Si le vote est à dislike, on récupère le dislike de l'utilisateur attribué au partner
        } else {
            $checkLike = $bdd->prepare('SELECT id FROM dislikes WHERE id_partner = ? AND id_user = ?');
            $checkLike->execute([$getId,$_SESSION['user']['id']]);
            // On change de choix, on retire simultanément le like pour ajouter le dislike
            $delete = $bdd->prepare('DELETE FROM likes WHERE id_partner = ? AND id_user = ?');
            $delete->execute([$getId,$_SESSION['user']['id']]);
            // Si l'utilisateur à dèjà voter dislike pour ce partner et qu'il clique à nouveau sur dislike, on retire le dislike
            if ($checkLike->rowcount() == 1) {
                $delete = $bdd->prepare('DELETE FROM dislikes WHERE id_partner = ? AND id_user = ?');
                $delete->execute([$getId,$_SESSION['user']['id']]);
            } else {
                // Sinon l'utilisateur n'a pas encore voté dislike pour ce partner et qu'il clique sur dislike, on ajoute le dislike
                $insert = $bdd->prepare('INSERT INTO dislikes (id_partner,id_user) VALUES (?,?)');
                $insert->execute([$getId,$_SESSION['user']['id']]);
            }
        }
    }
    header('Location: ../partner.php?partner='.$getId);
}

// COUNT COMMENTS
$req = $bdd->prepare('SELECT COUNT(*) AS total FROM comment LEFT JOIN partner ON comment.id_partner = partner.id WHERE id_partner = '.$_GET['partner'].''); 
$countCommentsPartners = $req->fetchAll();

// IF USER COMMENT ALREADY EXISTS
$req= $bdd->prepare('SELECT * FROM comment 
LEFT JOIN user ON comment.id_user = user.id 
LEFT JOIN partner ON comment.id_partner = partner.id
WHERE user.id = ? AND partner.id = ?');
$req->execute([$_SESSION['user']['id'],$_GET['partner']]);
$verifComment = $req->fetchAll();

// ADD COMMENT
if (isset($_POST['submit'])) {
    if (!empty($_POST['texte'])) {
        $texte = htmlspecialchars($_POST['texte']);

        $insertComment = $bdd->prepare('INSERT INTO comment (id_partner, id_user, created_at, texte) VALUES (:id_partner, :id_user, NOW(), :texte)');
        $insertComment->execute([
            'id_partner' => $partner['id'],
            'id_user' => $_SESSION['user']['id'],
            'texte' => $texte
        ]);
        header('Location: '.$_SERVER['REQUEST_URI'].'');
    } else {
        $errorMsg = "Veuillez saisir un commentaire !";
    }
}

// COMMENTS LIST
$getCommentsLists = $bdd->prepare('SELECT last_name, DATE_FORMAT(created_at, \'%d/%m/%Y à %Hh%imin%ss\') AS created_at_fr, texte FROM comment 
LEFT JOIN user ON comment.id_user = user.id
WHERE id_partner = ? ORDER BY created_at DESC');
$getCommentsLists->execute([$partner['id']]);
?>


