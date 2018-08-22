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
    <?php
      $getProjects = $bdd->prepare('SELECT * FROM projet WHERE email = ? AND WHERE deadLine > NOW()');
      $getProjects->execute(array($_SESSION['email']));
      $projets = $getProjects->fetch(PDO::FETCH_ASSOC);

      $outDated = $bdd->prepare('SELECT * FROM projet WHERE email = ? AND WHERE deadLine < NOW()');
      $outDated->execute(array($_SESSION['email']));
      $oldProjets = $outDated->fetch(PDO::FETCH_ASSOC);
      var_dump($oldProjets); echo'<br>';
      var_dump($projets);
    ?>
      <p>Vos projets en cours</p>
    <?php foreach($projets AS $p) {
      echo 'Nom du projet : '. $projets['name']. '.';
    }
    ?>
      <p>Vos projets terminés</p>
  </body>
</html>
<?php } // Fermeture de l'entête PHP ?>
