<?php
require('../bddConnect.php');

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Dashboard - All-Wallet</title>

    <link href="css/style.css" rel="stylesheet">
      <link href="css/dashboard.css" rel="stylesheet">
  </head>

  <body>
		<!-- Navigation, titre, recherche - Barre du haut -->
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">All-Wallet</a>
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="#">Déconnexion</a>
          <!-- logo -->
        </li>
      </ul>
    </nav>
    <!-- Menu de navigation latéral  -->
    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link" href="#users">
                  <span data-feather="users"></span>
                  Users
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#projet">
                  <span data-feather="layers"></span>
                  Projet
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#cat">
                  <span data-feather="file"></span>
                  Categorie
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#com">
                  <span data-feather="file"></span>
                  Commentaires
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#contrib">
                  <span data-feather="file"></span>
                  Contribution
                </a>
              </li>
            </ul>
          </div>
        </nav>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="align-items-center pb-2 mb-3 border-bottom">
             <h6>Bienvenue sur la page d'administration de All Wallet.</h6>
          </div>
         <h2 id="users">Users</h2>
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nom</th>
                  <th>Prénom</th>
                  <th>Image</th>
                  <th>Username</th>
                  <th>Adresse</th>
                  <th>Ville</th>
                  <th>Departement</th>
                  <th>Description</th>
                  <th>Email</th>
                  <th>N° téléphone</th>
                  <th>Validé</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>

<!-- Récupération des données Users -->
                <?php
                    $req = $bdd->query('SELECT * FROM user');
                      foreach($req AS $users) {
                ?>
    <tr>
        <td> <?php echo $users['id'];?> </td>
        <td> <?php echo $users['lastName'];?> </td>
        <td> <?php echo $users['firstName'];?> </td>
        <td> <?php echo $users['picture'];?> </td>
        <td> <?php echo $users['username'];?> </td>
        <td> <?php echo $users['address'];?> </td>
        <td> <?php echo $users['city'];?> </td>
        <td> <?php echo $users['postalCode'];?> </td>
        <td> <?php echo $users['description'];?> </td>
        <td> <?php echo $users['email'];?> </td>
        <td> <?php echo $users['phone'];?> </td>
        <td> <?php echo $users['valid'];> ?></td>
        <td>
          <form action="traitement.php" method="post">
            <select name="user" id="user">
                <option value="Bannir">Bannir</option>
                <option value="Modifier">Modifier</option>
          	</select>
        </td>
        <!-- Grâce aux hidden, on fait transiter les variables d'une page à l'autre -->
                    <input id="id" name="id" type="hidden" value="<?php echo $users['id']; ?>"/>

        <td><input type="submit" value="Valider"/></td>
          </form>
    </tr>
            <?php } // Fermeture des boucles ?>

              </tbody>
            </table>
          </div>


          <h2 id="projet">Projet</h2>
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Catégorie</th>
                  <th>User</th>
                  <th>Nom</th>
                  <th>Objectif</th>
                  <th>Fonds récolté</th>
                  <th>Description</th>
                  <th>Dead line</th>
                  <th>Contribution minimum</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>

<!-- Récupération des données de Projet -->
<?php
$req = $bdd->query('SELECT * FROM projet');
foreach($req AS $projet) {
  //recup la cat
  $catReq = $bdd->prepare('SELECT nom FROM categorie WHERE id = ?');
  $catReq->execute(array($projet['idCategorie']));
  $projetCat = $catReq->fetch();
  // recup l'user
  $userReq = $bdd->prepare('SELECT username FROM user WHERE id = ?');
  $userReq->execute(array($projet['idUser']));
  $projetUser = $userReq->fetch();
?>
                <tr>
                  <td> <?php echo $projet['id']; ?> </td>
                  <td> <?php echo $projetCat['nom'];?> </td>
                  <td> <?php echo $projetUser['username'];?> </td>
                  <td> <?php echo $projet['name'];?> </td>
                  <td> <?php echo $projet['target'];?> €</td>
                  <td> <?php echo $projet['funds'];?> €</td>
                  <td> <?php echo $projet['description'];?> </td>
                  <td> <?php echo $projet['deadLine']; ?> </td>
                  <td> <?php echo $projet['contribMin']; ?> €</td>

                  <form action="traitement.php" method="post">
                  <td><select name="projet" id="projet">
                  		<option value="Supprimer">Supprimer</option>
                  		<option value="Modifier">Modifier</option>
                  	</select>
                  </td>

                  <input id="id" name="id" type="hidden" value="<?php echo $projet['idUser']; ?>"/>
                  <td><input type="submit" value="Valider" /></td>
              </form>
                </tr>

<?php }?>
              </tbody>
            </table>
          </div>
          <h2 id="cat">Catégorie</h2>
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nom</th>
                  <th>Description</th>
                  <th>Action</th>
                    <form action="traitement.php" method="post">
                  <th><button name="categorie" id="categorie" type="submit" value="Ajouter">Ajouter</button></th>
                </form>
                </tr>
              </thead>
              <tbody>
<!-- Récupération des données Catégorie -->
<?php
$req = $bdd->query('SELECT * FROM categorie');
foreach($req AS $categorie) {
                ?>

                <tr>
                  <td> <?php echo $categorie['id']; ?> </td>
                  <td> <?php echo $categorie['nom'];?> </td>
                  <td> <?php echo $categorie['description'];?> </td>
                  <td>
                    <form action="traitement.php" method="post">
                  	<select name="categorie" id="categorie">
                  		<option value="Supprimer">Supprimer</option>
                  		<option value="Modifier">Modifier</option>
                  	</select>
                  </td>
                  <input id="id" name="id" type="hidden" value="<?php echo $categorie['id']; ?>"/>
                  <td>
                  	<input type="submit" value="Valider"/>
                  </td>
              </form>
                </tr>
              <?php } ?>

              </tbody>
            </table>
          </div>

          <h2 id="com">Commentaires</h2>
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Username</th>
                  <th>Le contenu</th>
                  <th>Date</th>
                  <th>Sur quel projet</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>


<!-- Récupération des données Utilisateur (tous confondu) -->
<?php
$req = $bdd->query('SELECT * FROM commentaire');
foreach($req AS $comInfo) {
  //recup de l'user
  $idUser = $comInfo['idUser'];
  $userReq = $bdd->prepare('SELECT username FROM user WHERE id = ?');
  $userReq->execute(array($idUser));
  $comUser = $userReq->fetch();
  //recup du projet
  $idProjet = $comInfo['idProjet'];
  $userReq = $bdd->prepare('SELECT name FROM projet WHERE id = ?');
  $userReq->execute(array($idProjet));
  $comProjet = $userReq->fetch();
                ?>
                <tr>
                  <td> <?php echo $comInfo['id']; ?> </td>
                  <td> <?php echo $comUser['username'];?> </td>
                  <td> <?php echo $comInfo['content'];?> </td>
                  <td> <?php echo $comInfo['date'];?> </td>
                  <td> <?php echo $comProjet['name'];?> </td>
                  <form action="traitement.php" method="post">
                  <td>
                  	<button name="commentaire" id="commentaire" type="submit" value="Supprimer">Supprimer</button>
                  </td>

                  <input id="id" name="id" type="hidden" value="<?php echo $comInfo['id']; ?>">
              </form>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>

          <h2 id="contrib">Contribution</h2>
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Projet</th>
                  <th>Username</th>
                  <th>Montant</th>
                </tr>
              </thead>
              <tbody>


<!-- Récupération des données Utilisateur (tous confondu) -->
<?php
$req = $bdd->query('SELECT * FROM contribution');
foreach($req AS $comInfo) {
  //recup de l'user
  $idUser = $comInfo['idUser'];
  $userReq = $bdd->prepare('SELECT username FROM user WHERE id = ?');
  $userReq->execute(array($idUser));
  $comUser = $userReq->fetch();
  //recup du projet
  $idProjet = $comInfo['idProjet'];
  $userReq = $bdd->prepare('SELECT name FROM projet WHERE id = ?');
  $userReq->execute(array($idProjet));
  $comProjet = $userReq->fetch();
                ?>
                <tr>
                  <td> <?php echo $comInfo['id']; ?> </td>
                  <td> <?php echo $comProjet['name'];?> </td>
                  <td> <?php echo $comUser['username'];?> </td>
                  <td> <?php echo $comInfo['amount'];?> €</td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
        </main>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../../../assets/js/vendor/popper.min.js"></script>
    <script src="../../../../dist/js/bootstrap.min.js"></script>
  </body>
</html>
