<?php
    class Inscription {
        private $erreur;
        private $banner;
        private $valid;

        public function inscription_user($identifiant, $mail, $password) {
            global $DB;

            $identifiant = (String) trim($identifiant);
            $mail = (String) trim($mail);
            $password = (String) trim($password);

            $this->erreur = (String) "";
            $this->banner = (String) "";

            $this->valid = (boolean) true;

            if(isset($identifiant)) {
                $verif = $DB->prepare("select id from utilisateurs where pseudo = ?");
                $verif->execute(array($identifiant));
                $verif=$verif->fetch();

                if(isset($verif['id'])) {
                    $this->valid = false;
                    $this->erreur = "Ce pseudo est déjà pris.";
                }

                if($this->valid) {
                    $crypt_password = password_hash($password, PASSWORD_ARGON2ID);

                    switch (random_int(1,8)) {
                        case 1:
                            $banner = 'default_banner_1.jpg';
                        break;
        
                        case 2:
                            $banner = 'default_banner_2.jpg';
                        break;
        
                        case 3:
                            $banner = 'default_banner_3.jpg';
                        break;
        
                        case 4:
                            $banner = 'default_banner_4.jpg';
                        break;

                        case 5:
                            $banner = 'default_banner_5.jpg';
                        break;
        
                        case 6:
                            $banner = 'default_banner_6.jpg';
                        break;
        
                        case 7:
                            $banner = 'default_banner_7.jpg';
                        break;
        
                        case 8:
                            $banner = 'default_banner_8.jpg';
                        break;
                    }

                    $insert_user = $DB->prepare("INSERT INTO utilisateurs (pseudo, email, banniere, password) VALUES(?, ?, ?, ?)");
                    $insert_user->execute(array($identifiant, $mail, $banner, $crypt_password));
                    
                }
            }

            return [$this->erreur];
        }
    }
?>