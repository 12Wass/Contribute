<?php
$action = 'categorie';
require('../bddConnect.php');

//Récupération des infos 'Users'
$req = $bdd->prepare('SELECT * FROM categorie WHERE id = ?');
$req->execute(array($_POST['id']));
$catInfo = $req->fetch();
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Modifier une catégorie</title>
    <meta charset="utf-8">
    <link href="css/style.css" rel="stylesheet">
    <link href="dashboard.css" rel="stylesheet">
  </head>

  <body>
    <h1>Modification de la catégorie</h1>
      <form action="sendCategorieUpdate.php" method="post">

        <label>Nom</label>
          <input type="text" value="<?php echo $catInfo['nom']; ?>" name="nomEdit"></input><br>

        <label>Description</label>
          <input type="text" value="<?php echo $catInfo['description']; ?>" name="descriptionEdit"></input><br>

        <input type="hidden" value="<?php echo $_POST['id']; ?>" name="id"/>
          <input type="submit" value="Envoyer" />
    </form>
  </body>
</html>
