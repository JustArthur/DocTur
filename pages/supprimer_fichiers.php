<?php

include_once('../include.php');
require_once('./src/info_user.php');

if(!isset($_SESSION['utilisateur'][0])) {
    header('Location: ../index.php');
    exit;
}

if($_SERVER['HTTP_REFERER'] !== 'http://localhost/DocTur/pages/dossier.php?id='.$_GET['dossier']) {
    header('Location: panel.php');
    exit;
}

if (isset($_GET['file']) && isset($_GET['dossier'])) {
    $fileId = $_GET['file'];
    $dossierId = $_GET['dossier'];

    $FolderFile = $DB->prepare("SELECT * FROM dossier inner join fichiers on fichiers.idDossier = dossier.idDossier WHERE dossier.idDossier = ?");
    $FolderFile->execute(array($dossierId));
    $FolderFile = $FolderFile->fetch();

    $chemin = "../images/private/utilisateurs/".$_SESSION['utilisateur'][1]."/".$FolderFile['nomDossier']."/".$FolderFile['nomFichier'];

    if (file_exists($chemin)) {
        if (unlink($chemin)) {
            $deleteFile = $DB->prepare("DELETE FROM fichiers WHERE idFichier = ?;");
            $deleteFile->execute([$fileId]);

            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        } else {
            // Il y a eu une erreur lors de la suppression du fichier
            // Gérez l'erreur en conséquence
        }
    } else {
        // Le fichier n'existe pas
        // Gérez l'erreur en conséquence
    }
}

?>