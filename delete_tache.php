<?php
session_start();
include_once('connexion_base.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['envoi_tache_delete'])) {

        if (empty($_POST['index_a_supprimer'])) {

            $_SESSION['erreur_index_vide'] = "la tache n'a pas pu etre supprimer";
            header('location:detail_tache.php');
            exit();
        } else {
            $index_a_supprimer = intval($_POST['index_a_supprimer']);
            global $connection;

            if ($connection) {
                $recup = $connection->prepare("UPDATE taches SET is_deleted = true WHERE tache_id = ?");
                $recup->bindParam(1, $index_a_supprimer, PDO::PARAM_INT);

                $recup->execute();
                header('location: gestion_tache.php');
                exit();
                // $tableauPriorites = $recup->fetchAll(PDO::FETCH_ASSOC);
                // var_dump($tableauPriorites);
                // die();
            } else {
                echo "Error : la connexion n'est pas passée";
                //die();
            }
        }
    } else {
        echo "Error : l'envoi ne s'est pas éffectué";
    }
}
