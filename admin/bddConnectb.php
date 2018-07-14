<?php
try
{
  $bdd = new PDO('mysql:host=db746326267.db.1and1.com;dbname=db746326267;charset=utf8', 'db746326267', 'Contribute26!');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

?>
