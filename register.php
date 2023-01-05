<?php
    error_reporting(E_ALL);
	ini_set("display_errors", 1);
    include_once('include.php');

    if(!empty($_POST)) {
        extract($_POST);
        if(isset($_POST['inscription'])) {
            [$erreur] = $_INSCRIPTION->inscription_user($identifiant, $mail, $password);
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>

    <?php require_once('include/link.php') ?>

    <link rel="stylesheet" href="css/formulaire.css">
    <link rel="stylesheet" href="css/cookie.css">

    <title>Inscription à DocTur</title>
</head>
    <body>
        <div class="left">
            <h1 class="logo">DOC<span>TUR</span></h1>
            <form method="POST">
                <h1>Bienvenue parmi nous ! 👋</h1>
                <p>Renseignez vos informations pour s'inscrire sur le site.</p>
                <label for="identifiant">Votre identifiant</label>
                <div class="div-input">
                    <input type="text" name="identifiant" id="identifiant" maxlength="20">
                    <span class="chiffre chiffre_id">20</span>
                </div>

                <label for="mail">Votre adresse mail</label>
                <div class="div-input">
                    <input type="mail" name="mail" id="mail" maxlength="30">
                    <span class="chiffre chiffre_mail">30</span>
                </div>

                <label for="password">Votre mot de passe</label>
                <div class="div-input">
                    <input type="password" name="password" id="password" maxlength="32">
                    <span class="material-icons-outlined" onclick='toggle()'>visibility</span>
                </div>

                <div class="password-force">
                    <div class="password-pourcent"><span></span></div>
                    <div>Force du mot de passe : <span class="password-label"></span></div>
                </div>

                <input type="submit" name="inscription" value="S'inscrire">

                <p class="account">Vous avez déjà un compte ? <a href="index.php">Se connecter</a></p>
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

        <script src="./js/password.js"></script>
        <script src="./js/valeur_input.js"></script>
    </body>
</html>