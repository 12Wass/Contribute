<?php
  session_start();
  require_once('admin/bddConnect.php');
  $req = $bdd->query('SELECT id, nom FROM categorie');
  echo $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Proposer un projet - Contribute</title>
  </head>
  <body>
    <h1>Projet</h1>
    <form action="" method="post">
      <label for="name">Nom du Projet:</label><br>
        <input type="text" name="name" id="name"></input><br><br>
      <label for="category">Categories</label><br>
        <select name="category" id="category">
          <?php foreach($req AS $catCount){
            echo '<option value="'. $catCount['id'] .'">'. $catCount['nom'] .'</option>';
          }
        ?>
      </select><br>
      <label for="description">Description</label><br>
        <textarea name="description" id="description" rows=4 cols=40 wrap=virtual>Description de votre projet.</textarea><br><br>
      <label for="target">Votre objectif (somme visée):</label><br>
        <input type="text" name="target" id="target"></input><br>
      <label for="contribmin">Contribution minimale</label><br>
        <input type="text" name="contribMin" id="contribMin"></input><br>
      <label for="deadLine">Date limite du projet</label><br>
        <input type="date" name="deadline" id="deadline"></input><br><br>
        <button onclick="addProject()">Valider</button>
    </form>
  </body>
  <script src="function.js"></script>
</html>
