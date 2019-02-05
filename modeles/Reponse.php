<?php
require_once("Sujet.php");
    class Reponse extends Sujet
    {
        /*protected $id;
        protected $titre;
        protected $texte;
        protected $dateCreation;
        protected $idUsager;*/
        protected $idSujet;
        
        

        public function __construct($id = 0, $titre = "", $texte = "", $date ="", $idU = "", $idS = 0)
        {
            parent::__construct($id, $titre, $texte, $date, $idU);
            $this->setIdSujet($idS);
          
            
        }
        
        
        public function setIdSujet($id)
        {
            if(is_numeric($id))
            $this->idSujet = $id;
            else
            trigger_error("L'id doit être numérique", E_USER_ERROR);
        }
        
        public function getIdSujet()
        {
            return $this->idSujet;
        }
        
 
    }

?>
