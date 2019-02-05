<?php
    class Modele_Usagers extends BaseDAO
    {
       public function getTableName()
       {
           return "usager";
       }
        
        public function getPrimaryKey()
        {
            return "username";
        }

        //fonction pour obtenir user par l'id - function to get user by id
        public function obtenir_par_id($id)
        {
            $resultat = $this->lire($id);
            $resultat->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Usager");
            $user = $resultat->fetch();
            return $user;
        }
        
        //fonction pour obtenir tous les users - function to get all the users
        public function obtenir_tous()
        {
            $resultats = $this->lireTous();
            $lesUsagers = $resultats->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Usager");
            return $lesUsagers;
        }
        
        //fonction pour inserer un user- function to insert a new user
         public function insert(Usager $user)
		{			
				//insérer
				$query = "INSERT INTO " . $this->getTableName() . " (username, password, banni, admin) VALUES (?, ?, ?, ?)";
				$donnees = array($user->id, $user->password, $user->ban, $user->admin);
				return $this->requete($query, $donnees);
        }
        
         //fonction pour bannir un user- function to ban a new user
        public function bannir(Usager $user)
		{			
				
                $query = "UPDATE " . $this->getTableName() . " SET banni = 1 WHERE username =?";
				$donnees = array($user->username);
				return $this->requete($query, $donnees);
        }

    
    }
?>
