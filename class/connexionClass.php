<?php
    class Connexion {

        private $erreur;
        private $valid;

        public function connexion_user($identifiant, $password) {

            global $DB;

            $identifiant = (String) trim($identifiant);
            $password = (String) trim($password);

            $this->erreur = (String) "";
            $this->valid = (boolean) true;

            if($this->valid) {
                $verif_password = $DB->prepare("SELECT password FROM utilisateurs WHERE pseudo = ?");
                $verif_password->execute(array($identifiant));
                $verif_password = $verif_password->fetch();

                if(isset($verif_password['password'])) {
                    if(!password_verify($password, $verif_password['password'])) {
                        $this->valid = false;
                        $this->erreur = "Le mot de passe est incorrect";
                    }
                } else {
                    $this->valid = false;
                    $this->erreur = "Aucun utilisateur n'a cet identifiant.";
                }

                if($this->valid) {
                    $connexion = $DB->prepare("SELECT * FROM utilisateurs WHERE pseudo = ?");
                    $connexion->execute(array($identifiant));
                    $connexion = $connexion->fetch();

                    if(isset($connexion['id'])) {
                        $_SESSION['utilisateur'] = array(
                            $connexion['pseudo'],
                            $connexion['nom'],
                            $connexion['prenom'],
                            $connexion['localisation'],
                            $connexion['biographie'],
                            $connexion['email'],
                            $connexion['avatar'],
                            $connexion['banniere'],
                            $connexion['add-friend'],
                            $connexion['show-loca']);

                        header('Location: ./pages/panel.php');
                        exit;
                    }
                }
            }

            return [$this->erreur];
        }
    }
?>