<?php
$action = 'categorie';
require('../bddConnect.php');
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Ajouter une catégorie</title>
    <meta charset="utf-8">
    <link href="css/style.css" rel="stylesheet">
    <link href="dashboard.css" rel="stylesheet">
  </head>

  <body>
    <h1>Ajouter la catégorie</h1>
      <form action="sendCategorieCreate.php" method="post">

        <label>Nom</label>
          <input type="text" name="nomEdit"></input><br>

        <label>Description</label>
          <input type="text" name="descriptionEdit"></input><br>

          <input type="submit" value="Envoyer" />
    </form>
  </body>
</html>
