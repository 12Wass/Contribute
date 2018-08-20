<?php
session_start();
require_once('admin/bddConnect.php');
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
          // On va générer le code de validation de compte et l'insérer dans le champ "code" de "user".
          $length = 7;
          $code = bin2hex(random_bytes($length));
          $createUser = $bdd->prepare("INSERT INTO user(lastName, firstName, username, address, city, postalCode, email, password, dateReg, lastConnection, code) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW(), ?)");
          $createUser->execute(array($lastName, $firstName, $username, $address, $city, $postalCode, $email, password_hash($password, PASSWORD_DEFAULT), $code));
          // Ici on envoie le mail qui contiendra le-dit code généré plus haut.
          if(isset($_POST['mailform']))
          {
            $header="MIME-Version: 1.0\r\n";
            $header.='From:"Contribute Register" <support@contribute.com>'."\n";
            $header.='Content-Type:text/html; charset="utf-8"'."\n";
            $header.='Content-Transfer-Encoding: 8bit';

            $message='
            <html>
              <body>
                  <h1>Bienvenue sur Contribute!</h1>
                <div>
                  <p>Confirmez dès maintenant votre inscription cliquant sur ce lien.
                  <a href="http://localhost/Contribute/Main/validAccount.php?code='. $code .'">Confirmer</a>. <br>
                  Si vous n\'arrivez pas à accéder au lien, collez le code à l\'adresse suivante : <br>
                  '. $code .' </p>
                  <p>Si ce n\'était pas vous, ignorez cet email.</p>
                </div>
              </body>
            <html>
            ';
            mail($_POST['email'], "Bienvenue sur Contribute!", $message, $header);
            echo '<p>Vous êtes bien enregistré sur Contribute.<br>Pour continuer, vérifiez vos mails et validez votre compte.</p>
                  <p>Retournez à l\'index <a href="index.php">ici</a></p>';

          }
      }
      // A partir d'ici on gère les cas d'erreur : Si l'username est déjà utilisé
        else
        {
          echo 'Le nom d\'utilisateur est déjà utilisé';
        }
      }

      else
      {
        echo 'Les mots de passe ne correspondent pas';
      }
    }

    else
    {
      echo 'L\'adresse mail existe déjà. Connectez-vous <a href="connection.php">ici</a>.';
    }
?>
