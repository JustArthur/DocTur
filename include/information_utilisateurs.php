<?php
    error_reporting(E_ALL);
	ini_set("display_errors", 1);

    include_once('include.php');

    switch ($_SESSION['banner']) {
        case 'default_banner_1.jpg':
            $banner = '../images/private/default/default_banner_1.jpg';
            break;

        case 'default_banner_2.jpg':
            $banner = '../images/private/default/banner/default_banner_2.jpg';
            break;

        case 'default_banner_3.jpg':
            $banner = '../images/private/default/banner/default_banner_3.jpg';
            break;

        case 'default_banner_4.jpg':
            $banner = '../images/private/default/banner/default_banner_4.jpg';
            break;

        case 'default_banner_1.jpg':
            $banner = '../images/private/default/banner/default_banner_5.jpg';
            break;
    
        case 'default_banner_2.jpg':
            $banner = '../images/private/default/banner/default_banner_6.jpg';
            break;
    
        case 'default_banner_3.jpg':
            $banner = '../images/private/default/banner/default_banner_7.jpg';
            break;
    
        case 'default_banner_4.jpg':
            $banner = '../images/private/default/banner/default_banner_8.jpg';
            break;

        default:
            $banner = '../images/private/utilisateur/' . $_SESSION['pseudo'] . '/' . $_SESSION['banner'];
    }

    switch ($_SESSION['avatar']) {
        case 'avatar.png':
            $avatar = '../images/private/default/avatar/default_avatar.jpg';
            break;

        default:
            $avatar = '../images/private/utilisateur/' . $_SESSION['pseudo'] . '/' . $_SESSION['avatar'];
    }

    switch ($_SESSION['rang']) {
        case 0:
            $rang_utilisateur = array(0, 'Utilisateur');
            break;
        
        case 1:
            $rang_utilisateur = array(1, 'Modérateur');
            break;

        case 2:
            $rang_utilisateur = array(2, 'Administrateur');
            break;

        case 3:
            $rang_utilisateur = array(3, 'Super Administrateur');
            break;

        default:
            $rang_utilisateur = array(4, 'Aucun accès au site');
    }
?>