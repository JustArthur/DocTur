<?php
    require_once('src/info_user.php');

    
    if(!empty($_POST)) {
        extract($_POST);

        
        
        if(isset($_POST['submit'])) {

            $valid = true;
            $erreur = '';

            $recupDossier = $DB->prepare("SELECT idDossier FROM dossier WHERE idUser = ? AND nomDossier = ? ");
            $recupDossier->execute(array($_SESSION['utilisateur'][0], $nom));
            $recupDossier = $recupDossier->fetch();

            if(isset($recupDossier['idDossier'])) {
                $valid = false;
                $erreur = '
                    <ul class="notifications">
                        <li class="toast error">
                            <div class="column">
                                <span class="material-icons-round icon-notif">error</span>
                                <span class="message-notif">Dossier déjà existant.</span>
                            </div>
                            <span class="material-icons-outlined icon-notif close" onclick="remove()">close</span>
                        </li>
                    </ul>
                    <script>
                        const toast = document.querySelector(".toast");

                        function hideToast() {
                            setTimeout(function() {
                                toast.classList.add("hide")
                            }, 5000);
                        }

                        function remove() {
                            toast.classList.add("hide");
                        }

                        hideToast();
                    </script>';
            } else {
                $valid = true;
            }

            if($valid) {
                $insert_folder = $DB->prepare("INSERT INTO dossier (idUser, nomDossier, sousNomDossier) VALUES(?, ?, ?)");
                $insert_folder->execute(array($_SESSION['utilisateur'][0], $nom, $sous_nom));

                $erreur = '
                    <ul class="notifications">
                        <li class="toast success">
                            <div class="column">
                                <span class="material-icons-round icon-notif">check_circle</span>
                                <span class="message-notif">Dossier créé.</span>
                            </div>
                            <span class="material-icons-outlined icon-notif close" onclick="remove()">close</span>
                        </li>
                    </ul>
                    <script>
                        const toast = document.querySelector(".toast");

                        function hideToast() {
                            setTimeout(function() {
                                toast.classList.add("hide")
                            }, 5000);
                        }

                        function remove() {
                            toast.classList.add("hide");
                        }

                        hideToast();
                    </script>';
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>

    <?php require_once('../include/link.php') ?>

    <link rel="stylesheet" href="../css/panel.css">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="../css/newFolder.css">
    <link rel="stylesheet" href="../css/notification.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0" />

    <title>DocTur</title>
</head>
<body> 

    <?php

        include_once ('src/sidebar.php');

    ?>

    <section class="global">
        <header>
            <form class="search" action="" method="post">
                <div class="div_input">
                    <input type="search" name="search" placeholder="Rechercher un fichier ou un dossier ..." class="barre">
                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                    </svg>
                    <input type="submit" value="↵" class="btn-search">
                </div>
            </form>

            <div class="avatar">
                <a href="profil.php"><img src="<?= $avatar ?>" alt=""></a>
            </div>
        </header>

        <div class="addFolder">
            <form action="" method="post">
                <input type="text" required placeholder="Nom du dossier" name="nom" id="">
                <input type="text" required placeholder="Sous nom du dossier" name="sous_nom" id="">
                <input type="submit" name="submit" value="Créer le dossier">
            </form>
        </div>

    </section>

    <?php if(isset($erreur)) { echo $erreur; } ?>
    
</body>
</html>