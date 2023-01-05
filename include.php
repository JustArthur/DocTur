<?php
    session_start();

    include_once('database/connexionBD.php');
    include_once('./class/inscriptionClass.php');
    include_once('./class/connexionClass.php');

    $_INSCRIPTION = new Inscription;
    $_CONNEXION = new Connexion;
?>