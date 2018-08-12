<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
<?php if ($_POST['functionSelect'] == 'generateIdForm'){
?>
    <h1>Modification pour l'adresse mail: <?php echo $_SESSION['email'];?></h1><br>
    <form action="" method="post">
            <label for="lastName">Nom : </label>
        <input type="text" id="lastName" name="lastName" value="<?php echo $lastName;?>"></input></br>
        <label for="firstName">Prénom : </label>
        <input type="text" id="firstName" name="firstName" value="<?php echo $firstName;?>"></input></br>
        <label for="picture">Photo : </label>
        <input type="file" id="picture" name="picture" value=""></input></br>
        <label for="username">Nom d'utilisateur : </label>
        <input type="text" id="username" name="username" value="<?php echo $username;?>"></input></br>
        <button onclick="sendIdMod()">Envoyer</button>
        <a href="profil.php">Retour</a>
<?php
}
  elseif($_POST['functionSelect'] == 'generateAddForm'){
?>

    <h1>Modification pour l'adresse mail: <?php echo $_SESSION['email'];?></h1><br>
    <form action="" method="post">
            <label for="addressinfo">Adresse : </label>
        <input type="text" id="addressinfo" name="addressinfo" value="<?php echo $addressinfo;?>"></input></br>
        <label for="city">Ville : </label>
        <input type="text" id="city" name="city" value="<?php echo $city;?>"></input></br>
        <label for="postalCode">Code Postal </label>
        <input type="text" id="postalCode" name="postalCode" value="<?php echo $postalCode;?>"></input></br>
        <button onclick="sendAddMod()">Envoyer</button>
        <a href="profil.php">Retour</a>
<?php }
elseif ($_POST['functionSelect'] == 'generatePjForm') {
  ?>
      <h1>Modification pour l'adresse mail: <?php echo $_SESSION['email'];?></h1><br>
      <form action="" method="post">
              <label for="name">Projet : </label>
          <input type="text" id="name" name="name" value="<?php echo $name;?>"></input></br>
          <label for="category">Catégorie : </label>
          <input type="text" id="category" name="category" value="<?php echo $category;?>"></input></br>
          <label for="desc">Description :</label>
          <input type="text" id="desc" name="desc" value="<?php echo $desc;?>"></input></br>
          <label for="target">Objectif :  </label>
          <input type="text" id="target" name="target" value="<?php echo $target;?>"></input></br>
          <label for="funds">Fonds récoltés : </label>
          <input type="text" id="funds" name="funds" value="<?php echo $funds;?>"></input></br>
          <label for="deadLine">DeadLine :</label>
          <input type="text" id="deadLine" name="deadLine" value="<?php echo $deadLine;?>"></input></br>
          <label for="contribMin">Contribution Minimale : </label>
          <input type="text" id="contribMin" name="contribMin" value="<?php echo $contribMin;?>"></input></br>
          <label for="valid">Validé : </label>
          <?php if ($valid == 1) {
            echo 'Projet validé!<br>';
          }
            else {
              echo 'En attente de validation<br>';
            }
          ?>
          <button onclick="sendPjMod()">Envoyer</button>
          <a href="profil.php">Retour</a>

<?php } ?>
  </body>
</html>
