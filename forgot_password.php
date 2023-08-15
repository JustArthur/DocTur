<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    include_once('include.php');

    function generateToken($length = 100) {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $randomString = '';

        $maxIndex = strlen($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $randomIndex = random_int(0, $maxIndex);
            $randomString .= $characters[$randomIndex];
        }

        return $randomString;
    }

    function getUserEmailByEmail($email) {
        $DBB = new connexionDB();
        $DB = $DBB->DB();

        $email = htmlspecialchars($email, ENT_QUOTES);

        $sql = $DB->prepare('SELECT email FROM utilisateurs WHERE email = ?');
        $sql->execute([$email]);

        return $sql;
    }

    function setUserToken($token, $email) {
        $DBB = new connexionDB();
        $DB = $DBB->DB();
        
        $sql = $DB->prepare('UPDATE utilisateurs set token = ? WHERE email = ?');
        $sql->execute([$token, $email]);

        return $sql;
    }

    function sendMail($to, $subject, $message, $headers) {
        mail($to, $subject, $message, $headers);
    }

    $_SESSION['user_token'] = generateToken();

    if(!empty($_POST)) {
        extract($_POST);
        if(isset($_POST['send_mail'])) {

            $select_mail = getUserEmailByEmail($email);
            $select_mail = $select_mail->fetch();

            setUserToken($_SESSION['user_token'], $email);

            if(isset($select_mail['email'])) {

                $subject = 'Changer le mot de passe de votre compte DocTur';
                $message = 'Bonjour, vous avez fait une demande pour changer votre mot de passe, merci de cliquer sur ce lien : "http://127.0.0.1/DocTur/new_password.php?token='. $_SESSION['user_token'];
    
                $headers = "Content-Type: text/plain; charset=utf-8\r\n";
                $headers .= "From: wayzzy59@gmail.com\r\n";

                if(sendMail($email, $subject, $message, $headers)) {
                    $erreur = "Le mail à bien été envoyé à l'adresse " . $email;
                } else {
                    $erreur = "Impossible d'envoyé le mail.";
                }
            }
        }

        exit();
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>

    <?php require_once('include/link.php') ?>

    <link rel="stylesheet" href="css/formulaire.css">
    <link rel="stylesheet" href="css/notification.css">
    <link rel="shortcut icon" href="./images/public/DT.png" type="image/x-icon">

    <title>Mot de passe oublié</title>

</head>
<body>
    <div class="left">
        <h1 class="logo">DOC<span>TUR</span></h1>
        <form method="post">

            <h1 class="titre">Mot de passe oublié ?</h2>
            <p class="description">Pas de soucis un mail vous sera envoyé pour la rénitialisation de votre mot de passe.</p>

            <?php if(isset($erreur)) { echo $erreur; } ?>

            <label for="email">Adresse mail</label>
            <input required type="email" id="mail" name="email" placeholder="Entrez votre adresse mail">

            <input type="submit" name="send_mail" value="Envoyer le mail">

            <p class="account">Je me souviens de mon mot de passe. <a href="index.php">Se connecter</a></p>
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
</body>
</html>