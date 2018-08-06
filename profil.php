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
    $req = $bdd->prepare('SELECT id, lastName, firstName, picture, username, address, city, postalCode, description, email, phone FROM user WHERE email = ?');
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
    <p class="identity" name="lastname" id="lastname"><?php echo $ui['lastName'];?></p>
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
  <fieldset>
    <legend>Vos projets</legend>
    <?php
      // On requête le serveur pour savoir si l'utilisateur à des projets en cours

      $count = $bdd->prepare('SELECT COUNT(*) FROM projet WHERE idUser = ?');
      $count->execute(array($ui['id']));
      $cP = $count->fetch(PDO::FETCH_ASSOC);

      // Si count est à 0, l'utilisateur n'as pas de projet, sinon, il en a.

      if ($cp != 0) {
        echo 'Vous n\'avez pas de projets en cours';
      }
      else {
        $projet = $bdd->prepare('SELECT * FROM projet WHERE idUser = ?');
        $projet->execute(array($ui['id']));
        foreach($projet AS $pj) {
          $getCat = $bdd->prepare('SELECT nom FROM categorie WHERE id = ?');
          $getCat->execute(array($pj['idCategorie']));
          $cat = $getCat->fetch(PDO::FETCH_ASSOC);

            ?>
      <ul>
        <li name="name" id="name"><h3><?php echo $pj['name']; ?></h3></li>
        <li name="category" id="category"><?php echo $cat['nom']; ?></li>
        <li name="target" id="target"><?php echo $pj['target']; ?></li>
        <li name="funds" id="funds"><?php echo $pj['funds']; ?></li>
        <li name="desc" id="desc"><?php echo $pj['description']; ?></li>
        <li name="deadLine" id="deadLine"><?php echo $pj['deadLine']; ?></li>
        <li name="contribMin" id="contribMin"><?php echo $pj['contribMin']; ?></li>
        <li name="entryDate" id="entryDate"><?php echo $pj['entryDate']; ?></li>
        <li name="valid" id="valid"><?php echo $pj['valid']; ?></li>
      </ul>
      <?php
    }
}
      ?>
      <button onclick="modifyPj()">Modifier</button>

  </body>
  <script src="function.js"></script>
</html>
<?php } ?>
