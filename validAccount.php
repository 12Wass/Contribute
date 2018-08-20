<?php
session_start();
require_once('admin/bddConnect.php');
if (isset($_SESSION)) {
  echo 'Vous êtes déjà connecté sur Contribute.';
}
else {


?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>ACCOUNT VALIDATION</title>
  </head>
  <body>
    <?php
    if (isset($_POST['verifyCode'])) {

        $vC = $bdd->prepare('SELECT * FROM user WHERE code = ?');
        $vC->execute(array($_POST['code']));
        $userInfo = $vC->fetch(PDO::FETCH_ASSOC);
          if (!empty($userInfo)) {
            $valid = $bdd->prepare('UPDATE user SET valid = 1 WHERE code = ?');
            $valid->execute(array($_POST['code']));
              echo 'Bienvenue,'. $userInfo['username'] .' votre compte est validé. Cliquez <a href="index.php">ici</a> pour être redirigé à l\'accueil';
          }
      }
      else if(isset($_GET['code']) && !empty($_GET['code'])) {
        $req = $bdd->prepare('SELECT * FROM user WHERE code = ?');
        $req->execute(array($_GET['code']));
        $getCode = $req->fetch(PDO::FETCH_ASSOC);

          $valid = $bdd->prepare('UPDATE user SET valid = 1 WHERE code = ?');
          $valid->execute(array($_GET['code']));
            echo 'Bienvenue,'. $userInfo['username'] .' votre compte est validé. Cliquez <a href="index.php">ici</a> pour être redirigé à l\'accueil';
      }
      else {
?>
      <p>Entrez votre code ici</p>
      <form action="" method="post">
        <label for="code">Code</label>
        <input type="text" name="code"></input>
        <input type="submit" name="verifyCode"></input>
      </form>

    <?php
   } 
    }
    ?>
  </body>
</html>
