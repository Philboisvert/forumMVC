<?php
    class Sujet
    {
        protected $id;
        protected $titre;
        protected $texte;
        protected $dateCreation;
        protected $idUsager;

        public function __construct($id = 0, $titre = "", $texte = "",  $d = "", $idU = "")
        {
            $this->setId($id);
            $this->setTitre($titre);
            $this->setTexte($texte);
            $this->setDateCreation($d);
            $this->setIdUsager($idU);
        }
        
        public function setId($id)
        {
            if(is_numeric($id))
            $this->id = $id;
            else
            trigger_error("L'id doit être numérique", E_USER_ERROR);
        }
        
        public function getId()
        {
            return $this->id;
        }
        
        
        public function setTitre($t)
        {
            
            if(is_string($t))
                $this->titre = $t;
            else
            trigger_error("Le titre doit etre une chaine de charactere.", E_USER_ERROR);
        }

        public function getTitre()
        {
          return $this->titre;
        }
        
         public function setTexte($t)
        {
            
            if(is_string($t))
                $this->texte = $t;
            else
            trigger_error("Le texte doit etre une chaine de charactere.", E_USER_ERROR);
        }

        public function getTexte()
        {
          return $this->texte;
        }
        
        public function setDateCreation($d)
        {
            if(is_string($d))
            $this->dateCreation = $d;
            else
            trigger_error("La date doit être en format AAAA-MM-DD", E_USER_ERROR);
        }
        
        public function getDateCreation()
        {
            return $this->dateCreation;
        }
        
        
        public function setIdUsager($id)
        {
            
            if(is_string($id))
                $this->idUsager = $id;
            else
            trigger_error("L'usager doit etre une chaine de charactere.", E_USER_ERROR);
        }

        public function getIdUsager()
        {
          return $this->idUsager;
        }
    }

?>
