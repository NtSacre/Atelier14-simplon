<?php
try {
    $connection = new PDO("mysql:host=localhost;dbname=gestion_des_taches", 'root', '');
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "je me suis connecté";
} catch (PDOException $th) {
    echo "Erreur: " . $th->getMessage();
}
