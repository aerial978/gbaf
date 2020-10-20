<?php session_start();
if (empty($_SESSION) && isset($_SESSION['user']['role'])){

    if ($_SESSION['user']['role'] != 'admin') {
        
    }
    
} else {
    header('Location: ../index.php');
}
// connection Ã  la base
require_once 'inc/connect.php';

$post = array();
$error = array();

$errorUpdate  = false; // erreur lors de la mise Ã  jour de la table
$displayErr   = false; 
$formValid    = false;
$carExist    = false;

$marque = '';
$model = '';
$years = '';
$desc = '';
$alt = '';
$legend = '';

$folder = '../img/'; // crÃ©ation de la variable indiquant le chemin du rÃ©pertoire destination pour les fichiers uploadÃ©s (important  : le slash Ã  la fin de la chaine de caractÃ¨re).
$maxSize = 1000000 * 5; // 5Mo


// vÃ©rification des paramÃ¨tres GET et appel des champs Zico correspondants
if(isset($_GET['id']) AND !empty($_GET['id']) AND is_numeric($_GET['id'])) {

    $idCar = intval($_GET['id']);

    // PrÃ©pare et execute la requÃ¨te SQL pour rÃ©cuperer notre Zico de maniÃ¨re dynamique
    $req = $pdo->prepare('SELECT * FROM cars WHERE id = :idCar');
    $req->bindParam(':idCar', $idCar, PDO::PARAM_INT);
    if($req->execute()) {
        // $editCar contient mon musicien extrait de la pdo
        $editCar = $req->fetch(PDO::FETCH_ASSOC);
        if(!empty($editCar) && is_array($editCar)){ // Ici l'musicien existe donc on fait le traitement nÃ©cessaire
            $carExist = true; // Mon Zico existe.. donc bon paramÃ¨tre GET et requÃªte SQL ok

            //nom du fichier existant
            $dirlink = $editCar['picture'];
            // Si l'utilsateur existe, j'instancie la variable $idlink qui me permet de stcocker l'id Zico dans le nom du fichier
            $idlink = $editCar['id'];

            $carMarque = $editCar['marque'];
            $carModel = $editCar['model'];
            $carYears = $editCar['years'];
            $carDescription = $editCar['description'];
            $carAlt = $editCar['alt'];
            $carLegend = $editCar['legend'];

        }
    }
}

//var_dump($_FILES);

// UPLOAD DE FICHIER : ContrÃ´le de l'upload de fichier et de la supergloable $_FILES
if(!empty($_FILES) && isset($_FILES['picture'])) {

    if ($_FILES['picture']['error'] == UPLOAD_ERR_OK AND $_FILES['picture']['size'] <= $maxSize) {

        $nomFichier = $_FILES['picture']['name']; // recupere le nom de mon fichier au sein de la superglobale $_FILES (tableau multi-dimentionnel)
        $tmpFichier = $_FILES['picture']['tmp_name']; // Stockage temporaire du fichier au sein de la superglobale $_FILES (tableau multi-dimentionnel)
        
        $file = new finfo(); // Classe FileInfo
        $mimeType = $file->file($_FILES['picture']['tmp_name'], FILEINFO_MIME_TYPE); // Retourne le VRAI mimeType

        $mimTypeOK = array('image/jpeg', 'image/jpg', 'image/png', 'image/gif');

        if (in_array($mimeType, $mimTypeOK)) { // in_array() permet de tester si la valeur de $mimeType est contenue dans le tableau $mimTypeOK
                    
           /* CHANGER LE NOM DU FICHIER PAR MESURE DE SECURITE
            * explode() permet de sÃ©parer une chaine de caractÃ¨re en un tableau
            * Ici on aura donc : 
            *                   $newFileName  = array(
                                                    0 => 'nom-de-mon-fichier',
                                                    1 => '.jpg'
                                                );
            */
            $newFileName = explode('.', $nomFichier);
            $fileExtension = end($newFileName); // RÃ©cupÃ¨re la derniÃ¨re entrÃ©e du tableau (crÃ©Ã© avec explode) soit l'extension du fichier

            // nom du fichier link au format : Zico-id-timestamp.jpg
            $finalFileName = 'car-'.time().'.'.$fileExtension; // Le nom du fichier sera donc Zico-id-timestamp.jpg (time() retourne un timsestamp Ã  la seconde)



                if(move_uploaded_file($tmpFichier, $folder.$finalFileName)) { // move_uploaded_file()  retourne un booleen (true si le fichier a Ã©tÃ© envoyÃ© et false si il y a une erreur)
                    // Ici je suis sur que mon image est au bon endroit
                    $dirlink = $finalFileName;
                    
                    $success = 'Votre fichier a été uplaodé avec succés !';
                    $showSuccess = true;
                }
                else {
                    // Permet d'assigner un link par defaut
                    $dirlink = "img/link-default.jpg";
                }
        } // if (in_array($mimeType, $mimTypeOK))

        else {
            $error[] = 'Le type de fichier est interdit mime type incorrect !';
        } 

    } // end if ($_FILES['picture']['error'] == UPLOAD_ERR_OK AND $_FILES['picture']['size'] <= $maxSize)
    
} // end if (!empty($_FILES) AND isset($_FILES['picture'])

else {
    // Permet d'assigner l'link par defaut si l'musicien n'en a aucun
    $dirlink = "img/link-default.jpg";
}


// Si le formulaire est soumis et que $carExist est vrai (donc qu'on a un musicien)
if(!empty($_POST) && $carExist == true) {
    foreach($_POST as $key => $value) {
        $post[$key] = htmlspecialchars($value);
    }

    if(!preg_match("#^[A-Z]+[a-zA-Z0-9Ã€-Ãº\.:\!\?\&',\s-]{3,55}#", $post['marque'])){    
        $errors[] = 'Votre Pseudo de musicien doit comporter entre 3 et 55 caractères et commencer par une majuscule';
    }
    if(!preg_match("#^[A-Z]+[a-zA-Z0-9Ã€-Ãº\.:\!\?\&',\s-]{3,55}#", $post['model'])){    
        $errors[] = 'Votre Pseudo de musicien doit comporter entre 3 et 55 caractères et commencer par une majuscule';
    }
    if(!preg_match("#^[A-Z]+[a-zA-Z0-9Ã€-Ãº\.:\!\?\&',\s-]{10,1500}#", $post['desc'])){    
        $errors[] = 'Votre Pseudo de musicien doit comporter entre 10 et 1500 caractères et commencer par une majuscule';
    }
    if(!preg_match("#^[A-Z]+[a-zA-Z0-9Ã€-Ãº\.:\!\?\&',\s-]{3,70}#", $post['alt'])){    
        $errors[] = 'Votre Pseudo de musicien doit comporter entre 3 et 30 caractères et commencer par une majuscule';
    }
    if(!preg_match("#^[A-Z]+[a-zA-Z0-9Ã€-Ãº\.:\!\?\&',\s-]{3,150}#", $post['legend'])){    
        $errors[] = 'Votre Pseudo de musicien doit comporter entre 3 et 30 caractères et commencer par une majuscule';
    }

    if(count($error) > 0) {
        $displayErr = true;

        $marque = $post['marque'];
        $model = $post['model'];
        $years = $post['years'];
        $desc = $post['desc'];
        $alt = $post['alt'];
        $legend = $post['legend'];
    }
    else {


        // insertion de la news dans la table "cars"
        $upd = $pdo->prepare('UPDATE cars SET marque = :marque, model = :model, picture = :picture, description = :description, alt = :alt, legend = :legend, years = :years WHERE id = :idCar');

        // On assigne les valeurs associÃ©es au champs de la table (au dessus) aux valeurs du formulaire
        // On passe l'id de l'article pour ne mettre Ã  jour que l'article en cours d'Ã©dition (clause WHERE).

        $upd->bindValue(':idCar',        $idCar,  PDO::PARAM_STR);
        $upd->bindValue(':marque',       $post['marque'],  PDO::PARAM_STR);
        $upd->bindValue(':model',        $post['model'], PDO::PARAM_STR);
        $upd->bindValue(':description',  $post['desc'], PDO::PARAM_STR);
        $upd->bindValue(':alt',          $post['alt'], PDO::PARAM_STR);
        $upd->bindValue(':legend',       $post['legend'], PDO::PARAM_STR);
        $upd->bindValue(':years',        $post['years'], PDO::PARAM_STR);
        $upd->bindValue(':picture',      $dirlink,         PDO::PARAM_STR);
    
        // Vue que la fonction "execute" retourne un booleen on peut si nÃ©cÃ©ssaire le mettre dans un if
        if($upd->execute()) { // execute : retourne un booleen -> true si pas de problÃ¨me, false si souci.
            $formValid    = true;
            // header('Location: list.php');
        }
        else {
            $errorUpdate  = true; // Permettre d'afficher l'erreur
        }

    }
}
include_once 'inc/header_admin.php';
?>

    
<div class="container">
    <div id="page-desc_gallery-wrapper">
            <div class="container-fluid">
        


                <?php if($carExist == false): ?>
                <div clas="col-md-12">   
                <!-- message d'erreur si problÃ¨me url -->
                    <div class="alert alert-danger" role="alert">
                        <i class="fa fa-times fa-2x" aria-hidden="true"></i> Vous devez choisir un véhicule avant de le modifier
                    </div>
                    <a class="btn btn-default btn-md" href="list.php" role="button">Retour liste des véhicules</a>
                </div>
                <?php endif; ?>
                
                <?php if($errorUpdate): ?>
                <div clas="col-md-12">   
                <!-- message d'erreur si problÃ¨me url -->
                    <div class="alert alert-danger" role="alert">
                        <i class="fa fa-times fa-2x" aria-hidden="true"></i> Problème lors de la mise à  jour de votre profil ! <br /> <?php //echo print_r($res->errorInfo()); ?>
                    </div>
                    <a class="btn btn-default btn-md" href="index.php" role="button">Page d'accueil</a>
                </div>
                <?php endif; ?>


                <?php if($displayErr): ?>
                <!-- affichage du tableau d'erreur $error si le formulaire est mal renseignÃ© -->
                <div clas="col-md-12">
                    <div class="alert alert-danger" role="alert">
                        <i class="fa fa-times fa-2x" aria-hidden="true"></i> <?php echo implode('<br> <i class="fa fa-times fa-2x" aria-hidden="true"></i> ', $error); ?>
                    </div>                    
                </div>
                <?php endif; ?>


                <?php if($formValid): ?>
                <!-- message de confirmation aprÃ¨s une modification de news -->
                <div clas="col-md-12">
                    <h1>Modification du véhicule <strong><?php echo $editCar['marque']; ?></strong> effectuée</h1>
                    <div class="alert alert-success" role="alert">
                        <i class="fa fa-check fa-2x" aria-hidden="true"></i> Votre véhicule a bien été modifié.
                    </div>
                    <a class="btn btn-default btn-md" href="list.php" role="button">Retour liste des véhicules</a>
                </div>
                <?php endif; ?>


                <?php if($carExist == true): ?>
                <div class="row">
                    <div class="col-md-12">
                    <h1>Edition du véhicule : <strong><?= $carMarque .' '. $carModel ?></strong></h1>

                        <form class="form-horizontal" method="POST" enctype="multipart/form-data">
                            <fieldset>
                                <legend>Tout les champs sont obligatoire</legend>
                                <div class="row">
                                    <div class="col-md-4">
                                         <div class="form-group">
                                            <label for="marque">Marque</label>
                                            <input type="text" class="form-control" id="marque" name="marque" value="<?= $carMarque ?>">
                                            <small id="emailHelp" class="form-text text-muted">Uniquement la marque du véhicule.</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="model">Model</label>
                                            <input type="text" class="form-control" id="model" name="model" value="<?= $carModel ?>">
                                            <small id="emailHelp" class="form-text text-muted">Uniquement le model du véhicule.</small>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="years">Année</label>
                                            <select class="form-control" id="model" name='years'>
                                              <?php
                                              //On boucle sur les 12 mois de l'année
                                              for ($i = 1920; $i < 2000; $i++)
                                              {
                                                echo '<option value=\'' . $i . '\'>' . $i . '</option>';
                                              }
                                              ?>
                                            </select>
                                            <small id="emailHelp" class="form-text text-muted">Uniquement le model du véhicule.</small>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea type="textarea" class="form-control" id="description" name="desc" rows="5"><?= $carDescription ?></textarea>
                                            <small id="emailHelp" class="form-text text-muted">Une jolie description du véhciule.</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                         <label for="exampleInputEmail1">Image</label>
                                        <div class="form-group mb-3">
                                            <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $maxSize; ?>">
                                            <input type="file" name="picture" class="" id="inputGroupFile01">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="alt">Message Alternatif</label>
                                            <input type="text" class="form-control" id="alt" name="alt" value="<?= $carAlt ?>">
                                            <small id="emailHelp" class="form-text text-muted">Le message alternatif est utilisé pour le référencement et les mals voyants</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="legend">Legende d'image</label>
                                            <input type="text" class="form-control" id="legend" name="legend" value="<?= $carLegend ?>">
                                            <small id="emailHelp" class="form-text text-muted">La legende apparaitra sous l'image, elle sera un complément textuel</small>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="hidden" name="id" value="<?php echo $editCar['id']; ?>">
                                        <button type="submit" id="singlebutton" class="btn btn-info">Modifier le véhicule</button>
                                        <a href="list.php" class="btn btn-success">Ne rien changer et retourner à  la liste des véhicules</a>
                                    </div>
                                </div>
                                    </div>
                            </fieldset>
                        </form>

                    </div>
                </div><!--row-->
            <?php endif; ?>

            </div><!--.container-fluid-->
        </div><!--#page-desc_gallery-wrapper-->

    </div><!--#wrapper // start in sidebar.php -->
<?php include_once 'inc/footer_admin.php'; ?>