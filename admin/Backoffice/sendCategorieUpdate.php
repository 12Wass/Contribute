<?php
require_once('../bddConnect.php');
header('Location: index.php');
$idCat = $_POST['id'];

$req = $bdd->prepare('SELECT * FROM categorie WHERE id = ?');
$req->execute(array($_POST['id']));
$catInfo = $req->fetch();

  if ($_POST['nomEdit'] != $catInfo['nom'] || !empty($_POST['nomEdit'])) {
    $query = $bdd->prepare('UPDATE categorie SET nom = ? WHERE id = ?');
    $query->execute(array($_POST['nomEdit'], $idCat));
  }
  if ($_POST['descriptionEdit'] != $catInfo['description'] || !empty($_POST['descriptionEdit'])) {
    $query = $bdd->prepare('UPDATE categorie SET description = ? WHERE id = ?');
    $query->execute(array($_POST['descriptionEdit'], $idCat));
  }

?>
