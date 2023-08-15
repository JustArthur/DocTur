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

    $erreur = "";

    if(!empty($_POST)) {
        extract($_POST);
        if(isset($_POST['newPhoto'])) {
            if(isset($_FILES['photo']) && !empty($_FILES['photo']['name'])) {
                    
                $extension = array('png');
    
                $upload = strtolower(substr(strchr($_FILES['photo']['name'], '.'), 1));
    
                if(in_array($upload, $extension)) {
                    $chemin =  '../images/private/utilisateurs/' . $_SESSION['utilisateur'][1] . '/';
    
                    if(!is_dir($chemin)) {
                        mkdir($chemin);
                    }
    
                    $file = $_SESSION['utilisateur'][1] .'_avatar.'. $upload;
    
                    $chemin_final = $chemin . $file;
                    
                    $res_file = move_uploaded_file($_FILES['photo']['tmp_name'], $chemin_final);

                    if(is_readable($chemin_final)) {
                        $insert_file = $DB->prepare("UPDATE utilisateurs SET avatar=? WHERE id=?;");
                        $insert_file->execute(array($file, $_SESSION['utilisateur'][0]));

                        // header('refresh:0');
                        // exit;
                    }
                }
                else {
                    $erreur = '<ul class="notifications">
                        <li class="toast error">
                            <div class="column">
                                <span class="material-symbols-rounded icon-notif">error</span>
                                <span class="message-notif">Mauvais format de fichier</span>
                            </div>
                            <span class="material-symbols-rounded icon-notif close" onclick="remove()">close</span>
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
    <link rel="stylesheet" href="../css/profil.css">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="../css/notification.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0" />

    <title>Bienvenue <?= $_SESSION['utilisateur'][1]?> 👋</title>
</head>
<body> 

    <?php

        include_once ('src/sidebar.php');

    ?>

    <section class="global">
        <?= $erreur ?>
        <div class="compte">
            <h1 class="titre">Mon profil</h1>
            <div class="banniere">
                <img src="<?= $banner ?>" alt="">
                <div class="avatar">
                    <img src="<?= $avatar ?>" alt="">
                    <div class="avatar_hover" onclick="openPhotoChanger()"><span class="material-symbols-rounded">photo_camera</span></div>
                </div>
            </div>
            <div class="details" id="details">
                <div class="pseudo"><?= $_SESSION['utilisateur'][1]?></div>
                <script>
                    fetch('http://ip-api.com/json')
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('country').innerHTML += data.country;
                    });
                </script>
                <div class="loca" id="country"><span class="material-symbols-rounded">location_on</span>&nbsp;</div>
                <span class="profil_btn">
                    <a class="settings" onclick="openInfoChanger()">Modifier mes informations</a>
                </span>
            </div>
            <!-- <div class="bio">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta exercitationem non nobis pariatur dolorum praesentium hic, ducimus iste deserunt sequi officia veniam ex blanditiis! Quae aut, voluptates hic ut tempora tenetur quibusdam laborum ab fugit cumque quaerat magni odio non corporis at tempore facilis libero. Voluptates eius nulla corporis. Accusantium!
            </div> -->

        </div>

        <div class="photoChanger" id="divPhoto">
            <span class="material-symbols-rounded" onclick="closePhotoChanger()">close</span>
            <div class="ancienne_photo">
                <img id="ancienne_photo" src="<?= $avatar ?>" alt="">
                <img id="preview">
            </div>
            <form class="form_photo" method="post" enctype="multipart/form-data">
                <input type="file" name="photo" id="input-file" onchange="previewImage()" required="required">
                <input type="submit" name="newPhoto" value="Enregistrer">
            </form>
        </div>
    </section>

    <script src="../js/profil.js"></script>
    <script>
        function previewImage() {
            var preview = document.querySelector('#preview');
            var file = document.querySelector('#input-file').files[0];
            var reader = new FileReader();
            var ancienne = document.querySelector('#ancienne_photo');

            reader.addEventListener("load", function () {
                preview.src = reader.result;
                ancienne.style.display = "none";
            }, false);

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
    
</body>
</html>