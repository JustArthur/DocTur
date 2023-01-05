<?php
    error_reporting(E_ALL);
	ini_set("display_errors", 1);
    include_once('include/include.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>

    <?php require_once('include/link.php') ?>

    <link rel="stylesheet" href="css/formulaire.css">
    <link rel="stylesheet" href="css/cookie.css">

    <title>Connexion à DocTur</title>

</head>

    <body>
        <div class="left">
            <form method="POST">
                <label for="identifiant">Votre identifiant</label>
                <input type="text" name="identifiant" id="identifiant" maxlength="20">

                <label for="password">Votre mot de passe</label>
                <input type="password" name="password" id="password" maxlength="32">

                <input type="submit" value="Se connecter">

                <p>Vous n'avez pas de compte ? <a href="register.php">S'inscrire</a></p>
            </form>
        </div>
        <div class="right">
            aaaa
        </div>
        
    </body>

</html>