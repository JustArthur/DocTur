<?php
    require_once('../../../include.php');

    if(isset($_POST)) {
        extract($_POST);

        if(isset($_POST['image'])) {

            if(isset($_FILES['avatar']) && !empty($_FILES['avatar']['name'])) {
                
                $extension = array('png', 'jpg', 'jpeg', 'gif');

                $upload = strtolower(substr(strchr($_FILES['avatar']['name'], '.'), 1));

                if(in_array($upload, $extension)) {
                    $chemin =  '../../../images/private/utilisateurs/' . $_SESSION['utilisateur'][1] . '/';

                    if(!is_dir($chemin)) {
                        mkdir($chemin);
                    }

                    $avatar = $_SESSION['utilisateur'][1] . '_avatar.' . $upload;

                    $chemin_final = $chemin . $avatar;

                    $res_avatar = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin_final);
                }

                if(is_readable($chemin_final)) {
                    echo 'Fichier inserer | ' . $avatar . ' | ' . $chemin_final;
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>

    <?php require_once('../../../include/link.php') ?>

    <link rel="stylesheet" href="../../../css/panel.css">

    <title>Paramètre de Kuma</title>
</head>
<body>
    <form method="post" enctype="multipart/form-data">

        <input type="file" name="avatar" id=""><br>

        <input type="submit" name="image" value="ajouter">
    </form>
</body>
</html>