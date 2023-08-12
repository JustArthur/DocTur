<?php
    session_start();

    include_once('database/connexionBD.php');
    include_once('class/inscriptionClass.php');
    include_once('class/connexionClass.php');

    $_INSCRIPTION = new Inscription;
    $_CONNEXION = new Connexion;
    

    function formatSizeUnits($bytes) {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');
    
        if ($bytes == 0) {
            return '0 B';
        }
    
        $i = floor(log($bytes, 1024));
        return round($bytes / pow(1024, $i), 2) . ' ' . $units[$i];
    }
    
?>