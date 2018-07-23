<?php
session_start();
require_once('admin/bddConnect.php');

// On initialise les variables :
$mail = htmlspecialchars($_POST['mail']);
$password = htmlspecialchars($_POST['password']);

// On fais le check-up

$count = $bdd->prepare("SELECT COUNT(*) AS nbrMail FROM user WHERE email = ?");
$count->execute(array($mail));
$req = $count->fetch(PDO::FETCH_ASSOC);
echo 'jusquici'
if($req['nbrMail'] == 0) // L'adresse mail n'existe pas donc on peut vérifier le Pseudo
{
  $username = $bdd->prepare("SELECT COUNT(*) AS nbrUsername FROM user WHERE username = ?");
  $username->execute(array($_POST['username']));
  $userExist = $username->fetch(PDO::FETCH_ASSOC);
  echo 'nbrMailReq';

    if ($userExist['nbrUsername'] == 0)
    {
      $register = $bdd->prepare("INSERT INTO user(lastName, firstName, username, address, city, postalCode, email, password, dateReg, lastConnection) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())");
      $register->execute(array($_POST['lastName'], $_POST['firstName'], $_POST['username'], $_POST['address'], $_POST['city'], $_POST['postalCode'], $_POST['mail'], password_hash($password, PASSWORD_DEFAULT)));
      $connect = $bdd->prepare("SELECT username, firstName, lastName, email FROM user WHERE email = ?");
      $connect->execute(array($mail));
      $userInfos = $connect->fetch(PDO::FETCH_ASSOC);
      var_dump($_POST); echo '<br> ____________'; var_dump($userInfos); var_dump($req)
      $_SESSION['flag'] = true;
      $_SESSION['email'] = $userInfos['email'];
      $_SESSION['firstName'] = $userInfos['firstName'];
      $_SESSION['lastName'] = $userInfos['lastName'];
      $_SESSION['username'] = $userInfos['username'];
  }
    else
    {
    include('errorInscription.php?usernameExists');
    echo 'Erreur, nom d\'utilisateur déjà utilisé';
    }
  }
  else {
    include('errorInscription.php?mailExists');
    echo 'Erreur, mail déjà utilisé';
  }

?>
