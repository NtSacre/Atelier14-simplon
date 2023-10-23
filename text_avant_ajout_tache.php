<?php
session_start();
include_once("mes_fonction.php");
// echo 'ça arrive';
// die();
// on s'assure que la methode utilisée est bien le $_POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // verifie si les données existent
    if (isset($_POST['envoi_ajout_tache']) && isset($_POST['user_id']) && isset($_POST['titre']) && isset($_POST['priorite']) && isset($_POST['statut']) && isset($_POST['description']) && isset($_POST['date_echeance'])) {
        // verifie si les données  ne sont pas vide ;
        if (empty($_POST['user_id']) || empty($_POST['titre']) || empty($_POST['priorite']) || empty($_POST['statut']) || empty($_POST['description']) || empty($_POST['date_echeance'])) {



            $_SESSION['error_champs_vide'] = "les champs ne doit pas etre vide";
            header('Location: gestion_tache.php');
            exit();
        } else {
            // echo 'ça arrive dans le else ';
            // die();
            $titre = htmlspecialchars($_POST['titre']);
            $description = htmlspecialchars($_POST['description']);
            $statut_id = intval($_POST['statut']);
            $priorite_id = intval($_POST['priorite']);
            $user_id = intval($_POST['user_id']);
            if (verification_date_echeance($_POST['date_echeance']) === 0) {
                $_SESSION['date_echeance'] = "la date d'échance doit etre superieur ou egale à celle d'aujourd'hui";
                header('location: gestion_tache.php');
                exit();
            }
            // echo 'ça arrive après la condition de la date ';
            // die();
            $date_echeance = $_POST["date_echeance"];
            $is_deleted = "false";

            global $connection;
            if ($connection) {

                try {
                    $req = $connection->prepare("INSERT INTO taches(users_id,priorite_id,status_id,titre,description,date_echeance,is_deleted) VALUES(?,?,?,?,?,?,?)");
                    $req->bindParam(1, $user_id, PDO::PARAM_INT);
                    $req->bindParam(2, $priorite_id, PDO::PARAM_INT);
                    $req->bindParam(3, $statut_id, PDO::PARAM_INT);
                    $req->bindParam(4, $titre, PDO::PARAM_STR);
                    $req->bindParam(5, $description, PDO::PARAM_STR);
                    $req->bindParam(6, $date_echeance, PDO::PARAM_STR);
                    $req->bindParam(7, $is_deleted, PDO::PARAM_STR);

                    $req->execute();
                    $req->closeCursor();
                    // $_SESSION['nom_prenom'] =  $nom;
                    // $_SESSION['user_email'] = $email;
                    header('location: gestion_tache.php');
                    exit();
                } catch (PDOException $th) {
                    echo "Error lors de l'insertion " . $th->getMessage();
                }
            } else {
                echo "la connexion n'est pas passé";
            }
        }
    }
}
