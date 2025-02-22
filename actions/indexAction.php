<?php /*
require('database.php');

if (isset($_POST['submit'])) {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

    $checkUser = $bdd->prepare('SELECT * FROM user WHERE username = ?');
    $checkUser->execute(array($username));
    
        if($checkUser->rowCount() > 0) {
            $userInfo = $checkUser->fetch();
            
            if(password_verify($password, $userInfo['password'])) {
                session_start();
                $_SESSION['auth'] = $userInfo;
                $_SESSION['id'] = $userInfo['id'];
                $_SESSION['firstname'] = $userInfo['first_name'];
                $_SESSION['lastname'] = $userInfo['last_name'];

                header('Location: home.php');
            } else {
                $errorMsg = "Pseudo ou mot de passe invalide !";
            }
        } else {
            $errorMsg = "Pseudo ou mot de passe invalide !";
        }
    } else {
        $errorMsg = "Veuillez remplir tous les champs !";
    }
}*/


require('database.php');

    if (isset($_POST['submit'])) {
        if(isset($_POST["username"], $_POST["password"])
        && !empty($_POST["username"] && !empty($_POST["password"]))) {

        $sql = "SELECT * FROM `user` WHERE `username` = :username";

        $query = $bdd->prepare($sql);

        $query->bindValue(":username", $_POST["username"], PDO::PARAM_STR);

        $query->execute();

        if($query->rowCount() > 0) {
            $user = $query->fetch();
          
            if(password_verify($_POST["password"], $user["password"])) {
                $_SESSION["user"] = [
                    "id" => $user["id"],
                    "firstName" => $user["first_name"],
                    "lastName" => $user["last_name"]
                ];

                header('Location: home.php');
            } else {
                $errorMsg = "Le pseudo et/ou le password est incorrect";
            }
        } else {
            $errorMsg = "Le pseudo et/ou le password est incorrect";
        }
    } else {
        $errorMsg = "Veuillez remplir tous les champs";
    }
}
?>