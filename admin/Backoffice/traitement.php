<?php
require_once('../bddConnect.php');
// On déclare le formulaire modifié
if (isset($_POST['user'])) {
  $choice = $_POST['user'];
  $action = 'user';
}
else if (isset($_POST['projet'])){
  $choice = $_POST['projet'];
  $action = 'projet';
}
else if (isset($_POST['categorie'])) {
  $choice = $_POST['categorie'];
  $action = 'categorie';
}
else if (isset($_POST['commentaire'])) {
  $choice = $_POST['commentaire'];
  $action = 'commentaire';
}
if (isset($_POST['email'])) {
  $mail = $_POST['email'];
}
if (isset($_POST['id'])) {
  $id = $_POST['id'];
}

// Si la modification est demandée sur un influenceur

if ($action == 'user') {
if ($choice == 'Modifier') {
    include('updateUser.php');
}
else if ($choice == 'Bannir') {
  header('Location: index.php');
  $query = $bdd->prepare('DELETE FROM projet WHERE idUser = :id');
  $query->bindValue(':id', $id, PDO::PARAM_STR);
  $query->execute();
  $query = $bdd->prepare('DELETE FROM commentaire WHERE idUser = :id');
  $query->bindValue(':id', $id, PDO::PARAM_STR);
  $query->execute();
  $query = $bdd->prepare('DELETE FROM contribution WHERE idUser = :id');
  $query->bindValue(':id', $id, PDO::PARAM_STR);
  $query->execute();
  $query = $bdd->prepare('DELETE FROM user WHERE id = :id');
  $query->bindValue(':id', $id, PDO::PARAM_STR);
  $query->execute();
}
}

// Si la modification est demandée sur un projet

if ($action == 'projet'){
if ($choice == 'Modifier') {
    include('updateProjet.php');
}
else if ($choice == 'Supprimer') {
  header('Location: index.php');
  $query = $bdd->prepare('DELETE FROM projet WHERE id = :id');
  $query->bindValue(':id', $id, PDO::PARAM_STR);
  $query->execute();
}
}

// Si la modification est demandée sur une catégorie

if ($action == 'categorie') {
if ($choice == 'Modifier') {
    include('updateCategorie.php');
}
else if ($choice == 'Ajouter') {
  include('createCategorie.php');
}
else if ($choice == 'Supprimer') {
  header('Location: index.php');
  $query = $bdd->prepare('DELETE FROM categorie WHERE id = :id');
  $query->bindValue(':id', $id, PDO::PARAM_STR);
  $query->execute();
}
}
// Si la modification est demandée sur un commentaire

if ($action == 'commentaire'){
if ($choice == 'Supprimer') {
  header('Location: index.php');
  $query = $bdd->prepare('DELETE FROM commentaire WHERE id = :id');
  $query->bindValue(':id', $id, PDO::PARAM_STR);
  $query->execute();
}
}
