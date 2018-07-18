<?php
 /* Ce fichier regroupe toutes les fonctions qui seront utilisées/appelées
    par les fichiers du site. Il ne stockera pas tous les appels PHP
    mais réuniras ceux qui sont compactables. */
    session_start();
    require_once('admin/bddConnect.php');

switch($_POST['functionSelect']) {

case 'connectUser'; ////////////////////////////////////////////////////////////////////////////////////
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
}
else {
  echo 'Un des champs demandés n\'est pas rempli.';
}
break;



case 'generateIdForm'; ////////////////////////////////////////////////////////////////////////////////////
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




case 'modifyIdentity'; ////////////////////////////////////////////////////////////////////////////////////
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

case 'modifyAddress'; ////////////////////////////////////////////////////////////////////////////////////
$getInfos = $bdd->prepare('SELECT address, city, postalCode FROM user WHERE email = ?');
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







  default:
  echo 'Erreur, fonction inexistante.';
  break;
}
