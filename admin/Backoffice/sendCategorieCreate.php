<?php
require_once('../bddConnect.php');
header('Location: index.php');

$req = $bdd->prepare('SELECT * FROM categorie');
$req->execute(array());
$catInfo = $req->fetch();

  if ($_POST['nomEdit'] != $catInfo['nom']){
    $query = $bdd->prepare('INSERT INTO categorie(nom, description) VALUES (?, ?)');
    $query->execute(array($_POST['nomEdit'], $_POST['descriptionEdit']));
  }

?>
