<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    include_once('../../include.php');

    if(empty($_GET['token'])) {
        header('Location: ' . ROOT_PATH);
        exit();
    }

    if($_GET['token'] != $_SESSION['user_token']) {
        header('Location: ' . ROOT_PATH);
        exit();
    }

    if(!empty($_POST)) {
        extract($_POST);
        if(isset($_POST['new_password'])) {

            $valid = true;

            $user_info = getUserByToken($_SESSION['user_token']);
            $user_info = $user_info->fetch();

            if($user_info['reset_token'] == $_GET['token']) {
                if($user_info['reset_token'] == $_SESSION['user_token']) {
                    
                    $weakPasswords = ['password', '123456', 'qwerty', 'abc123', 'letmein', 'admin', 'welcome', '123456789', 'password123', 'iloveyou', 'sunshine', '1234567', '12345678', '1234567890', 'qwertyuiop', 'asdfghjkl', 'zxcvbnm', 'qwerty123', '987654321', 'passw0rd', 'football', 'baseball', 'soccer', 'monkey', '123123', 'hello', 'superman', 'qazwsx', 'michael', 'login', 'abc123', '1q2w3e4r', 'qwertyuiop', 'passw0rd', 'starwars', 'password1', '123qwe', '123456a', '1qaz2wsx', 'trustno1', 'princess', 'sunshine', 'password123', '123abc', 'welcome', 'admin', 'letmein', '123456789', 'football', 'iloveyou', '12345', 'qwerty123', '1234567', '12345678', 'qwerty12345', 'dragon', '1234', 'baseball', 'monkey', 'abcde', 'password!', '123', '1234567890', 'qazwsxedc', 'admin123', 'pass', '123456789a', 'qwertyu', '111111', '123abc!', '123456789!', 'a123456', 'letmein1', '000000', 'test', 'pass123', '123qwe!', '1234qwer', '987654321', '123123', 'qwe123', 'google', 'password!', 'internet', '12345qwert', 'qwerty123!', 'abcd1234', 'changeme', 'computer', 'password12', 'qwertyuio', '999999', 'zxcvbn', 'password1234', '123qweasd', 'q1w2e3r4t5', 'passw0rd1', 'sunshine1', 'qwe123!', 'admin1234', 'password!', 'password123!', 'qazwsx123', 'zaq1zaq1', 'zaqwsx', 'qweasdzxc', 'asdf1234', 'welcome1', 'qweasdzxc!'];              

                    foreach($weakPasswords as $faiblePassword) {
                        if($faiblePassword == $password) {
                            $valid = false;
                            $erreur = 'Le mot de passe est trop faible. Choisissez-en un autre';
                        }
                    }
    
                    if($password != $conf_password) {
                        $valid = false;
                        $erreur = 'Les mots de passe de sont pas identiques';
                    }
    
                    if(password_verify($password, $user_info['password'])) {
                        $valid = false;
                        $erreur = 'Merci de choisir un mot de passe différent de celui actuel';
                    }
    
                    if($valid) {
                        $crypt_password = password_hash($password, PASSWORD_BCRYPT);
    
                        changePassword($crypt_password, $user_info['user_id']);
        
                        $subject = 'Changement de votre mot de passe de votre compte ConnectEvent';
                        $message = 'Bonjour, votre mot de passe à bien été changé';
            
                        $headers = "Content-Type: text/plain; charset=utf-8\r\n";
                        $headers .= "From: maxxxozou@gmail.com\r\n";
        
                        sendMail($user_info['email'], $subject, $message, $headers);
    
                        header('Location: ' . ROOT_PATH);
                        exit();
                    }
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../styles/login_register.css">
    <title>Changement du mot de passe</title>
</head>
<body>
    <div class="left-container">
        <div class="container">

            <h3 class="logo">Connect<span class="bleu">Event</span></h3>

            <div class="textes">
                <h2 class="titre">Rénitialiser mon mot de passe</h2>
                <p class="description">Renseignez votre nouveau mot de passe.</p>
            </div>

            <form method="post" class="formulaire">

                <?php if(isset($erreur)) { ?><div class="erreur"><?= $erreur ?></div> <?php } ?>

                <div class="input-box">
                    <label for="password" class="text-label">Mot de passe</label>
                    <input required type="password" id="password" name="password" class="input" placeholder="Entrez votre mot de passe">
                </div>

                <div class="input-box">
                    <label for="conf_password" class="text-label">Confirmer le mot de passe</label>
                    <input required type="password" id="conf_password" name="conf_password" class="input" placeholder="Entrez de nouveau votre mot de passe">
                </div>

                <input type="submit" name="new_password" value="Modifier mon mot de passe" class="submit-input">

                <p class="info-compte">Je me souviens de mon mot de passe. <a href="../../login">Se connecter</a></p>
            </form>
        </div>
    </div>

    <div class="right-container">
        <img src="<?= ROOT_PATH ?>public/public_img/bg-login-register.jpg">
    </div>
</body>
</html>