<?php
    class Usager
    {
  
        public $id;
        public $password;
        public $ban;
        public $admin;
        
        public function __construct($id = "", $p = "", $b = "", $a = "")
        {
            $this->setId($id);
            $this->setPw($p);
            //Ban et admin est toujours a false par défaut
            $this->ban = $b;
            $this->admin = $a;
        }
        public function getId()
        {
            return $this->id;
        }
        
        public function setId($id)
        {
            if(strlen($id) < 25)
            $this->id = $id;
        }
        
        public function getPw()
        {
            return $this->p;
        }
        
        public function setPw($p)
        {
            if(strlen($p) > 25)
            $this->password = $p;
        }
        
        
    }

?>
