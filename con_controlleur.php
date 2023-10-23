<?php
session_start();
include_once("mes_fonction.php");
//include_once("style.css");

// echo "<div class='.container-fluid'>";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['envoi_connexion']) && isset($_POST['connexion_email_utilisateur']) && isset($_POST['connexion_mot_de_passe'])) {
        if (empty($_POST['connexion_email_utilisateur']) || empty($_POST['connexion_mot_de_passe'])) {
            $_SESSION['email_password_vide'] = "les champs ne doivent pas etre vide";
            header("Location: index.php");
            exit();
        }
        $email = verificationEmail($_POST['connexion_email_utilisateur']) ? $_POST['connexion_email_utilisateur'] : false;
        // header('Location: conform.php');
        // exit();
        if ($email != false) {
            global $connection;
            if ($connection) {
                $req = $connection->prepare("SELECT * FROM utilisateurs WHERE email= ?");
                $req->bindParam(1, $email, PDO::PARAM_STR);
                // echo "avant";
                // var_dump($req);
                // echo "apres";
                $req->execute();

                // echo 'apres exécution <br /><br />';

                // var_dump($req);

                $users = $req->fetch(PDO::FETCH_ASSOC);
                // var_dump($users);
                // die();
                if ($users == false) {
                    $_SESSION['erreur_email_connexion'] = "adresse mail n'existe pas va t'inscrire d'abord";
                    header('Location: index.php');
                    exit();
                }
                // var_dump($users);
                $mot_de_passe = longpassword($_POST['connexion_mot_de_passe']) ? $_POST['connexion_mot_de_passe'] : false;
                if ($mot_de_passe == false) {
                    $_SESSION['erreur_password_connexion'] = " mot de passe incorrecte au moins 8 caractères";
                    header('Location: index.php');
                    exit();
                }
                // echo "<br /><br /><br /><br />";
                // var_dump($mot_de_passe);
                // die();

                if ($email == $users["email"] && $mot_de_passe == $users["mot_de_passe"]) {
                    $_SESSION['user_email'] = $users['email'];
                    // echo $_SESSION['email_connexion'];
                    // die();
                    header('Location: gestion_tache.php');
                    exit();
                } else {
                    $_SESSION['erreur_password_connexion'] = " ce mot de passe n'existe pas";

                    header('Location: index.php');
                    exit();
                }
            }
        } else {
            $_SESSION['erreur_email_connexion'] = " Oups ! adresse email incorrecte Ex: exemple@gmail.com ";
            header('Location: conform.php');
            exit();
        }
    }
}
