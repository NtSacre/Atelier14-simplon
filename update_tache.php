<?php
session_start();
include_once('connexion_base.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['envoi_update_tache'])) {

        if (empty($_POST['index_a_modifier'])) {

            $_SESSION['erreur_index_vide'] = "la tache n'a pas pu etre statuer";
            header('location:detail_tache.php');
            exit();
        } else {
            $index_a_modifier = intval($_POST['index_a_modifier']);
            global $connection;

            if ($connection) {
                $recup = $connection->prepare("UPDATE taches AS t
                JOIN status AS s ON t.status_id = s.status_id
                SET t.status_id = (
                    SELECT status_id
                    FROM status
                    WHERE nom_status = 'Terminée'
                )
                WHERE t.tache_id = ?");
                $recup->bindParam(1, $index_a_modifier, PDO::PARAM_INT);

                $recup->execute();
                header('location: detail_tache.php');
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
