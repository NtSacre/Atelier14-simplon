<?php
session_start();
//session_unset();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Compte et Connexion</title>
    <link rel="stylesheet" href="embelly.css">
</head>

<body>
    <header>
        <h1>Gestion de Compte et Connexion</h1>
    </header>
    <main>
        <div class="container">
            <div class="form-container">

                <form action="ins_control.php" method="POST">
                    <h2>Créer un Compte</h2>
                    <p style="font-size:18px; color:red" class="message_error"></p>

                    <label for="nom_utilisateur">Nom d'Utilisateur :</label>
                    <input type="text" id="nom_utilisateur" name="nom_utilisateur">
                    <p style="color:red;font-size:15px; margin: 10px 0"><?php if (isset($_SESSION['erreur_str'])) {
                                                                            echo  $_SESSION['erreur_str'];
                                                                            unset($_SESSION['erreur_str']);
                                                                        } ?></p>


                    <label for="adresse_mail">Adresse Mail</label>
                    <input type="text" id="adresse_mail" name="adresse_mail">
                    <p style="color:red;font-size:15px; margin: 10px 0"><?php if (isset($_SESSION['erreur_email'])) {
                                                                            echo  $_SESSION['erreur_email'];
                                                                            unset($_SESSION['erreur_email']);
                                                                        } ?></p>



                    <label for="mot_de_passe">Mot de Passe :</label>
                    <input type="password" id="mot_de_passe" name="mot_de_passe" class="mpd1">
                    <p style="color:red;font-size:15px; margin: 10px 0"><?php if (isset($_SESSION['erreur_password'])) {
                                                                            echo  $_SESSION['erreur_password'];
                                                                            unset($_SESSION['erreur_password']);
                                                                        } ?></p>


                    <label for="confirmation">Confirmation :</label>
                    <input type="password" id="confirmation" name="confirmation_mdp" class="mpd2">
                    <p style="color:red;font-size:15px; margin: 10px 0"><?php if (isset($_SESSION['erreur_password'])) {
                                                                            echo  $_SESSION['erreur_password'];
                                                                            unset($_SESSION['erreur_password']);
                                                                        } ?></p>


                    <button type="submit" name="envoi_inscription">Créer un Compte</button>
                    <p style="color:red;font-size:15px; margin: 10px 0"><?php if (isset($_SESSION['erreur_moyen'])) {
                                                                            echo $_SESSION['erreur_moyen'];
                                                                            unset($_SESSION['erreur_moyen']);
                                                                        }  ?></p>

                </form>
            </div>
            <div class="form-container">

                <form action="con_controlleur.php" method="POST">
                    <h2>Connexion</h2>
                    <label for="connexion_nom_utilisateur">Adresse email :</label>
                    <input type="email" id="connexion_nom_utilisateur" name="connexion_email_utilisateur">
                    <p style="color:red;font-size:15px; margin: 10px 0"><?php if (isset($_SESSION['erreur_email_connexion'])) {
                                                                            echo $_SESSION['erreur_email_connexion'];
                                                                            unset($_SESSION['erreur_email_connexion']);
                                                                        } ?></p>

                    <label for="connexion_mot_de_passe">Mot de Passe :</label>
                    <input type="password" id="connexion_mot_de_passe" name="connexion_mot_de_passe">
                    <p style="color:red;font-size:15px; margin: 10px 0"><?php if (isset($_SESSION['erreur_password_connexion'])) {
                                                                            echo $_SESSION['erreur_password_connexion'];
                                                                            unset($_SESSION['erreur_password_connexion']);
                                                                        } ?></p>

                    <button type="submit" name="envoi_connexion">Se Connecter</button><span style="font-size:20px; margin-left: 99px"> <a href="mot_de_passe_oublier.php"> Mot de passe</a></span>
                    <p style="color:red;font-size:15px; margin: 10px 0"><?php if (isset($_SESSION['email_password_vide'])) {
                                                                            echo $_SESSION['email_password_vide'];
                                                                            unset($_SESSION['email_password_vide']);
                                                                        } ?></p>


                </form>
            </div>
        </div>
    </main>
    <script src="script_mdp.js"></script>

</body>

</html>