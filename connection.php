<?php
  session_start();
  if (isset($_SESSION['flag'])) {
    echo 'Vous êtes déjà connecté'
  }
  else {
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Connexion - Contribute</title>
  </head>
  <body>

  </body>
</html>

<?php } ?>
