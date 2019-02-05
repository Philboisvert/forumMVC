<h1>Affichage de tous les sujets</h1>
<?php
 if(isset($_SESSION["userAdmin"]) || isset($_SESSION["UserID"]))
    {
    if(isset($_SESSION["userAdmin"]))
        {
            echo   "<a href='index.php?Usagers&action=Admin'>Page pour les administrateurs</a>";
        }
    ?>
    <table>
        <tr>
            <th>Nom d'usager</th>
            <th>Titre du sujet</th>
            <th>Date dernières activités</th>
        </tr>
        <?php

   
        foreach($data["sujets"] as $sujet)
        {
            echo "<tr><td>" .$sujet->getIdUsager() . "</td>";  
            echo "<td><a href='index.php?Sujets&action=afficheSujet&idSujet=".$sujet->getId()."'>" . $sujet->getTitre() . "</a></td>"; 
            if($sujet->lastentry == NULL ){
                echo "<td>". $sujet->getDateCreation() ."</td>";  
            } else {
                echo "<td>". $sujet->lastentry ."</td> "; 
            }
        
            if(isset($_SESSION["userAdmin"])){
            echo "<td><a href='index.php?Sujets&action=supprimer&idSujet=".$sujet->getId()."'>Supprimer le sujet</a></td>";
        }
        
        echo "</tr><br> "; 
        
        
    }
?>

    </table>
    <?php 
    if(isset($_SESSION["UserID"]))
    {
            $user = $_SESSION["UserID"];
            echo "<a href='index.php?Sujets&action=formNouvSujet&idUsager=". $user."'>Créer un nouveau sujet</a>";
    }
     if(isset($_SESSION["userAdmin"])){
        
         echo "<a href='index.php?Sujets&action=formNouvSujet&idUsager='".$_SESSION["userAdmin"]."'>Créer un nouveau sujet</a>";
    }
    
?>
    <a href="index.php?Usagers&action=Logout">Se déconnecter</a>
    <?php 
 } else {

?>

    <p> Vous n'avez pas accès à cette page.</p>
    <?php
 }
     ?>
