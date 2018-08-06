<?php /*
  session_start();
  var_dump($_SESSION);
  require_once('admin/bddConnect.php');
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Accueil - Contribute</title>
  </head>
  <body>
    <h1>Bienvenue sur Contribute</h1>
    <div name="menu_principal">
  <p>Inscrivez-vous <a href="register.php">ici</a><br>
     Connectez-vous <a href="connection.php">ici</a>.<br>
     Déconnectez-vous <a href="disconnect.php">ici</a>.<br>
     Accédez à votre profil <a href="profil.php">ici</a>.<br>
  </p>
    </div>
    <div name="projets">
<h2>Projets </h2>
  <?php
    $req = $bdd->query('SELECT * FROM projet');
    $pj = $req->fetch(PDO::FETCH_ASSOC);
    $pro = $pj;
      foreach($pro AS $p) {
        ?>
      <p><?php var_dump($p); ?></p>

      <?php
    }
    ?>
    </div>

  </body>
</html>
*/ ?>
<?php
  session_start();
  require_once('admin/bddConnect.php');
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h1>Bienvenue sur Contribute</h1>
    <nav>
      <ul>
    <?php if (isset($_SESSION['flag']) && $_SESSION['flag'] == true) { ?>
          <li><a href="addProject.php">Ajoutez un projet</a></li>
          <li><a href="myProjects.php">Gérez vos projets</a></li>
          <li><a href="profil.php">Votre profil</a></li>
          <li><a href="disconnect.php">Déconnexion</a></li>
      <?php } else { ?>
          <li><a href="connection.php">Connexion</a></li>
          <li><a href="register.php">Inscription</a></li>
          <li><a href="searchProject.php">Recherchez un projet</a></li>
      <?php
          }
      ?>
      </ul>
    </nav>
  </body>
</html>
