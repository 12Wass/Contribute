<?php
session_start();
require_once('admin/bddConnect.php');
header('Location: index.php');
  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $address = $_POST['address'];
  $city = $_POST['city'];
  $postalCode = $_POST['postalCode'];
  $email = $_POST['email'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $verifPassword = $_POST['verifPassword'];

// Après avoir initialiser toutes les variables (faire un contrôle d'erreur en cas d'oubli)
// On vérifie l'existence d'une adresse mail qui serai égale à celle entrée, pareillement pour l'username

  $checkMail = $bdd->prepare("SELECT COUNT(*) AS nbrMail FROM user WHERE email = ?");
  $checkMail->execute(array($email));
  $mailExists = $checkMail->fetch(PDO::FETCH_ASSOC);

if($mailExists['nbrMail'] == 0) // Si l'email n'est pas utilisé
  {
    if($password == $verifPassword) // Si les mots de passes rentrés correspondent
    {
      $checkUsr = $bdd->prepare("SELECT COUNT(*) AS nbrUser FROM user WHERE username = ?");
      $checkUsr->execute(array($username));
      $userExists = $checkUsr->fetch(PDO::FETCH_ASSOC);
        if($userExists['nbrUser'] == 0) // Ici tout est bon, utilisateur recevable.
        {
          $createUser = $bdd->prepare("INSERT INTO user(lastName, firstName, username, address, city, postalCode, email, password, dateReg, lastConnection) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())");
          $createUser->execute(array($lastName, $firstName, $username, $address, $city, $postalCode, $email, password_hash($password, PASSWORD_DEFAULT)));
          // Ici on créée les variables de session et on connecte l'utilisateur fraîchement inscrit à Contribute
          $connect = $bdd->prepare("SELECT username, firstName, lastName, email FROM user WHERE email = ?");
          $connect->execute(array($email));
          $userInfos = $connect->fetch(PDO::FETCH_ASSOC);
          $_SESSION['flag'] = true;
          $_SESSION['email'] = $userInfos['email'];
          $_SESSION['firstName'] = $userInfos['firstName'];
          $_SESSION['lastName'] = $userInfos['lastName'];
          $_SESSION['username'] = $userInfos['username'];
      }
      // A partir d'ici on gère les cas d'erreur : Si l'username est déjà utilisé
        else
        {
          echo 'username used';
        }
      }

      else
      {
        echo 'Les mots de passe ne correspondent pas';
      }
    }

    else
    {
      echo 'L\'adresse mail existe déjà';
    }
?>
