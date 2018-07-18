<?php
require_once('admin/bddConnect.php');
session_start();
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
      }
    ?>
