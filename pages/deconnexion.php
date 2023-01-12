<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    
    include_once('../include.php');

    /*$date_connexion = date('Y-m-d H:i:s');

    $req = $DB->prepare("");
    $req->execute();

    $_SESSION = array();*/

    session_destroy();

    header('Location: ../index.php');
    exit;
?>