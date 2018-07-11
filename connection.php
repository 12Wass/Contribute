<?php
  session_start();
  if (isset($_SESSION['flag'])) {
    echo 'Vous êtes déjà connecté. <br> Cliquez <a href="index.php">ici</a> pour revenir à l\'accueil';
}
  else {
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Connexion - Contribute</title>
  </head>
  <body>
    <h1>Connexion</h1>
    <form action="" method="post">
      <label for="identifiant">Adresse mail - Nom d'utilisateur</label><br>
      <input type="text" name="identifiant" id="identifiant"></input><br>
      <label for="password">Mot de passe</label><br>
      <input type="password" name="password" id="password"></input><br>
      <button onclick="connectUser()">Connexion</button><br>
  </body>
  <script src="function.js"></script>
</html>

<?php }
?>
