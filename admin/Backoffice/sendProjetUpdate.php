<?php
require_once('../bddConnect.php');
header('Location: index.php');
$idProjet = $_POST['id'];

  $req = $bdd->query('SELECT * FROM projet');
    foreach($req AS $projet) {

      if ($_POST['catEdit'] != $projet['idCategorie'] || !empty($_POST['catEdit'])) {
        $query = $bdd->prepare('UPDATE projet SET idCategorie = ? WHERE id = ?');
        $query->execute(array($_POST['catEdit'], $idProjet));
      }

      if ($_POST['nameEdit'] != $projet['name'] || !empty($_POST['nameEdit'])) {
        $query = $bdd->prepare('UPDATE projet SET name = ? WHERE id = ?');
        $query->execute(array($_POST['nameEdit'], $idProjet));
      }

      if ($_POST['targetEdit'] != $projet['target'] || !empty($_POST['targetEdit'])) {
        $query = $bdd->prepare('UPDATE projet SET target = ? WHERE id = ?');
        $query->execute(array($_POST['targetEdit'], $idProjet));
      }

      if ($_POST['descriptionEdit'] != $projet['description'] || !empty($_POST['descriptionEdit'])) {
        $query = $bdd->prepare('UPDATE projet SET description = ? WHERE id = ?');
        $query->execute(array($_POST['descriptionEdit'], $idProjet));
      }

      if ($_POST['deadLineEdit'] != $projet['deadLine'] || !empty($_POST['deadLineEdit'])) {
        $query = $bdd->prepare('UPDATE projet SET deadLine = ? WHERE id = ?');
        $query->execute(array($_POST['deadLineEdit'], $idProjet));
      }

      if ($_POST['contribMinEdit'] != $projet['contribMin'] || !empty($_POST['contribMinEdit'])) {
        $query = $bdd->prepare('UPDATE projet SET contribMin = ? WHERE id = ?');
        $query->execute(array($_POST['contribMinEdit'], $idProjet));
      }
}
?>
