<?php
    class Modele_Reponse extends BaseDAO
    {
       public function getTableName()
       {
           return "reponse";
       }
        
        public function getPrimaryKey()
        {
            return "id";
        }
        
        //fonction pour obtenir reponse par l'id - function to get reponse by id
        public function obtenir_par_id($id)
        {
            $resultat = $this->lire($id);
            $resultat->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "reponse");
            $laReponse = $resultat->fetch();
            return $laReponse;
        }
        
        //fonction pour obtenir toutes les reponses - function to get all the answers
        public function obtenir_tous()
        {
            $resultats = $this->lireTous();
            $lesReponses = $resultats->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "reponse");
            return $lesReponses;
        }
        
        //fonction pour obtenir les reponses par sujet - function to get answers by subject
         public function obtenir_par_sujet($idSujet)
        {
            $resultats = $this->lire($idSujet, "idSujet");
            $lesReponses = $resultats->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "reponse");
            return $lesReponses;
        }
        
        //fonction pour inserer une reponse - function to insert a new answer
        public function sauvegarde(Reponse $laReponse)
		{			
            $query = "INSERT INTO " . $this->getTableName() . " (titre, texte, dateCreation, idUsager, idSujet) VALUES (?, ?, NOW(), ?, ?)";
            $donnees = array( $laReponse->getTitre(), $laReponse->getTexte(), $laReponse->getIdUsager(), $laReponse->getIdSujet());
            return $this->requete($query, $donnees);
			
		}
    }
?>
