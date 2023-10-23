<?php
session_start();







?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot-de-oublier.php</title>
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
            padding: 10px;
            margin: 10% auto;
            max-width: 450px;
            height: 400px;
        }

        h1 {
            font-size: 34px;
        }

        label {
            font-size: 30px;
        }

        input {
            width: 350px;
            padding: 20px;
            margin: 15px auto;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
        }



        .formulaire_meme {
            max-width: 350px;
            padding: 10px;
            margin: 10px auto;
        }

        button {
            background-color: #4caf50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 800;
        }
    </style>
</head>

<body>
    <header>
        <h1>Modifer votre mot de passe</h1>
    </header>
    <main>
        <div class="task-container">

            <form action="check_new_mdp.php" method="POST" class="formulaire_meme">
                <label for=""> votre adresse email</label>
                <input type="email" name="email" id="">
                <label for="">nouveau mot de passe </label>
                <input type="password" name="new_mdp">
                <button type="submit" name="modifier_mdp">Modifer</button>
            </form>

        </div>


    </main>


</body>

</html>