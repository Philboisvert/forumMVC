<!-- Controleur pour les reponses  || Controller for the answers -->
<?php

class Controleur_Reponses extends BaseControleur
{
    public function traite(array $params)
    {
        //déterminer une vue par défaut - define a view by default
        
        $vue = "";
        
        
        if(isset($params["action"]))
        {
            switch($params["action"])
            {
    
                case "formNouvReponse": //afficher le formulaire de réponse - display answer form
                    //le user doit être connecté - user must be logged in
                    if(isset($_SESSION["UserID"]) || $_SESSION["userAdmin"] ){ 
                        $this->afficheVue("Header");
                        $this->afficherFormReponse();
                        $this->afficheVue("Footer");
                    }
                    else{ 
                        echo "Vous devez être connecté";
                    }
                    
                    break;
                case "insererNouvReponse":
                    $messageForm = "";
                    //on insère les paramètres du formulaire - we insert the data from the form
                    if(isset($params["rep-titre"], $params["rep-texte"])){
                        if(isset($_SESSION["UserID"])){
                        $idUsager = $_SESSION["UserID"];
                        }
                            
                        if(isset($_SESSION["userAdmin"])){
                        $idUsager = $_SESSION["userAdmin"];
                        }
                        
                        //obtenir l'id du sujet - get id of subject
                        $idSujet = $_GET["idSujet"];
                        
                        //creation d'une instance Reponse - creation of answer object
                        $laReponse = new Reponse(0,$params["rep-titre"], $params["rep-texte"],"", $idUsager, $idSujet);
                        $modeleReponse = $this->getDAO("Reponse");
                        $succes = $modeleReponse->sauvegarde($laReponse);

                        if($succes){ //retour au sujet  - back to subject
                            header("location: index.php?sujets&action=afficheListe");
                        }
                        else{
                            //l'insertion n'a pas fonctionné, on réaffiche le formulaire - if insert didn't work
                            $messageForm = "Erreur lors de l'ajout. Veuillez réessayer!";
                            $this->afficheVue("Header");
                            $this->afficherFormReponse($messageForm);  
                            $this->afficheVue("Footer");
                        }                          

                    }
                    else{
                        //les paramètres sont invalides.. - if the data is invalid
                        $this->afficheVue("Header");
                        $this->afficherFormReponse($messageForm);  
                        $this->afficheVue("Footer");
                    }
                  break;
                default:
                    trigger_error("Action invalide.");
            }
        }
        else
        {
            //action du controleur à effectuer par défaut - default action
            $this->afficheListeSujets();
        }
    }
    
    
     private function afficherFormReponse($erreurs = "") // affichage du formulaire reponse - function to display answer form
    {
        $modeleReponse = $this->getDAO("reponse");
        $donnees["reponse"] = $modeleReponse->obtenir_tous();     
        $donnees["erreurs"] = $erreurs;
        $this->afficheVue("formNouvRep", $donnees);
    }
    
    private function valideFormNouvRep($titre, $texte) // validation du formulaire reponse - validation of answer form
     {
        $erreurs = "";
        
        $titre = trim($titre);
        $texte = trim($texte);
        
        if($titre == "")
            $erreurs .= "Le titre ne peut être vide.<br>";
        
        if(strlen($titre) > 250)
            $erreurs .= "Le titre ne doit pas dépasser 250 caractères.<br>";
        
        if($texte == "")
            $erreurs .= "Le texte ne peut être vide.<br>";
        
        return $erreurs;
     }

    
    
        
        
}
?>
