<?php
    class Modele_Sujet extends BaseDAO
    {
       public function getTableName()
       {
           return "sujets";
       }
        
        public function getPrimaryKey()
        {
            return "id";
        }
        
        // fonction pour obtenir sujet par id - function get subject by id
        public function obtenir_par_id($id)
        {
            $resultat = $this->lire($id);
            $resultat->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Sujet");
            $leSujet = $resultat->fetch();
            return $leSujet;
        }
        
        // fonction pour obtenir tous les sujets - function to get all subjects
        public function obtenir_tous()
        {
            $resultats = $this->lireTous();
            $lesSujets = $resultats->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "sujet");
            return $lesSujets;
        }
        
        // fonction pour obtenir tous les sujet par activites recentes - function get all subjects by recent activity
        public function obtenir_tous_par_activites_recentes()
        {
            $query = "SELECT s.*, (SELECT MAX(dateCreation) FROM reponse r WHERE r.idSujet = s.id) AS lastentry FROM " . $this->getTableName()." s group by s.dateCreation order by COALESCE (lastentry, s.dateCreation)desc ";
            $resultats = $this->requete($query); 
			$lesSujets =  $resultats->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "sujet");	
            return $lesSujets;
        }
        
        //fonction pour inserer un sujet - function to insert a new subject
        public function sauvegarde(Sujet $leSujet)
		{	
            //insérer
            $query = "INSERT INTO " . $this->getTableName() . " (titre, texte, dateCreation, idUsager) VALUES (?, ?, NOW(), ?)";
            $donnees = array($leSujet->getTitre(), $leSujet->getTexte(), $leSujet->getIdUsager());
            return $this->requete($query, $donnees);
			
		}
    }
?>
