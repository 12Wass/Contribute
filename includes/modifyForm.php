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


<?php } ?>
  </body>
</html>
