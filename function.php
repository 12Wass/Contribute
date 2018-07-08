<?php
 /* Ce fichier regroupe toutes les fonctions qui seront utilisées/appelées
    par les fichiers du site. Il ne stockera pas tous les appels PHP
    mais réuniras ceux qui sont compactables. */
    session_start();
    require_once('admin/bddConnect.php');

switch($_POST['functionSelect']) {

  case 'registerUser'; // This functions adds an user into our databases
    // require_once('admin/password_encryption.php');
    // On vérifie l'existence des variables :
    header("Location: index.php"); 
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



  default:
  echo 'Erreur, fonction inexistante.';
  break;
}
