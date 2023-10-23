<?php
session_start();



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['voir_plus']) && isset($_POST['index_tache'])) {


        if (empty($_POST['index_tache'])) {

            $_SESSION['donnees_voir_plus_vide'] = " une erreur c'est produite l'hors de l'envoie de cette tache";
            header('location: gestion_tache.php');
            exit();
        } else {
            $_SESSION['index_tache'] = intval($_POST['index_tache']);
            header('location: detail_tache.php');
            exit();
        }
    }
}
