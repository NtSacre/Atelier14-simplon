<?php
include_once("connexion_base.php");


function verificationEmail($email)
{
    $expressionReguliere = '/^(([^<>()\[\]\.,;:\s@"]+(\.[^<>()\[\]\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/';

    return preg_match($expressionReguliere, $email);
}
//echo verificationEmail("a@a%.com");

function checkstr($str)
{
    $regex = '/^[a-zA-Z\sà-ÿÀ-Ÿ\'-]*$/u';
    return  preg_match($regex, $str);
}
//echo checkstr();
function checkphone($tel)
{
    // if (is_numeric($tel) && strlen($tel)) {
    $reg = '/^7([0]|[8]|[6]|[7])+[0-9]{7}$/';
    return  preg_match($reg, $tel);
    // } else {
    //     return "le numero doit etre de ce format 771115869";
    // }
}
function longpassword($password)
{
    return strlen($password) >= 8 ? true : false;
}

function chechEmailAndTel($email)
{
    global $connection;

    if ($connection) {
        $recup = $connection->prepare("SELECT * FROM utilisateurs");

        $recup->execute();

        $tableauUsers = $recup->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($tableauUsers[0]['users_id']);
        // die();
        $bol = false;
        foreach ($tableauUsers as $tableau) {
            if ($tableau['email'] == $email) {
                $bol = true;
                //echo "Email trouvée ";
                break;
            }
            return $bol;
        }
    }
}
//echo "ça marche passe ici";
//echo chechEmailAndTel("email");

function AfficheUtilsateur($email)
{
    global $connection;

    if ($connection) {
        $recup = $connection->prepare("SELECT * FROM utilisateurs Where email = ?");
        $recup->bindParam(1, $email, PDO::PARAM_STR);
        $recup->execute();

        $tableauUsers = $recup->fetchAll(PDO::FETCH_ASSOC);
        foreach ($tableauUsers as $tableau) {
            if ($tableau['email'] == $email) {
                // var_dump($tableau['users_id'], $tableau['nom']);
                // die();
                return [
                    "user_id" => $tableau['users_id'],
                    "nom" => $tableau['nom'],

                ];
            }
        }
        // var_dump($tableauUsers[]['users_id']);
        // foreach ($tableauUsers as $user) {
        //     echo $user['users_id'];
        // }
    }
}

//var_dump(AfficheUtilsateur("JeanDoe@gmail.com"));

function AfficheTaches()
{
    global $connection;

    if ($connection) {
        $recup = $connection->prepare("SELECT t.tache_id, t.titre, t.description, t.date_echeance, t.is_deleted,
       u.users_id ,
        u.nom AS nom_utilisateur,
        p.nom_priorite AS nom_priorite,
        s.nom_status AS nom_statut
 FROM taches t
 LEFT JOIN utilisateurs u ON t.users_id = u.users_id
 LEFT JOIN priorite p ON t.priorite_id = p.priorite_id
 LEFT JOIN status s ON t.status_id = s.status_id;");

        $recup->execute();

        $tableautaches = $recup->fetchAll(PDO::FETCH_ASSOC);
        return $tableautaches;
        // var_dump($tableautaches);
        // die();
        // foreach ($tableautaches as $tache) {
        //     echo $tache['tache_id'];
        // }
    }
}

function AffichePriorites()
{
    global $connection;

    if ($connection) {
        $recup = $connection->prepare("SELECT * FROM priorite");

        $recup->execute();

        $tableauPriorites = $recup->fetchAll(PDO::FETCH_ASSOC);
        return $tableauPriorites;
        // var_dump($tableauPriorites);
        // die();
        // foreach ($tableauPriorites as $priorite) {
        //     echo $priorite['priorite_id'];
        // }
    }
}
//AffichePriorites();
function AfficheStatus()
{
    global $connection;

    if ($connection) {
        $recup = $connection->prepare("SELECT * FROM status");

        $recup->execute();

        $tableauStatus = $recup->fetchAll(PDO::FETCH_ASSOC);
        return $tableauStatus;
        // var_dump($tableauStatus);
        // die();
        // foreach ($tableauStatus as $statut) {
        //     echo $statut['status_id'];
        // }
    }
}
//AfficheStatus();

function verifieMdp($tr1, $tr2)
{
    return strcmp($tr1, $tr2);
}

// if (is_array($tableauStatus = AfficheStatus())) {
//     echo "c'est un tableau";
// } else {
//     echo "c'est pas un tableau";
// }
//print_r(is_array($tableauStatus = AfficheStatus()) ? $tableauStatus : "c'est pas un tableau");
//echo is_array(AfficheStatus()) ? true : false;
// $tableau_de_Priorite = is_array(AfficheStatus()) ? AfficheStatus() : false;
// var_dump($tableau_de_Priorite);
//echo strip_tags("<p> echo $tableau_de_Prior> <span class=\>");


function verification_date_echeance($date_echeance)
{
    $date_echeance_obj = DateTime::createFromFormat("Y-m-d", $date_echeance);
    $date_actuelle_obj = new DateTime();

    return $date_echeance_obj >= $date_actuelle_obj ? 1 : 0;
}
//echo verification_date_echeance("2024-12-16");
