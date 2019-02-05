<?php



class Controleur_Usagers extends BaseControleur
{
    public function traite(array $params)
    {
        if(isset($params["action"]))
        {
            switch($params["action"])
            {
                //Affichage du form pour inscription d'un utilisateur - display of form for user sign up
                case "afficheInscription":
                    $this->afficheVue("Header");
                    $this->afficheFormAjoutUser();
                    $this->afficheVue("Footer");
                    break;
                //Affichage de la page admin - display of admin page
                case "Admin":
                    $this->afficheVue("Header");
                    $this->affichePageAdmin();
                    $this->afficheVue("Footer");
                    break;
                //La personne appuie sur submit dans le form - submitting the sign up form
                case "insereUser":
                $messageErreur = "";
                if(isset($params["email"], $params["pass"], $params["pass2"]))
                {
                    //Je vérifie que mes champs sont remplis et que le mot de passe est le même dans les deux champs - verifying that all fields are filled and that password is the same in both  password fields
                    $messageErreur = $this->valideFormAjoutUser($params["email"], $params["pass"], $params["pass2"]);                        
                
                    //Si le message d'erreur est vide aka tous les paramètres sont bien entrés - if there's no error message
                    if($messageErreur == "")
                    {
                        //Encryptage du mot de passe - encrypting password
                        $passwordEncrypte = password_hash($params["pass"], PASSWORD_DEFAULT);
                        //Création du user - creating a user
                        $leUser = new Usager($params["email"], $passwordEncrypte, false, false);
                        $modeleUsager = $this->getDAO("Usagers");
                        $succes = $modeleUsager->insert($leUser);
                        
                        //Si l'insertion fonctionne - if insert works
                        if($succes)
                        {
                            $msgSucces = "Création de compte fait";
                            $this->afficheVue("Header");
                            $this->afficheLogin($msgSucces);
                            $this->afficheVue("Footer");
                        }
                        else
                        {
                            //ça n'a pas fonctionné... refaire l'entrée - error, try again
                            $messageErreur = "Erreur lors de l'ajout...";
                            $this->afficheVue("Header");
                            $this->afficheFormAjoutUser($messageErreur);
                            $this->afficheVue("Footer");
                        }
                    }
                    else
                    {
                        //les paramètres sont invalides.. - data is invalid
                        $this->afficheVue("Header");
                        $this->afficheFormAjoutUser($messageErreur);
                        $this->afficheVue("Footer");
                    }
                }
                else
                {
                    //je n'ai pas reçu les paramètres - je ramène vers l'action par défaut - didn't receive any data, back to form
                    $this->afficheVue("Header");
                    $this->afficheFormAjoutUser();
                    $this->afficheVue("Footer");
                }
                    break;

                /* ICI ON DEVRA AJOUTER LA REDIRECTION VERS LA PAGE DES THREADS */
                case "Login":
                if(isset($params["user"]) && isset($params["pass"]))
                {
                    
                    if(($params["user"] !== "") && ($params["pass"] !== ""))
                    {
                    //On prend le modele on et va chercher le mot de passe associé - get password associated
                    $msg = "";
                    $user = trim($params["user"]);
                    $modeleUsager = $this->getDAO("Usagers");
                    $donnees = $modeleUsager->obtenir_par_id($user);
                    $pwEncrypte = $donnees->password;
                    $pwNormal = $params["pass"];
                    //Si le mot de passe fonctionne - if password is valid
                        if(password_verify($pwNormal, $pwEncrypte))
                        {   
                            //Pour les users qui sont bannis - if users are banned
                            if($donnees->banni == 1)
                            {
                                $_SESSION["userBanned"] = $user;
                                $this->afficheVue("Header");
                                $this->afficheVue("pageDesGarnements");
                                $this->afficheVue("Footer");
                            }
                            //Si l'utilisateur est un admin  - if user is an admin
                            else if($donnees->admin == 1)
                            {
                                $_SESSION["userAdmin"] = $user;
                                header("location: index.php?Sujets&action=afficheListe");
                            }
                            //nous sommes authentifiés et non bannis & admin - logged in, not banned
                            else
                            {
                                $_SESSION["UserID"] = $user;
                                header("location: index.php?Sujets&action=afficheListe");
                            }                           
                        }
                        else
                        {   
                            $msg = "Mauvais username ou mot de passe";
                            $this->afficheVue("Header");
                            $this->afficheLogin($msg);
                            $this->afficheVue("Footer");
                            
                        } 
                    }
                    //si les champs sont vides - if fields are empty
                    else
                    {         
                        $this->afficheVue("Header");
                        $this->afficheLogin();
                        $this->afficheVue("Footer");
                    }
                }
                else
                {         
                    $this->afficheVue("Header");
                    $this->afficheLogin();
                    $this->afficheVue("Footer");
            
                }
                break;
                
                case "bannir":
                    //bannir un usager - ban a user
                    if(isset($params["username"]))
                    {
                        $user = $params["username"];
                        $modeleUsager = $this->getDAO("Usagers");
                        $donnees = $modeleUsager->obtenir_par_id($user);
                        $succes = $modeleUsager->bannir($donnees);
                        if($succes)
                        {
                            $ok = "L'usager a été banni";
                            $this->afficheVue("Header");
                            $this->affichePageAdmin($ok);
                            $this->afficheVue("Footer");
                        }
                        else
                        {
                            $this->afficheVue("Header");
                            $this->afficheLogin();
                            $this->afficheVue("Footer");
                        }
                    }
                    else
                    {
                            $this->afficheVue("Header");
                            $this->affichePageAdmin();
                            $this->afficheVue("Footer");
                    }
                    break;

                //On détruit la session - login out/destroying the session
                case "Logout":
                $_SESSION = array();

                if (ini_get("session.use_cookies")) 
                {
                    $params = session_get_cookie_params();
                    setcookie(session_name(), '', time() - 42000,
                        $params["path"], $params["domain"],
                        $params["secure"], $params["httponly"]
                    );
                }
                session_destroy();
                $this->afficheVue("Header");
                $this->afficheLogin();
                $this->afficheVue("Footer");
                break;   
            }
        }
        else
        {
            //action du controleur à effectuer par défaut  - default action
            $this->afficheVue("Header");
            $this->afficheLogin();
            $this->afficheVue("Footer");
        } 
    }
     //Form pour ajouter un user - form to add a user
    private function afficheFormAjoutUser($erreurs = "")
    {
        $modeleUsager = $this->getDAO("Usagers");
        $donnees["Usager"] = $modeleUsager->obtenir_tous();   
        $donnees["erreurs"] = $erreurs;
        $this->afficheVue("Inscription", $donnees);
    }

    //Fonction pour afficher le login screen - function to display login screen
    private function afficheLogin($caMarche = "")
    {
        $modeleUsager = $this->getDAO("Usagers");
        $donnees["Usager"] = $modeleUsager->obtenir_tous();
        $donnees["succes"] = $caMarche;   
        $this->afficheVue("Login", $donnees);
    }

    //Fonction pour afficher la page admin - function to display admin page
    private function affichePageAdmin()
    {
        $modeleUsager = $this->getDAO("Usagers");
        $donnees["Usager"] = $modeleUsager->obtenir_tous(); 
        $this->afficheVue("pageAdmins", $donnees);
    }

    /*                 FORM VALIDATIONS                       */
    private function valideFormAjoutUser($email, $pass1, $pass2)
    {
        $erreurs = "";
        
        $email = trim($email);
        
        if($email == "")
            $erreurs .= "Entrez une adresse courriel<br>";
        
        if(strlen($pass1) > 50)
            $erreurs .= "Votre mot de passe ne peut pas dépasser 50 caratères.<br>";
        
        if($pass1 !== $pass2)
            $erreurs .= "Les mots de passes entrés ne concordent pas.<br>";
        
        return $erreurs;
    }
}
?>
