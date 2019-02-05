<?php
 if(isset($_SESSION["userAdmin"]) || isset($_SESSION["UserID"]))
    {
    if(isset($_SESSION["userAdmin"]))
        {
            echo   "<a href='index.php?Usagers&action=Admin'>Page pour les administrateurs</a>";
        }
    ?>


    <article id="f-nouvRep">

        <form method="POST">
            <label name="rep-titre">Titre : </label>
            <input type="text" name="rep-titre" /><br>
            <textarea name="rep-texte" placeholder="Votre réponse..." rows="4" cols="50"></textarea><br>
            <?php 
        $idSujet = $_GET["idSujet"];
        
        echo '<input type="hidden" name="idSujet" value="'. $idSujet .'" />';
        
        ?>
            <input type="hidden" name="action" value="insererNouvReponse" />
            <input type="submit" value="Soumettre" />
            <a href="index.php?sujets&action=afficheListe">Annuler</a>

        </form>

    </article>
    <?php 
 } else {

?>

    <p> Vous n'avez pas accès à cette page.</p>
    <?php
 }
     ?>
