<?php
header('Location: profil.php');
require_once('admin/bddConnect.php');
$getInfos = $bdd->prepare('SELECT * FROM projet WHERE name = ?');
$getInfos->execute(array($_POST['oname']));
$projetInfos = $getInfos->fetch(PDO::FETCH_ASSOC);
// On vérifie l'existence du nouveau nom d'utilisateur (puisqu'il est unique)
        $updatePj = $bdd->prepare('UPDATE projet SET name = ?, description = ?,  contribMin = ?, target = ? WHERE id = ?');
        $updatePj->execute(array($_POST['name'], $_POST['desc'], $_POST['contribMin'], $_POST['target'],  $projetInfos['id']));
        var_dump($_POST);
        echo '<br>';
        var_dump($projetInfos);
 ?>
