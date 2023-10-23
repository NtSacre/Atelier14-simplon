<?php
session_start();
include_once("mes_fonction.php");
$tableau_d_tache = is_array(AfficheTaches()) ? AfficheTaches() : false;
$index_tache = $_SESSION['index_tache'];
$tache_detail;
if ($tableau_d_tache !== false) {
    foreach ($tableau_d_tache as $val) {
        if ($val['tache_id'] == $index_tache) {
            $tache_detail = $val;
            break;
        }
    }
}


?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gestion de Mes Tâches</title>
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #4caf50;
            text-align: center;
            padding: 20px 0;
            color: white;
        }

        main {
            /* background-color: white; */
            padding: 20px;
            /* text-align: center; */
        }

        .task-container {
            background-color: white;
            /* border: 2px solid #4CAF50; */
            padding: 20px;
            margin: 20px auto;
            max-width: 700px;
        }

        h1 {
            font-size: 34px;
        }

        h2 {
            font-size: 22px;
            font-weight: bold;
            margin-top: 35px;
        }

        .priority-label,
        .status-label {
            font-weight: bold;
        }

        select,
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
        }

        input {
            width: 30px;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
        }

        .formulaire_ajout {
            max-width: 710px;
            margin: 10px auto;
        }

        form {
            max-width: 700px;
        }

        .link {
            text-align: center;
            width: 100%;
        }
    </style>
</head>

<body>
    <?php if (is_array($tache_detail)) : ?>
        <header>
            <h1>Detail taches :<?= $tache_detail['titre'] ?> </h1>
            <h2><?= $tache_detail['nom_utilisateur'] ?></h2>
        </header>
        <main>


            <div class="task-container">
                <h2><?= $tache_detail['titre'] ?></h2>
                <p>
                    <?= $tache_detail['description'] ?>
                </p>
                <p style="margin-top: 35px">
                    <span style="color: red; font-weight: bold">Priorité: <?= $tache_detail['nom_priorite'] ?></span>
                    <span style="color: green; font-weight: bold; margin-left: 15px">Statut:<?= $tache_detail['nom_statut'] ?></span>
                    <span style="color: green; font-weight: bold; margin-left: 15px">Date d'échance : <?= $tache_detail['date_echeance'] ?></span>
                </p>
                <div style="margin-top: 35px; display: flex; width: 100%">
                    <?php if ($tache_detail['nom_statut'] != 'Terminée') : ?>
                        <form action="update_tache.php" method="POST">
                            <input type="hidden" name="index_a_modifier" value="<?= $tache_detail['tache_id'] ?>">
                            <button type="submit" name="envoi_update_tache" style=" background-color: #4caf50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;">Marquer comme Terminée
                            </button>
                        </form>
                    <?php endif ?>
                    <form action="delete_tache.php" method="POST">
                        <input type="hidden" name="index_a_supprimer" value="<?= $tache_detail['tache_id'] ?>">

                        <button type="submit" name="envoi_tache_delete" style="  background-color: red;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;margin-left: 15px">Supprimer la tache
                        </button>

                    </form>

                </div>
            </div>

        <?php else : ?>
            <div class="task-container">
                <h2 style="text-align: center; margin: 10px auto"> Aucune tache en vue </h2>

            </div>

        <?php endif; ?>



        <div class="link"><a href="gestion_tache.php">Retour à la liste des taches </a></div>

        </main>
</body>

</html>