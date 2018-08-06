<?php
session_start();
require_once('admin/bddConnect.php');
if(empty($_SESSION['flag'])){
  echo 'Vous n\'êtes pas connectés sur Contribute.';
}
else {
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Mes projets</title>
  </head>
  <body>
    <?php
    // On recherche les projets de l'utilisateur et on agis en fonction de la réponse

    ?>
    <h1>Mes projets</h1>
      <p>Vos projets en cours</p>
      <p>Vos projets terminés</p>
  </body>
</html>
<?php } // Fermeture de l'entête PHP ?>
