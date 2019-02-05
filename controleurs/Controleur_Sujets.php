<?php

class Controleur_Sujets extends BaseControleur
{
    public function traite(array $params)
    {
        //déterminer une vue par défaut - define a view by default
        
        $vue = "";
       
        
        if(isset($params["action"]))
        {
            switch($params["action"])
            {
                case "afficheListe": //afficher liste des sujets - display list of subject
                    
                     //le user doit être connecté - user must be logged in
                    if(isset($_SESSION["UserID"]) || isset($_SESSION["userAdmin"])){
                        $this->afficheVue("Header");
                        $this->afficheListeSujets();
                        $this->afficheVue("Footer");
                    } else { 
                        echo "Vous devez être connecté.";
                    }
                    
                    break;
                    
                case "afficheSujet"://afficher liste d'un - display a subject
                    
                     //le user doit être connecté - user must be logged in
                   
                    if(isset($_SESSION["UserID"]) || isset($_SESSION["userAdmin"])){
                         $id = $_GET["idSujet"];
                        $this->afficheVue("Header");
                        $this->afficheSujetEtReponse($id);
                        $this->afficheVue("Footer");
                    } else{ 
                        echo "Vous devez être connecté.";
                    }
                    
                    break;
                case "formNouvSujet": // afficher le formulaire nouveau sujet - display form for new subject
                    //le user doit être connecté - user must be logged in
                    if(isset($_SESSION["UserID"]) || isset($_SESSION["userAdmin"])){
                        $this->afficheVue("Header");
                        $this->afficherFormNouvSujet();
                        $this->afficheVue("Footer");
                    }
                    else{ 
                        echo "Vous devez être connecté.";
                    }
                    
                    break;
                case "insererNouvSujet":
                    $messageForm = "";
                    //on insère les paramètres du formulaire - inserting the form data
                    
                    if(isset($params["suj-titre"], $params["suj-texte"])){
                        
                        if(isset($_SESSION["UserID"])){
                        $idUsager = $_SESSION["UserID"];
                        }
                            
                        if(isset($_SESSION["userAdmin"])){
                        $idUsager = $_SESSION["userAdmin"];
                        }
                        
                        //creation d'une instance de sujet - creation of subject object
                        $leSujet = new Sujet(0, $params["suj-titre"], $params["suj-texte"],"", $idUsager);
                        $modeleSujet = $this->getDAO("sujet");
                        $succes = $modeleSujet->sauvegarde($leSujet);

                        if($succes){ //retour à la liste de sujets - back to the subject list
                            $this->afficheVue("Header");
                            $this->afficheListeSujets();
                            $this->afficheVue("Footer");
                        }
                        else{
                            //l'insertion n'a pas fonctionné, on réaffiche le formulaire - insertion error display form again
                            $messageForm = "Erreur lors de l'ajout. Veuillez réessayer!";
                            $this->afficheVue("Header");
                            $this->afficherFormNouvSujet($messageForm);  
                            $this->afficheVue("Footer");
                        }                          

                    }
                    else{
                        //les paramètres sont invalides..
                        //l'insertion n'a pas fonctionné, on réaffiche le formulaire - insertion error display form again
                        $this->afficheVue("Header");
                        $this->afficherFormNouvSujet($messageForm);  
                        $this->afficheVue("Footer");
                    }
                  break;
                  case "supprimer":
                    //suppression sujet - delete subject
                    $id = $_GET["idSujet"];
                    $modeleSujet = $this->getDAO("sujet");
                    $succes = $modeleSujet->supprimer($id);
                    
                    if($succes){
                        echo "Sujet supprimé";
                        $this->afficheVue("Header");
                        $this->afficheListeSujets();
                        $this->afficheVue("Footer");
                    }else {
                        echo "Erreur de suppression";
                    }
                    break;
                default:
                    trigger_error("Action invalide.");
            }
        }
        else
        {
            //action du controleur à effectuer par défaut - default action
            $this->afficheVue("Header");
            $this->afficheListeSujets();
            $this->afficheVue("Footer");
        }
    }
    
    private function afficheListeSujets() //fonction pour afficher les donnees de la liste des sujets - function to display subject data
    {
        $modeleSujets = $this->getDAO("sujet");
        $donnees["sujets"] = $modeleSujets->obtenir_tous_par_activites_recentes();
        
        $this->afficheVue("AfficheListeSujets", $donnees);
    }
    
    private function afficheSujetEtReponse($id) //fonction pour afficher un sujet et les reponses - function to display a subject and the answers
    {
        $modeleSujets = $this->getDAO("Sujet");
        $modeleReponse = $this->getDAO("Reponse");
        $donnees["sujet"] = $modeleSujets->obtenir_par_id($id);
        $donnees["reponses"] = $modeleReponse->obtenir_par_sujet($id);
        $this->afficheVue("AfficheSujet", $donnees);
        
    }
        
    private function afficherFormNouvSujet($erreurs = "") //fonction pour afficher le formulaire pour un nouveau sujet - function to display the new subject form
    {
        $modeleSujets = $this->getDAO("sujet");
        $donnees["sujets"] = $modeleSujets->obtenir_tous();     
        $donnees["erreurs"] = $erreurs;
        $this->afficheVue("formNouvSujet", $donnees);
    }
    
    private function valideFormNouvSujet($titre, $texte) //validation du formulaire nouveau sujet- form validation for subject
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
