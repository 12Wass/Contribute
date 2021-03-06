<?php
 /* Ce fichier regroupe toutes les fonctions qui seront utilisées/appelées
    par les fichiers du site. Il ne stockera pas tous les appels PHP
    mais réuniras ceux qui sont compactables. */
    session_start();
    require_once('admin/bddConnect.php');
switch($_POST['functionSelect']) {
case 'connectUser': ////////////////////////////////////////////////////////////////////////////////////
// Connecter un utilisateur sur Contribute :
if (isset($_POST['identifiant']) && isset($_POST['password']))
{
  $identifiant = $_POST['identifiant'];
  $password = $_POST['password'];
  // On vérifie la concordance de l'identifiant avec le nom d'utilisateur ou le mail
    $req = $bdd->prepare("SELECT password FROM user WHERE email OR username = ?");
    $req->execute(array($identifiant));
        if (!empty($req))
        {
          $realMdp = $req->fetch();
          if (password_verify($password, $realMdp['password']))
          {
            // Ici, la connexion s'effectue, on récupère tout ce dont on a besoin et on redirige
        header('Location: index.php');
            $connect = $bdd->prepare("SELECT username, firstName, lastName, email FROM user WHERE email OR username = ?");
            $connect->execute(array($identifiant));
            $userInfos = $connect->fetch(PDO::FETCH_ASSOC);
            $_SESSION['flag'] = true;
            $_SESSION['email'] = $userInfos['email'];
            $_SESSION['firstName'] = $userInfos['firstName'];
            $_SESSION['lastName'] = $userInfos['lastName'];
            $_SESSION['username'] = $userInfos['username'];
            $dateCo = $bdd->prepare("UPDATE user SET lastConnection = NOW() WHERE email OR username = ?");
            $dateCo->execute(array($identifiant));
            var_dump($_SESSION);
    }
  }
  else {
    echo 'Un des champs rempli est incorrect.';
  }
}
else {
  echo 'Un des champs demandés n\'est pas rempli.';
}
break;
case 'generateIdForm': ////////////////////////////////////////////////////////////////////////////////////
// Fonction permettant la génération d'un formulaire PHP pour modifier les informations Identité(profil)
if(isset($_POST['lastName']) && isset($_POST['firstName']) && isset($_POST['username'])){
  $lastName = $_POST['lastName'];
  $firstName = $_POST['firstName'];
  $username = $_POST['username'];
  include('includes/modifyForm.php');
}
else {
  echo 'merde';
}
break;
case 'modifyIdentity': ////////////////////////////////////////////////////////////////////////////////////
$getInfos = $bdd->prepare('SELECT lastName, firstName, username FROM user WHERE email = ?');
$getInfos->execute(array($_SESSION['email']));
$InfosList = $getInfos->fetch(PDO::FETCH_ASSOC);
// On vérifie l'existence du nouveau nom d'utilisateur (puisqu'il est unique)
  $count = $bdd->prepare('SELECT COUNT(*) AS nbrUsername FROM user WHERE username = ?');
  $count->execute(array($_POST['username']));
  $userExist = $count->fetch(PDO::FETCH_ASSOC);
  if ($userExist['nbrUsername'] == 0)
      {
        $updateId = $bdd->prepare('UPDATE user SET lastName = ?, firstName = ?, username = ? WHERE email = ?');
        $updateId->execute(array($_POST['lastName'], $_POST['firstName'], $_POST['username'],  $_SESSION['email']));
        $_SESSION['lastName'] = $_POST['lastName'];
        $_SESSION['firstName'] = $_POST['firstName'];
        $_SESSION['username'] = $_POST['username'];
      }
  else {
    echo 'testostérone';
  }
break;
// Modification de l'adresse
case 'modifyAddress': ////////////////////////////////////////////////////////////////////////////////////
$getInfos = $bdd->prepare('SELECT address, city, postalCode FROM user WHERE email = ?');
$getInfos->execute(array($_SESSION['email']));
$InfosList = $getInfos->fetch(PDO::FETCH_ASSOC);
// On vérifie l'existence du nouveau nom d'utilisateur (puisqu'il est unique)
        $updateId = $bdd->prepare('UPDATE user SET address = ?, city = ?, postalCode = ? WHERE email = ?');
        $updateId->execute(array($_POST['addressinfo'], $_POST['city'], $_POST['postalCode'],  $_SESSION['email']));
break;
case 'generateAddForm': ////////////////////////////////////////////////////////////////////////////////////
// Fonction permettant la génération d'un formulaire PHP pour modifier les informations Identité(profil)
if(isset($_POST['addressinfo']) && isset($_POST['city']) && isset($_POST['postalCode'])){
  $addressinfo = $_POST['addressinfo'];
  $city = $_POST['city'];
  $postalCode = $_POST['postalCode'];
  include('includes/modifyForm.php');
}
else {
  echo 'merde';
}
break;
case 'addProject':
  $user = $bdd->prepare("SELECT id FROM user WHERE email = ?");
  $user->execute(array($_SESSION['email']));
  $userId = $user->fetch(PDO::FETCH_ASSOC);
    // On redéfinis les variables plus plus de facilité

      $category = $_POST['selectedCategory'];
      $name = $_POST['projectName'];
      $description = $_POST['description'];
      $target = $_POST['target'];
      $deadline = $_POST['deadLine'];
      $contribMin = $_POST['contribMin'];

  $addProject = $bdd->prepare("INSERT INTO projet(idCategorie, idUser, name, target, description, deadLine, contribMin, entryDate) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())");
  $addProject->execute(array($category, $userId, $name, $target, $description, $deadline, $contribMin));
  echo 'Projet ajouté'; var_dump($_POST);
  var_dump($userId);
  var_dump($addProject);
break;

case 'generatePjForm': ////////////////////////////////////////////////////////////////////////////////////
// Fonction permettant la génération d'un formulaire PHP pour modifier les informations Identité(profil)
if(isset($_POST['projet'])){
  // On récupère les informations du projet
  $getPjInfos = $bdd->prepare('SELECT * FROM projet WHERE name = ? ');
  $getPjInfos->execute(array($_POST['projet']));
  $pj = $getPjInfos->fetch(PDO::FETCH_ASSOC);
  // On récupère le nom et la liste des catégories
  $getCat = $bdd->prepare('SELECT nom FROM categorie WHERE id = ? ');
  $getCat->execute(array($pj['idCategorie']));
  $cat = $getCat->fetch(PDO::FETCH_ASSOC);

  $name = $pj['name'];
  $category = $cat['nom'];
  $desc = $pj['description'];
  $deadLine = $pj['deadLine'];
  $contribMin = $pj['contribMin'];
  $funds = $pj['funds'];
  $target = $pj['target'];
  $_POST['id'] = $pj['id'];
  include('includes/modifyForm.php');
}
else {
  echo 'Erreur - Cliquez <a href="index.php">ici</a> pour être redirigé vers l\'index';
}
break;

case 'modPj': ////////////////////////////////////////////////////////////////////////////////////
// On vérifie l'unicité des valeurs (pour le nom notamment, qui doit être unique)
$getInfos = $bdd->prepare('SELECT * FROM projet WHERE name = ?');
$getInfos->execute(array($_POST['name']));
$projetInfos = $getInfos->fetch(PDO::FETCH_ASSOC);
// On vérifie l'existence du nouveau nom d'utilisateur (puisqu'il est unique)
        $updatePj = $bdd->prepare('UPDATE projet SET name = ?, description = ?,  contribMin = ?, target = ? WHERE id = ?');
        $updatePj->execute(array($_POST['name'], $_POST['desc'], $_POST['contribMin'], $_POST['target'],  $projetInfos['id']));
break;

// Fonction de modification d'adresse mail et de mot de passe : Checking d'identité
case 'askPassword': ////////////////////////////////////////////////////////////////////////////////////
// Fonction permettant la génération d'un formulaire PHP pour modifier les informations Identité(profil)
  include('includes/modifyForm.php');
break;

// Fonction de vérification du mot de passe entré et d'accès au formulaire de modification final

case 'checkPassword': ////////////////////////////////////////////////////////////////////////////////////
// On compare le mot de passe envoyé avec celui de la base de données (comme avec la connexion)
$password = $_POST['password'];
// On vérifie la concordance de l'identifiant avec le nom d'utilisateur ou le mail
  $req = $bdd->prepare("SELECT password FROM user WHERE email = ?");
  $req->execute(array($_SESSION['email']));
      if (!empty($req))
      {
        $realMdp = $req->fetch();
        if (password_verify($password, $realMdp['password'])){
          include('includes/modifyForm.php');
        }
        else {
          echo 'Mauvais mot de passe. Redirection <a href="profil.php">ici</a>';
        }
      }
      else {
        echo 'Mot de passe ou email inexistant.';
      }
break;

// Envoi de la modification du mot de passe vers la base de données
case 'sendPassMod': ////////////////////////////////////////////////////////////////////////////////////
  if($_POST['password'] == $_POST['verifPassword']){
    // Si les deux mots de passe rentrés correspondent
    $password = $_POST['password'];
    $req = $bdd->prepare('UPDATE user SET password = ? WHERE email = ?');
    $req->execute(array(password_hash($password, PASSWORD_DEFAULT), $_SESSION['email']));
    $header="MIME-Version: 1.0\r\n";
    $header.='From:"Contribute Register" <support@contribute.com>'."\n";
    $header.='Content-Type:text/html; charset="utf-8"'."\n";
    $header.='Content-Transfer-Encoding: 8bit';

    $message='
    <html>
      <body>
          <h1>Contribute : Votre mot de passe a bien été modifié.</h1>
        <div>
          <p>Alerte : Modification de mot de passe.<br>
          Le mot de passe du compte '. $_SESSION['email'] .' viens d\'être modifié. <br>
        </div>
      </body>
    <html>
    ';
    mail($_SESSION['email'], "Contribute : Modification de votre mot de passe", $message, $header);

    echo 'Votre mot de passe a bien été modifié. Veuillez vous reconnecter. <a href="index.php">Accueil</a>';
    // Déconnexion (même script que dans 'disconnect.php')
    $_SESSION = array();
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // Finalement, on détruit la session.
    session_destroy();
}

  else {
    echo 'Les deux mots de passes rentrés ne correspondent pas. Veuillez réessayer';
  }
break;

  default:
  echo 'Erreur, fonction inexistante.';
  break;
}
