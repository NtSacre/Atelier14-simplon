<?php
session_start();
include_once("mes_fonction.php");
if (!isset($_SESSION['user_email'])) {
  header('location: index.php');
}
$tableau_de_Status = is_array(AfficheStatus()) ? AfficheStatus() : false;
$tableau_de_Priorite = is_array(AffichePriorites()) ? AffichePriorites() : false;
//var_dump(AfficheUtilsateur("rogerPolo@gmail.com"));
$tableau_d_user = is_array(AfficheUtilsateur($_SESSION['user_email'])) ? AfficheUtilsateur($_SESSION['user_email']) : false;
// var_dump($tableau_d_user);
// die();

$ensemble_toute_tache = is_array(AfficheTaches()) ? AfficheTaches() : false;
// var_dump($ensemble_toute_tache);
// die();
$tableau_d_tache = [];
foreach ($ensemble_toute_tache as $tableau) {
  if (($tableau['is_deleted'] == 0) && $tableau_d_user["user_id"] == $tableau['users_id']) {
    $tableau_d_tache[] = $tableau;
  }
}
// var_dump($tableau_d_tache);
// die();

// var_dump($tableau_d_tache);
// var_dump($tableau_d_tache[0]['is_deleted']);

// die();

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
      width: 100%;
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

    .formulaire_meme {
      max-width: 700px;
    }

    button {
      background-color: #4caf50;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
      font-weight: 600;
    }
  </style>
</head>

<body>
  <header>
    <h1>Gestion de Mes Tâches</h1>
    <?php if ($tableau_d_user != false) : ?>
      <h3><?= $tableau_d_user['nom'] ?></h3>

    <?php endif; ?>

  </header>
  <main>
    <div style="margin: 10px auto; overflow-y: scroll; height: 325px; width: 710px;">
      <?php if (count($tableau_d_tache) > 0) : ?>
        <?php foreach ($tableau_d_tache as $val) : ?>

          <div class="task-container">

            <h2><?= $val['titre'] ?></h2>
            <p>
              <?= $val['description'] ?>
            </p>

            <p style="margin-top: 35px">
              <span style="color: red; font-weight: bold">Priorité: <?= $val['nom_priorite'] ?></span>
              <span style="color: green; font-weight: bold; margin-left: 15px">Statut:<?= $val['nom_statut'] ?></span>
              <span style="color: green; font-weight: bold; margin-left: 15px">Date d'échance : <?= $val['date_echeance'] ?></span>

            <form action="validation_avant_voir_plus.php" method="POST">
              <input type="hidden" name="index_tache" value="<?= $val["tache_id"] ?>" id="index_tache">
              <button type="submit" name="voir_plus" style="margin-left: 15px">Voir les Détails</button>


            </form>
            </p>

            <p style="color:red;font-size:15px; margin: 10px 0"><?= isset($_SESSION['donnees_voir_plus_vide']) ? $_SESSION['donnees_voir_plus_vide'] : '' ?></p>
          </div>



        <?php endforeach; ?>
      <?php else : ?>
        <div class="task-container">
          <h2 style="text-align: center; margin: 10px auto"> Aucune activités enregistrées</h2>
        </div>

      <?php endif; ?>
    </div>
    <div class="formulaire_ajout">
      <form class="formulaire_meme" action="text_avant_ajout_tache.php" method="POST">
        <h2>Ajouter une Nouvelle Tâche</h2>
        <?php if ($tableau_d_user != false) : ?>
          <input type="hidden" name="user_id" value="<?= $tableau_d_user['user_id'] ?>">

        <?php endif; ?>
        <label for="titre">Titre</label>
        <input type="text" id="titre" name="titre" />

        <label for="priorite">Priorité</label>

        <?php if ($tableau_de_Priorite != false) : ?>

          <select id="priorite" name="priorite">
            <?php foreach ($tableau_de_Priorite as  $val) : ?>
              <option value="<?= $val['priorite_id'] ?>"><?= $val['nom_priorite'] ?></option>
            <?php endforeach; ?>
          </select>

        <?php endif; ?>


        <label for="statut">Statut</label>
        <?php if ($tableau_de_Status != false) : ?>
          <select id="statut" name="statut">
            <?php foreach ($tableau_de_Status as  $val) : ?>

              <option value="<?= $val['status_id'] ?>"><?= $val['nom_status'] ?></option>
            <?php endforeach; ?>

          </select>
        <?php endif; ?>

        <label for="description">Description</label>
        <textarea id="description" name="description" rows="4"></textarea>

        <label for="description">Date d'écheance</label>
        <input type="date" id="date" name="date_echeance">
        <p style="color:red;font-size:15px; margin: 10px 0"><?= isset($_SESSION['date_echeance']) ?  $_SESSION['date_echeance'] : '' ?></p>

        <button type="submit" name="envoi_ajout_tache">Ajouter</button>
        <p style="color:red;font-size:15px; margin: 10px 0"><?= isset($_SESSION['error_champs_vide']) ? $_SESSION['error_champs_vide'] : '' ?></p>

      </form>

    </div>
  </main>
</body>

</html>