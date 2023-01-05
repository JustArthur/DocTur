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
                <h1>Bon retour parmi nous ! 👋</h1>
                <p>Renseignez vos informations pour continuer sur le site.</p>
                <label for="identifiant">Votre identifiant</label>
                <input type="text" name="identifiant" id="identifiant" maxlength="20">

                <label for="password">Votre mot de passe</label>
                <input type="password" name="password" id="password" maxlength="32">
                <a href="#">J’ai oublié mon mot de passe</a>

                <input type="submit" name="connexion" value="Se connecter">

                <p>Vous n'avez pas de compte ? <a href="register.php">S'inscrire</a></p>
            </form>
        </div>
        <div class="right">
            <div class="desc">
                <div class="slogan">
                    <svg class="play-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M73 39c-14.8-9.1-33.4-9.4-48.5-.9S0 62.6 0 80V432c0 17.4 9.4 33.4 24.5 41.9s33.7 8.1 48.5-.9L361 297c14.3-8.7 23-24.2 23-41s-8.7-32.2-23-41L73 39z"/></svg>
                    <h1>La plateforme<br> de stockage<br> <span>en ligne.</span></h1>
                </div>
            </div>
        </div>
        
    </body>

</html>