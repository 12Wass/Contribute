<?php
require_once("admin/bddConnect.php");
session_start();
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
            // Ici, la connexion s'effectue, on récupère tout ce dont on a besoin
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
?>
