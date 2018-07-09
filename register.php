<?php session_start();
// Add a change ?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Inscription - Contribute</title>
  </head>
  <body>
    <h2>Remplissez le formulaire pour pouvoir vous inscrire</h2>
    <form action="sendReg.php" method="post">
    <fieldset>
      <legend>Informations personnelles </legend>
    <label for="firstName">Prénom</label>
      <input type="text" name="firstName" id="firstName"></input><br>
    <label for="lastName">Nom</label>
      <input type="text" name="lastName" id="lastName"></input><br>
    <label for="address">Adresse</label>
      <input type="text" name="address" id="address"></input><br>
    <label for="city">Ville</label>
      <input type="postalCode" name="city" id="city"></input><br>
    <label for="postalCode">Code Postal</label>
      <input type="text" name="postalCode" id="postalCode"></input><br>
    </fieldset>

    <fieldset>
      <legend>Informations utilisateur</legend>
    <label for="mail">Mail</label>
      <input type="mail" name="mail" id="mail"></input><br>
    <label for="username">Nom d'utilisateur</label>
      <input type="text" name="username" id="username"></input><br>
    <label for="password">Mot de passe</label>
      <input type="password" name="password" id="password"></input><br>
    <label for="verifPassword">Confirmation</label>
      <input type="password" name="verifPassword" id="verifPassword"></input><br>
    </fieldset>
    <input type="submit">Envoyer</button>
    </form>
  </body>
</html>
