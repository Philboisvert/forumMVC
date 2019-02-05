<form method="POST">
  <div class="container">
    <h1>Inscription</h1>

    <label for="email"><b>Adresse courriel</b></label>
    <input type="text" placeholder="Adresse courriel" name="email">

    <label for="password"><b>Mot de passe</b></label>
    <input type="password" placeholder="Mot de passe" name="pass">

    <label for="password2"><b>Mot de passe à nouveau</b></label>
    <input type="password" placeholder="mot de passe " name="pass2">

    <div class="">
        <input type="hidden" name="action" value="insereUser"/>
        <button type="submit" class="">Inscription</button>
    </div>
  </div>
</form>