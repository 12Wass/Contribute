<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h1>Modification pour l'adresse mail: <?php echo $_SESSION['email'];?></h1><br>
    <form action="" method="post">
            <label for="lastName">Nom : </label>
        <input type="text" id="lastName" name="lastName" value="<?php echo $lastName;?>"></input></br>
        <label for="firstName">Prénom : </label>
        <input type="text" id="firstName" name="firstName" value="<?php echo $firstName;?>"></input></br>
        <label for="picture">Photo : </label>
        <input type="file" id="picture" name="picture" value=""></input></br>
        <label for="username">Nom d'utilisateur : </label>
        <input type="username" id="username" name="username" value="<?php echo $username;?>"></input></br>
        <button onclick="sendIdMod()">Envoyer</button>
  </body>
</html>
