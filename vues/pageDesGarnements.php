<?php
if(isset($_SESSION["userBanned"]))
        {
?>
    <h1>Vous êtes malheureusement banni de ce forum.</h1><br>
    <h2>Pour plus d'informations, veuillez contacter un administrateur.</h2>
    <a href="index.php?Usagers&action=Logout">Se déconnecter</a>
    <?php
        } else {
    
?>
        <h1>Oh oh.</h1>
        <h2>Vous n'êtes pas supposé être ici!</h2>

        <?
