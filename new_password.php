<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    include_once('include.php');

    // if(empty($_GET['token'])) {
    //     header('Location: index.php');
    //     exit();
    // }

    // if($_GET['token'] != $_SESSION['user_token']) {
    //     header('Location: index.php');
    //     exit();
    // }

    if(!empty($_POST)) {
        extract($_POST);
        if(isset($_POST['new_password'])) {

            function getUserByToken($token) {
                $DBB = new connexionDB();
                $DB = $DBB->DB();
        
                $sql = $DB->prepare('SELECT reset_token, user_id, email, password FROM users WHERE reset_token = ?');
                $sql->execute([$token]);
        
                return $sql;
            }
        
            function changePassword($crypt_password, $userId) {
                $DBB = new connexionDB();
                $DB = $DBB->DB();
        
                $sql = $DB->prepare('UPDATE users SET password = ?, reset_token = "" WHERE user_id = ?');
                $sql->execute([$crypt_password, $userId]);
                
                return $sql;
            }

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
    
                        header('Location: index.php');
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

    <?php require_once('include/link.php') ?>

    <link rel="stylesheet" href="css/formulaire.css">
    <link rel="stylesheet" href="css/notification.css">
    <link rel="shortcut icon" href="./images/public/DT.png" type="image/x-icon">
    <title>Changement du mot de passe</title>

</head>
<body>
    <div class="left">
        <h1 class="logo">DOC<span>TUR</span></h1>
        <form method="post">
            <h1 class="titre">Rénitialiser mon mot de passe</h1>
            <p class="description">Renseignez votre nouveau mot de passe.</p>

            <?php if(isset($erreur)) { echo $erreur; } ?>

            <label for="password">Mot de passe</label>
            <input required type="password" id="password" name="password" placeholder="Entrez votre mot de passe">

            <label for="conf_password">Confirmer le mot de passe</label>
            <input required type="password" id="conf_password" name="conf_password" placeholder="Entrez de nouveau votre mot de passe">

            <input type="submit" name="new_password" value="Modifier mon mot de passe">

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