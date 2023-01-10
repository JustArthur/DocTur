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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0" />

    <title>Bienvenue, </title>
</head>
<body>

    <aside>
        <div class="titre">
            <h1>Doc<span class="degrade">Tur</span></h1>
        </div>
        <ul class="list">
            <li class="list-item">
                <a href="#">
                    <div class="icon">
                        <span class="material-symbols-rounded">dashboard</span>
                    </div>
                    <div class="lien">
                        <p>Accueil</p>
                    </div>
                </a>
            </li>
            <li class="list-item">
                <a href="#">
                    <div class="icon">
                        <span class="material-symbols-rounded">star</span>
                    </div>
                    <div class="lien">
                        <p>Favoris</p>
                    </div>
                </a>
            </li>
            <li class="list-item">
                <a href="#">
                    <div class="icon">
                        <span class="material-symbols-rounded">person</span>
                    </div>
                    <div class="lien">
                        <p>Profil</p>
                    </div>
                </a>
            </li>
            <li class="list-item">
                <a href="#">
                    <div class="icon">
                        <span class="material-symbols-rounded">settings</span>
                    </div>
                    <div class="lien">
                        <p>Paramètres</p>
                    </div>
                </a>
            </li>
            <li class="list-item btn-deco">
                <a href="#">
                    <div class="icon">
                        <span class="material-symbols-rounded">logout</span>
                    </div>
                    <div class="lien">
                        <p>Déconnexion</p>
                    </div>
                </a>
            </li>
        </ul>
    </aside> 
    
</body>
</html>