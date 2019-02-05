<?php
 if(isset($_SESSION["userAdmin"]) || isset($_SESSION["UserID"]))
    {
    if(isset($_SESSION["userAdmin"]))
        {
            echo   "<a href='index.php?Usagers&action=Admin'>Page pour les administrateurs</a>";
        }
    ?>


    <article id="f-nouvSuj">

        <h1>Insérer un nouveau sujet</h1>
        <form method="POST">
            <label name="suj-titre">Titre : </label>
            <input type="text" name="suj-titre" /><br>
            <textarea name="suj-texte" placeholder="Votre texte ici..." rows="4" cols="50"></textarea><br>
            <input type="hidden" name="action" value="insererNouvSujet" />

            <input type="submit" value="Soumettre" />
            <a href="index.php?Sujets&action=afficheListe">Annuler</a>
            <!--retour à la liste des sujets-->
        </form>
    </article>
    <?php 
 } else {

?>

    <p> Vous n'avez pas accès à cette page.</p>
    <?php
 }
     ?>
