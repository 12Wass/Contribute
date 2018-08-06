<?php
require_once('../bddConnect.php');
header('Location: index.php');
$idUser = $_POST['id'];

  $req = $bdd->query('SELECT * FROM user');
    foreach($req AS $users) {

      if ($_POST['firstNameEdit'] != $users['firstName'] || !empty($_POST['firstNameEdit'])) {
        $query = $bdd->prepare('UPDATE user SET firstName = ? WHERE id = ?');
        $query->execute(array($_POST['firstNameEdit'], $idUser));
      }

      if ($_POST['lastNameEdit'] != $users['lastName'] || !empty($_POST['lastNameEdit'])) {
        $query = $bdd->prepare('UPDATE user SET lastName = ? WHERE id = ?');
        $query->execute(array($_POST['lastNameEdit'], $idUser));
      }

      if ($_POST['usernameEdit'] != $users['username'] || !empty($_POST['usernameEdit'])) {
        $query = $bdd->prepare('UPDATE user SET username = ? WHERE id = ?');
        $query->execute(array($_POST['usernameEdit'], $idUser));
      }

      if ($_POST['pictureEdit'] != $users['picture'] || !empty($_POST['pictureEdit'])) {
        $query = $bdd->prepare('UPDATE user SET picture = ? WHERE id = ?');
        $query->execute(array($_POST['pictureEdit'], $idUser));
      }

      if ($_POST['addressEdit'] != $users['address'] || !empty($_POST['addressEdit'])) {
        $query = $bdd->prepare('UPDATE user SET address = ? WHERE id = ?');
        $query->execute(array($_POST['addressEdit'], $idUser));
      }

      if ($_POST['cityEdit'] != $users['city'] || !empty($_POST['cityEdit'])) {
        $query = $bdd->prepare('UPDATE user SET city = ? WHERE id = ?');
        $query->execute(array($_POST['cityEdit'], $idUser));
      }

      if ($_POST['postalCodeEdit'] != $users['postalCode'] || !empty($_POST['postalCodeEdit'])) {
        $query = $bdd->prepare('UPDATE user SET postalCode = ? WHERE id = ?');
        $query->execute(array($_POST['postalCodeEdit'], $idUser));
      }

      if ($_POST['descriptionEdit'] != $users['description'] || !empty($_POST['descriptionEdit'])) {
        $query = $bdd->prepare('UPDATE user SET description = ? WHERE id = ?');
        $query->execute(array($_POST['descriptionEdit'], $idUser));
      }

      if ($_POST['emailEdit'] != $users['email'] || !empty($_POST['emailEdit'])) {
        $query = $bdd->prepare('UPDATE user SET email = ? WHERE id = ?');
        $query->execute(array($_POST['emailEdit'], $idUser));
      }

      if ($_POST['phoneEdit'] != $users['phone'] || !empty($_POST['phoneEdit'])) {
        $query = $bdd->prepare('UPDATE user SET phone = ? WHERE id = ?');
        $query->execute(array($_POST['phoneEdit'], $idUser));
      }
}
?>
