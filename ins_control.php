<?php
session_start();
include_once("mes_fonction.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // echo 'il arrie apre post';
    // die();
    if (isset($_POST['envoi_inscription']) && isset($_POST['nom_utilisateur'])  && isset($_POST['adresse_mail'])  && isset($_POST['mot_de_passe'])   && isset($_POST['confirmation_mdp'])) {

        if (empty($_POST['nom_utilisateur']) || empty($_POST['adresse_mail']) || empty($_POST['mot_de_passe']) || empty($_POST['confirmation_mdp'])) {
            $_SESSION['erreur_moyen'] = " Attention : les champs ne doivent pas etre vide";
            header('Location: index.php');
            exit();
        } elseif (!checkstr($_POST['nom_utilisateur'])) {
            $_SESSION['erreur_str'] = "Attention : le nom et le prenom ont un probleme";
            // echo "il arrive au nom et prenom";
            // die();
            header('Location: index.php');
            exit();
        } elseif (!verificationEmail($_POST['adresse_mail'])) {
            $_SESSION['erreur_email'] = " Attention : ton adresse email n'est pas correcte";
            // echo "il arrive à email";
            // die();
            header('Location: index.php');
            exit();
        } elseif (!longpassword($_POST['mot_de_passe']) || !longpassword($_POST['confirmation_mdp'])) {
            $_SESSION['erreur_password'] = " Petit mot de passe là, tu vas l'enregistrer où ! ça doit au moins 8 caractère vraiment c'est pas possible ";
            //echo strlen($_POST['password']);

            header('Location: index.php');
            exit();
        } elseif (verifieMdp($_POST['mot_de_passe'], $_POST['confirmation_mdp']) !== 0) {
            $_SESSION['erreur_password'] = "les mot de passe ne sont pas les memes";
            header('Location: index.php');
            exit();
        } else {


            $nom = $_POST["nom_utilisateur"];

            $email = $_POST['adresse_mail'];
            $password = $_POST['mot_de_passe'];


            if (chechEmailAndTel($email)) {
                $_SESSION['email_telephone'] = " cette adresse mail  existe déjà)";
                header('Location: index.php');
                exit();
            }
            global $connection;
            if ($connection) {

                try {
                    $req = $connection->prepare("INSERT INTO utilisateurs(nom,email,mot_de_passe) VALUES(?,?,?)");
                    $req->bindParam(1, $nom, PDO::PARAM_STR);
                    $req->bindParam(2, $email, PDO::PARAM_STR);
                    $req->bindParam(3, $password, PDO::PARAM_STR);


                    $req->execute();
                    $req->closeCursor();
                    // $_SESSION['nom_prenom'] =  $nom;
                    // $_SESSION['user_email'] = $email;
                    header('location: index.php');
                    exit();
                } catch (PDOException $th) {
                    echo "Error lors de l'insertion " . $th->getMessage();
                }
            } else {
                echo "la connexion n'est pas passé";
            }
        }
    } else {
        $_SESSION['erreur_faible'] = "<script> alert(' Oups ! le formulaire n\'a pas été envoyés.essayez de nouveau') </scrip>";
        echo $_SESSION['erreur_faible'];
        die();
        // header('Location: inscription_v1.php');
        // exit();
    }
}
// } else {
//     $_SESSION['erreur_critique'] = "<script> alert('c\'est pas aujourd\'hui que tu vas me pirater, va apprendre encore Petit Maudia') </scrip>";
//     header('Location: inscription_v1.php');
//     exit();
// }
