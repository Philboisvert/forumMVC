<?php
    if(!isset($_SESSION["UserID"]) && !isset($_SESSION["userBanned"]) && !isset($_SESSION["userAdmin"]))
        {
?>


    <div class="login">
        <h1>Connectez-vous au forum</h1>
        <form method="POST">
            <p><input type="text" name="user" placeholder="Adresse courriel"></p>
            <p><input type="password" name="pass" placeholder="Mot de passe"></p>
            <input type="hidden" name="action" value="Login" />
            <p class="submit"><input type="submit" value="Connexion"></p>
            <a href="index.php?Usagers&action=afficheInscription">Pour les nouveaux utilisateur</a>
            <?php
            if(isset($msg))
            echo "<p>" . $msg . "</p>";
            if($data["succes"] != "")
            echo "<p>" . $data["succes"] . "</p>";
            ?>
        </form>
    </div>

    <?php
    }
    else
    {
    ?>
        Vous êtes déjà authentifiés...
        <a href="index.php?Sujets&action=afficheListe">Voir sujets</a>
        <a href="index.php?Usagers&action=Logout">Se déconnecter</a>
        <?php
    }
        
    ?>
