<?php
  session_start();
  require_once('admin/bddConnect.php');
  if(empty($_SESSION['flag'])){
    echo 'Vous n\'êtes pas connectés sur Contribute.';
  }
  elseif (isset($_GET['connected'])) {
    echo 'Redirigé depuis la page de connexion';
  }{
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
    <p name="identity"><?php echo $ui['lastName'];?> <a href="" onclick="modifyId()">Modifier</a></p>
    <p name="identity"><?php echo $ui['firstName'];?></p>
    <p name="identity"><?php echo '<img src="data:image/jpeg;base64,'.base64_encode($ui['picture']) .'" />';?> </p>
    <p name="identity"><?php echo $ui['username'];?></p>
  </fieldset>
    <fieldset>
      <legend>Adresse</legend>
    <p name="address"><?php echo $ui['address'];?> <a href="" onclick="modifyAdd()">Modifier</a></p>
    <p name="address"><?php echo $ui['city'];?></p>
    <p name="address"><?php echo $ui['postalCode'];?></p>
  </fieldset>
  <fieldset>
    <legend>Contact et mot de passe</legend>
    <p><?php echo $ui['phone'];?> <a href="" onclick="modifyLn()">Modifier</a></p>
    <h3>Pour modifier votre email et/ou votre mot de passe, cliquez <a href="">ici</a></h3>
  </fieldset>
  </body>
  <script src="function.js"></script>
</html>
<?php } ?>
