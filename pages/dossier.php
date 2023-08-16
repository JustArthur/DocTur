<?php 

    include_once('../include.php');

    if(!isset($_SESSION['utilisateur'][0])) {
        header('Location: ../index.php');
        exit;
    }

    require_once('./src/info_user.php');

    $erreur = "";
    $pop = "";

    $dossier = $DB->prepare("SELECT * FROM dossier WHERE idDossier = ?");
    $dossier->execute(array($_GET['id']));
    $dossier = $dossier->fetch();

    if(!empty($_POST)) {
        extract($_POST);
        if(isset($_POST['unfav'])) {
            $unfav = $DB->prepare("UPDATE dossier SET fav = 0 WHERE idDossier = ?;");
            $unfav->execute(array($_GET['id']));
        }

        if(isset($_POST['fav'])) {
            $fav = $DB->prepare("UPDATE dossier SET fav = 1 WHERE idDossier = ?;");
            $fav->execute(array($_GET['id']));
        }
    
        if(isset($_POST['deleteFolder'])) {   
            $pop = '<div class="popup">
            <form action="" class="pop" method="post">
                <h2>Voulez-vous supprimer ce dossier ainsi que les fichiers ?</h2>
                <p>Cette action est irréversible.</p>
                <input style="background: #ef233c;" type="submit" name="delete" value="Oui">
                <input style="background: var(--c-blue);" type="submit" name="non" value="Non">
                </form></div>';
        }

        if (isset($_POST['delete'])) {
            $deleteJoin = $DB->prepare("DELETE FROM fichiers WHERE idDossier=?;");
            $deleteJoin->execute([$_GET['id']]);

            $deleteFolder = $DB->prepare("DELETE FROM dossier WHERE idDossier=?;");
            $deleteFolder->execute([$_GET['id']]);

            //delete en physique dossiers et fichiers

            $erreur = '<ul class="notifications">
                    <li class="toast success">
                        <div class="column">
                            <span class="material-icons-round icon-notif">check_circle</span>
                            <span class="message-notif">Dossier supprimé avec succès.</span>
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
?>

<!DOCTYPE html>
<html lang="fr">
<head>

    <?php require_once('../include/link.php') ?>

    <link rel="stylesheet" href="../css/pageFolder.css">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="../css/notification.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0" />

    <title>Bienvenue <?= $_SESSION['utilisateur'][1]?> 👋</title>
</head>
<body> 

    <?php

        include_once ('src/sidebar.php');

    ?>

    <?= $pop ?>
    <?= $erreur ?>
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

        <div class="dossiers">
            <h1 class="titre">Mon dossier</h1>
            <div class="cards">
                <div class="card">
                    <svg class="icon-folder" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 48 48" width="60px" height="60px"><path fill="#ffa000" d="M40,12H22l-4-4H8c-2.2,0-4,1.8-4,4v24c0,2.2,1.8,4,4,4h29.7L44,29V16C44,13.8,42.2,12,40,12z"/><path fill="#ffca28" d="M40,12H8c-2.2,0-4,1.8-4,4v20c0,2.2,1.8,4,4,4h32c2.2,0,4-1.8,4-4V16C44,13.8,42.2,12,40,12z"/></svg>
                    <h2><?= $dossier['nomDossier'] ?></h2>
                    <h5 class="prof"><?= $dossier['sousNomDossier'] ?></h5>
                    <?php if($dossier["fav"]==1) { ?>
                        <span class="material-icons-outlined star">star</span>
                    <?php } else { ?>
                        <span class="material-icons-outlined star">grade</span>
                    <?php } ?>
                </div>
                
                <form method="post" class="boutons">
                    <?php if ($dossier['fav']==1) { ?>
                    <input class="unfav" name="unfav" type="submit" value="Non Favori">
                    <?php } else { ?>
                    <input class="fav" name="fav" type="submit" value="Favori">
                    <?php } ?>
                    <input class="up" type="submit" value="Modifier le dossier">
                    <input class="del" type="submit" name="deleteFolder" value="Supprimer le dossier">
                </form>
            </div>
        </div>

        <div class="ajouts">
            <h1 class="titre">Mes fichiers</h1>
            <div class="liste-ajouts">
                <a href="addFile.php?id=<?= $_GET['id']?>"><button class="add">Ajouter un fichier</button></a>
                <?php
                    $fichiers = $DB->prepare("SELECT * FROM fichiers WHERE idDossier = ?;");
                    $fichiers->execute(array($_GET['id']));
                    $fichiers = $fichiers->fetch();

                    if(empty($fichiers['idFichier'])) {
                ?>
                    <div class="ligne"><p>Aucun fichier</p></div>
                <?php
                    } else {
                        $fichiers = $DB->prepare("SELECT * FROM fichiers inner join dossier on dossier.idDossier = fichiers.idDossier WHERE fichiers.idDossier = ?;");
                        $fichiers->execute(array($_GET['id']));
                        $fichiers = $fichiers->fetchAll();

                        foreach ($fichiers as $file) {

                            $tailleFichier = formatSizeUnits($file['tailleFichier']);
                ?>
                    <div class="ligne">
                        <div class="icone"><img src="../images/public/word.svg" alt=""></div>
                        <div class="titre"><?= $file['nomFichier']?></div>
                        <div class="taille"><?= $tailleFichier?></div>
                        <div class="date">Ajouté le <span style="color: var(--c-blue);"> <?= $file['dateAjout']?></span></div>
                        <div class="boutons">
                            <a href="<?= $file['cheminFichier']?>" download>
                                <span class="dl">Télécharger</span>
                                <span class="material-symbols-rounded dl_tel">cloud_download</span>
                            </a>

                            <a href="supprimer_fichiers.php?file=<?= $file['idFichier']?>&dossier=<?= $file['idDossier']?>" class="supprimer">
                                <span class="dl">Supprimer</span>
                                <span class="material-symbols-rounded sup_tel">delete_forever</span>
                            </a>
                        </div>
                    </div>
                <?php 
                    }} 
                ?>      
            </div>
        </div>

        
    </section>
    
</body>
</html>