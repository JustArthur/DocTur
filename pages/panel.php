<?php 

    include_once('../include.php');

    if(!isset($_SESSION['utilisateur'][0])) {
        header('Location: ../index.php');
        exit;
    }

?>

<!DOCTYPE html>
<html lang="fr">
<head>

    <?php require_once('../include/link.php') ?>

    <link rel="stylesheet" href="../css/panel.css">
    <link rel="stylesheet" href="../css/sidebar.css">

    <title>Bienvenue, </title>
</head>
<body>

    <aside>
        <div class="titre">
            <h1>Doc<span class="degrade">Tur</span></h1>
        </div>
        <ul class="list">
            <li class="list-item"><a href="#">Accueil</a></li>
            <li class="list-item"><a href="#">Favoris</a></li>
            <li class="list-item"><a href="#">Profil</a></li>
            <li class="list-item"><a href="#">Paramètres</a></li>
            <li class="list-item"><a href="#">Déconnexion</a></li>
        </ul>
    </aside> 
    
</body>
</html>