<?php
$action = 'projet';
require('../bddConnect.php');
// Récupération du nom de la marque et des informations de la mission sélectionnée
$req = $bdd->prepare('SELECT * FROM projet WHERE id = ?');
$req->execute(array($_POST['id']));
$projet = $req->fetch();
// recup l'user
$idUser = $projet['idUser'];
$userReq = $bdd->prepare('SELECT username FROM user WHERE id = ?');
$userReq->execute(array($idUser));
$projetUser = $userReq->fetch();
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Modifier un projet</title>
    <meta charset="utf-8">
    <link href="css/style.css" rel="stylesheet">
    <link href="dashboard.css" rel="stylesheet">
  </head>

  <body>
    <h1>Modification du projet</h1>
      <form action="sendProjetUpdate.php" method="post">

        <label>Créateur du projet</label>
          <input value="<?php echo $projetUser['username']; ?>" disabled><br>

        <label>Catégorie</label>
        <select name="catEdit">
          <?php
            $req = $bdd->query('SELECT * FROM categorie');
            foreach($req AS $nameCat) { ?>
          <option value="<?php echo $nameCat['id'];?>"> <?php echo $nameCat['nom']; }?> </option>
        </select><br>

        <label>Nom du projet</label>
          <input value="<?php echo $projet['name']; ?>" name="nameEdit"><br>

        <label>Objectif</label>
          <input value="<?php echo $projet['target']; ?>" name="targetEdit"><br>

        <label>Fond Récolter</label>
          <input value="<?php echo $projet['funds']; ?>" disabled><br>

        <label>Description</label>
          <input value="<?php echo $projet['description']; ?>" name="descriptionEdit"><br>

        <label>Dead line</label>
          <input value="<?php echo $projet['deadLine']; ?>" name="deadLineEdit"><br>

        <label>Contribution Minimal</label>
          <input value="<?php echo $projet['contribMin']; ?>" name="contribMinEdit"><br>

          <input type="hidden" value="<?php echo $_POST['id']; ?>" name="id"/>

        <input type="submit" value="Envoyer" />
    </form>
  </body>
</html>
