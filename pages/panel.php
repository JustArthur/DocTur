<?php 

    include_once('../include.php');

    if(!isset($_SESSION['utilisateur'][0])) {
        header('Location: ../index.php');
        exit;
    }

    require_once('./src/info_user.php');

    $dossier_user = $DB->prepare("SELECT * FROM dossier WHERE idUser = ?");
    $dossier_user->execute(array($_SESSION['utilisateur'][0]));
    $dossier_user = $dossier_user->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>

    <?php require_once('../include/link.php') ?>

    <link rel="stylesheet" href="../css/panel.css">
    <link rel="stylesheet" href="../css/sidebar.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0" />

    <title>Bienvenue <?= $_SESSION['utilisateur'][1]?> 👋</title>
</head>
<body> 

    <?php

        include_once ('src/sidebar.php');

    ?>

    <section class="global">

        <header>
            <form class="search" action="recherche.php" method="get">
                <div class="div_input">
                    <input type="search" name="recherche" placeholder="Rechercher un fichier ou un dossier ..." class="barre">
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
            <h1 class="titre">Mes dossiers</h1>
            <div class="cards">

                <div class="card add" onclick="location.href='newFolder.php'">+ Ajouter un dossier</div>

            <?php
                foreach ($dossier_user as $dossier) {

                    if($dossier['nbrFichiers'] == 0) {
                        $nbrFichiers = 'Pas de fichiers';
                        
                    } elseif($dossier['nbrFichiers'] == 1) {
                        $nbrFichiers = $dossier['nbrFichiers'] . ' fichier';

                    } else {
                        $nbrFichiers = $dossier['nbrFichiers'] . ' fichiers';
                    }

            ?>
                    <div class="card" onclick="location.href='dossier.php?id=<?= $dossier['idDossier']?>'">
                        <svg class="icon-folder" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 48 48" width="60px" height="60px"><path fill="#ffa000" d="M40,12H22l-4-4H8c-2.2,0-4,1.8-4,4v24c0,2.2,1.8,4,4,4h29.7L44,29V16C44,13.8,42.2,12,40,12z"/><path fill="#ffca28" d="M40,12H8c-2.2,0-4,1.8-4,4v20c0,2.2,1.8,4,4,4h32c2.2,0,4-1.8,4-4V16C44,13.8,42.2,12,40,12z"/></svg>
                        <h2><?= $dossier['nomDossier'] ?></h2>
                        <h5 class="prof"><?= $dossier['sousNomDossier'] ?></h5>
                        <?php if($dossier["fav"]==1) { ?>
                            <span class="material-icons-outlined star">star</span>
                        <?php }?>
                        <!-- <span class="material-icons-outlined menu">more_vert</span> -->
                        <h5 class="count"><?= $nbrFichiers ?></h5>
                    </div>
            <?php
                }
            ?>
                
            </div>
        </div>


        <div class="ajouts">
            <h1 class="titre">Mes derniers ajouts</h1>
            <div class="liste-ajouts">

                <?php
                    $fichiers = $DB->prepare("SELECT * FROM fichiers order by dateAjout desc limit 5");
                    $fichiers->execute();
                    $fichiers = $fichiers->fetchAll();

                    foreach ($fichiers as $file) {

                        $tailleFichier = formatSizeUnits($file['tailleFichier']);
                ?>
                    <div class="ligne">
                        <div class="icone"><img src="../images/public/word.svg" alt=""></div>
                        <div class="titre"><?=htmlspecialchars($file["nomFichier"])?></div>
                        <div class="taille"><?=htmlspecialchars($tailleFichier)?></div>
                        <div class="date">Ajouté le <span style="color: var(--c-blue);"> <?=htmlspecialchars($file["dateAjout"])?></span></div>
                        <div class="boutons">
                            <a href="<?= $file['cheminFichier']?>" download>
                                <span class="dl">Télécharger</span>
                                <span class="material-symbols-rounded dl_tel">cloud_download</span>
                            </a>
                            <a class="open_in" href="dossier.php?id=<?= $file['idDossier']?>"><span class="material-symbols-rounded">open_in_new</span></a>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
    </section>
    
</body>
</html>