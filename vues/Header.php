<html>
    <head>
        <meta charset="utf-8">
         <link rel="stylesheet" type="text/css" href="./css/style.css">
        <title>TP Final - Samia-Rachel Pierre | Philippe Boisvert-Benoit | Melissa P. Bourdeau</title>
     
    </head>
    <body>
         <main>
        <header>
            
        <nav>
            <ul id="menu">
                <li><a class="aNav" href="index.php?Sujets&action=afficheListe">ACCUEIL</a></li>
                <li><a class="aNav" href="index.php?Sujets&action=formNouvSujet">CRÉER UN SUJET</a></li>

            </ul>
        </nav>
        <div id="login">
            <!-----SECTION UTILISATEUR CONNECTÉ------------------------->
            <?php
                if(isset($_SESSION["UserID"]))
                {
                    echo '<a href="index.php?Usagers&action=Logout">Se déconnecter</a>';
                    echo '<a href="index.php?Usagers&action=afficheInscription">Créer un nouveau compte</a>';                
                    if(isset($_SESSION["userAdmin"])){
                         echo '<a href="index.php?Usagers&action=affichePageAdmin">Administrateur</a>';
                    }
                }
              
             ?>
        </div>
        </header>
            <div id="conteneur">