<?php
$action = 'user';
require('../bddConnect.php');

//Récupération des infos 'Users'
$req = $bdd->prepare('SELECT * FROM user WHERE id = ?');
$req->execute(array($_POST['id']));
$userInfo = $req->fetch();
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Modifier un utilisateur</title>
    <meta charset="utf-8">
    <link href="css/style.css" rel="stylesheet">
    <link href="dashboard.css" rel="stylesheet">
  </head>

  <body>
    <h1>Modification de l'utilisateur</h1>
      <form action="sendUserUpdate.php" method="post">

        <label>Prénom</label>
          <input type="text" value="<?php echo $userInfo['firstName']; ?>" name="firstNameEdit"></input><br>

        <label>Nom</label>
          <input type="text" value="<?php echo $userInfo['lastName']; ?>" name="lastNameEdit"></input><br>

        <labels>Username</label>
          <input type="text" value="<?php echo $userInfo['username']; ?>" name="usernameEdit"></input><br>

        <label>Picture</label>
          <input type="text" value="<?php echo $userInfo['picture']; ?>" name="pictureEdit"></input><br>

        <label>Adresse</label>
          <input type="text" value="<?php echo $userInfo['address']; ?>" name="addressEdit"></input><br>

        <label>Ville</label>
          <input type="text" value="<?php echo $userInfo['city']; ?>" name="cityEdit"></input><br>

        <label>Code Postal</label>
          <input type="text" value="<?php echo $userInfo['postalCode']; ?>" name="postalCodeEdit"></input><br>

        <label>Description</label>
          <input type="text" value="<?php echo $userInfo['description']; ?>" name="descriptionEdit"></input><br>

        <label>E-mail</label>
          <input type="text" value="<?php echo $userInfo['email']; ?>" name="emailEdit"></input><br>

        <label>N° téléphone</label>
          <input type="text" value="<?php echo $userInfo['phone']; ?>" name="phoneEdit"></input><br>

        <input type="hidden" value="<?php echo $_POST['id']; ?>" name="id"/>
          <input type="submit" value="Envoyer" />
    </form>
  </body>
</html>
