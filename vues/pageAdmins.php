<?php
if(isset($_SESSION["userAdmin"]))
        {
?>
    <h1>Page d'administration</h1>
    <form method="POST">
        Les usagers : <select name="username">
            <?php
                foreach($data["Usager"] as $user)
                {
                    //logiquement on ne peut pas bannir un admin ou afficher ceux qui sont déjà banni
                    if($user->admin != 1 && $user->banni != 1)
                    {
                        echo "<option value='{$user->username}'>{$user->username}</option>";
                    }
                }
            ?>            
            </select><br>
        <input type="hidden" name="action" value="bannir" />
        <input type="submit" value="bannir" />
    </form>
    <a href='index.php?Sujets&action=afficheListe'>Page des sujets</a>
    <?php
        } else {
    ?>
        <h1>Page d'administration</h1>
        <p>Vous n'avez pas accès à cette page.</p>
        <?php
}
        if(isset($ok))
        {
        echo $ok;
        }

        ?>
