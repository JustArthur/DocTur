<?php
    require_once('src/info_user.php');

    $erreur = "";

    
    if(!empty($_POST)) {
        extract($_POST);     
        
        if(isset($_POST['submit'])) {

            if(isset($_FILES['file']) && !empty($_FILES['file']['name'])) {

                $nomDossier = $DB->prepare("SELECT nomDossier, nbrFichiers FROM dossier WHERE idDossier = ? and idUser =?;");
                $nomDossier->execute(array($_GET['id'], $_SESSION['utilisateur'][0]));
                $nomDossier = $nomDossier->fetch();
                    
                $extension = array('docx', 'pptx', 'pdf', 'jpeg', 'png', 'mp3', 'mp4');
    
                $upload = strtolower(substr(strchr($_FILES['file']['name'], '.'), 1));
    
                if(in_array($upload, $extension)) {
                    $chemin =  '../images/private/utilisateurs/' . $_SESSION['utilisateur'][1] . '/' .$nomDossier['nomDossier']. '/';
    
                    if(!is_dir($chemin)) {
                        mkdir($chemin);
                    }
    
                    $file = $nom .'.'. $upload;
    
                    $chemin_final = $chemin . $file;
    
                    $res_file = move_uploaded_file($_FILES['file']['tmp_name'], $chemin_final);
                }
    
                if(is_readable($chemin_final)) {
                    $insert_file = $DB->prepare("INSERT INTO fichiers (idDossier, nomFichier, cheminFichier, tailleFichier, dateAjout) VALUES(?, ?, ?, ?, ?)");
                    $insert_file->execute(array($_GET['id'], $file, $chemin_final, $_FILES['file']['size'], date('Y-m-d')));

                    $updateNombre = intval($nomDossier['nbrFichiers']) + 1;

                    $updateDossier = $DB->prepare("UPDATE dossier SET nbrFichiers = ? WHERE idDossier = ?;");
                    $updateDossier->execute(array($updateNombre, $_GET['id']));


                    $erreur = '
                    <ul class="notifications">
                        <li class="toast success">
                            <div class="column">
                                <span class="material-icons-round icon-notif">check_circle</span>
                                <span class="message-notif">Fichier ajouté.</span>
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
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>

    <?php require_once('../include/link.php') ?>

    <link rel="stylesheet" href="../css/panel.css">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="../css/addFile.css">
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

        <div class="addFile">
            <?=$erreur?>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="text" required placeholder="Nom du fichier" name="nom" id="">
                <div class="button-wrapper">
                    <span class="label">
                        Télécharger le fichier
                    </span>
                    <input type="file" name="file" id="upload">
                </div>
                <input type="submit" name="submit" value="Ajouter le fichier">
            </form>
        </div>

    </section>

    <?php if(isset($erreur)) { echo $erreur; } ?>
    
</body>
</html>