<?php
  session_start();
  require_once('admin/bddConnect.php');
  if(empty($_SESSION['flag'])){
    echo 'Vous n\'êtes pas connectés sur Contribute.';
  }

  else {
    if (isset($_GET['connected'])){
      echo 'Redirigé depuis la page de connexion';
    }
    $req = $bdd->prepare('SELECT lastName, firstName, picture, username, address, city, postalCode, description, email, phone FROM user WHERE email = ?');
    $req->execute(array($_SESSION['email']));
    $ui = $req->fetch(PDO::FETCH_ASSOC);
    ?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Mon profil - Contribute</title>
  </head>
  <body>
    <h2><?php echo $_SESSION['username'];?></h2>
    <h3>Vos informations personnelles :</h3>
    <fieldset>
      <legend>Identité</legend>
      <label for="lastname">Nom</label>
    <p class="identity" name="lastname"><?php echo $ui['lastName'];?></p>
      <label for="firstname">Prénom</label>
    <p class="identity" name="firstname"><?php echo $ui['firstName'];?></p>
      <label for="picture">Photo</label>
    <p class="identity" name="picture"><?php if (!empty($ui['picture'])){ echo '<img src="data:image/jpeg;base64,'.base64_encode($ui['picture']) .'" />'; } else { echo 'Pas de photo'; }?> </p>
      <label for="username">Nom d'utilisateur</label>
    <p class="identity" name="username"><?php echo $ui['username'];?></p>
    <button onclick="modifyId()">Modifier</button>
    <p id="affiche"></p>
  </fieldset>
    <fieldset>
      <legend>Adresse</legend>
      <label for="address">Adresse</label>
    <p class="address" name="address"><?php echo $ui['address'];?> </p>
      <label for="city">Ville</label>
    <p class="address" name="city"><?php echo $ui['city'];?></p>
      <label for="postalCode">Code postal</label>
    <p class="address" name="postalCode"><?php echo $ui['postalCode'];?></p>
    <button onclick="modifyAdd()">Modifier</button>

  </fieldset>
  <fieldset>
    <legend>Contact et mot de passe</legend>
    <label for="phone">Téléphone</label>
    <p name="phone"><?php echo $ui['phone'];?> <a href="" onclick="modifyLn()">Modifier</a></p>
    <h3>Pour modifier votre email et/ou votre mot de passe, cliquez <a href="">ici</a></h3>
  </fieldset>
  </body>
  <script src="function.js"></script>
</html>
<?php } ?>
