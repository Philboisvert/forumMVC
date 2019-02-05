<h1>Affichage d'un sujet</h1>
<?php 

$id = $data["sujet"]->getId();
echo "<a href='index.php?Reponses&action=formNouvReponse&idSujet=". $id."'>Répondre au sujet</a>";
?>
<table>
    <tr>
        <th></th>
        <th>
            <?= $data["sujet"]->getTitre() ?>
        </th>
    </tr>
    <tr>
        <td>
            <?= $data["sujet"]->getIdUsager() ?><br>
                <?= $data["sujet"]->getDateCreation() ?>
        </td>
        <td>
            <?= $data["sujet"]->getTexte() ?>
        </td>
    </tr>
    <?php
       
        foreach($data["reponses"] as $reponse)
        {
            echo "<tr><td>". $reponse->getIdUsager() ."<br>".$reponse->getDateCreation()."</td>"; 
           
            echo "<td>". $reponse->getTitre() . "<br>". $reponse->getTexte(). "</td></tr><br> ";  
        
              
        
      
        }
    
        ?>


</table>

<a href='index.php?Sujets&action=afficheListe'>Retour à la liste de sujets</a><br>
<a href='index.php?Sujets&action=formNouvSujet'>Créer un nouveau sujet</a>
