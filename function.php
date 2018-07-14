<?php
 /* Ce fichier regroupe toutes les fonctions qui seront utilisées/appelées
    par les fichiers du site. Il ne stockera pas tous les appels PHP
    mais réuniras ceux qui sont compactables. */
    session_start();
    require_once('admin/bddConnect.php');

switch($_POST['functionSelect']) {

case 'connectUser';
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
}(

case 'modifyIdentity';
// Modification du profil - partie Identité
  if (isset($_POST['lastName'])){

  }
  else {

  }
break;












/* --------- INSCRIPTION : fonction registerUser() dépréciée, ne fonctionne pas ----------
case 'registerUser';
if (empty($_POST['mail']) ||
    empty($_POST['password']) ||
    empty($_POST['verifPassword']))
    {
      include('erreurInscription.php?error=manquant');
    }
else {
// On initialise les variables :
$mail = htmlspecialchars($_POST['mail']);
$password = htmlspecialchars($_POST['password']);

// On fais le check-up

$count = $bdd->prepare("SELECT COUNT(*) AS nbrMail FROM user WHERE email = ?");
$count->execute(array($mail));
$req = $count->fetch(PDO::FETCH_ASSOC);

if($req['nbrMail'] == 0) // L'adresse mail n'existe pas donc on peut vérifier le Pseudo
{
  $username = $bdd->prepare("SELECT COUNT(*) AS nbrUsername FROM user WHERE username = ?");
  $username->execute(array($_POST['username']));
  $userExist = $username->fetch(PDO::FETCH_ASSOC);

    if ($userExist['nbrUsername'] == 0)
    {
      $req = $bdd->prepare('INSERT INTO user(lastName, firstName, username, address, city, postalCode, email, password, dateReg) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())');
      $req->execute(array($_POST['lastName'], $_POST['firstName'], $_POST['username'], $_POST['address'], $_POST['city'], $_POST['postalCode'], $_POST['mail'], password_hash($password, PASSWORD_DEFAULT)));

        $_SESSION['flag'] = true;
        $_SESSION['mail'] = $mail;
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
}
break;
*/
  default:
  echo 'Erreur, fonction inexistante.';
  break;
}
