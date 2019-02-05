<?php
    define("RACINE", $_SERVER["DOCUMENT_ROOT"] . "/forumMVCRemise/");

    //définition des constantes de connexion à la base de données
    define("DBTYPE", "mysql");
    define("DBNAME", "forum");
    define("HOST", "localhost");
    define("USER", "root");
    define("PWD", "root");


    //définition de la fonction d'autoload
    function mon_autoloader($classe)
    {
        $repertoires = array(RACINE . "controleurs/",
                            RACINE . "modeles/",
                            RACINE . "vues/");
        
        foreach($repertoires as $rep)
        {
            if(file_exists($rep . $classe . ".php"))
            {
                require_once($rep . $classe . ".php");
                return;
            }
        }
    }

    spl_autoload_register("mon_autoloader");
?>
