<?php
    error_reporting(E_ALL);
	ini_set("display_errors", 1);
    include_once('include.php');

    if(isset($_SESSION['utilisateur'][0])) {
        header('Location: pages/panel.php');
        exit;
    }


    if(!empty($_POST)) {
        extract($_POST);
        if(isset($_POST['connexion'])) {
            [$erreur] = $_CONNEXION->connexion_user($identifiant, $password);
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>

    <?php require_once('include/link.php') ?>

    <link rel="stylesheet" href="css/formulaire.css">
    <link rel="stylesheet" href="css/notification.css">

    <title>Connexion à DocTur</title>

</head>

    <body>
        <div class="left">
            <h1 class="logo">DOC<span>TUR</span></h1>
            <form method="POST">
                <h1>Bon retour parmi nous ! 👋</h1>
                <p>Renseignez vos informations pour continuer sur le site.</p>
                <label for="identifiant">Votre identifiant</label>

                <?php if(isset($erreur)) { echo $erreur; } ?>
                <input type="text" name="identifiant" id="identifiant" maxlength="20">

                <label for="password">Votre mot de passe</label>
                <div class="div-input">
                    <input type="password" name="password" id="password" maxlength="32">
                    <span class="material-icons-outlined" onclick='toggle()'>visibility</span>
                </div>
                <a href="register.php">J'ai oublié mon mot de passe</a>

                <input type="submit" name="connexion" value="Se connecter">

                <p class="account">Je n'ai pas de compte ? <a href="register.php">S'inscrire</a></p>
            </form>
        </div>
        <div class="right">
            <div class="desc">
                <div class="slogan">
                    <div class="slog-item">
                        <svg class="play-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M73 39c-14.8-9.1-33.4-9.4-48.5-.9S0 62.6 0 80V432c0 17.4 9.4 33.4 24.5 41.9s33.7 8.1 48.5-.9L361 297c14.3-8.7 23-24.2 23-41s-8.7-32.2-23-41L73 39z"/></svg>
                        <h1>La plateforme</h1>
                    </div>
                    <div class="slog-item"><h1>de stockage</h1></div>
                    <div class="slog-item"><h1><span>en ligne.</span></h1></div>
                    
                </div>
            </div>
        </div>

        <script src="./js/password.js"></script>
        
    </body>

</html>