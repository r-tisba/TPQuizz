<?php
require_once "../membre/entete.php";
$utilisateur = new Utilisateur($_SESSION["pseudo"]);

if(!isset($_SESSION["pseudo"]))
{
  header("location:../visiteur/index.php");
}
if($_SESSION["idRole"] == 2)
{
  header("location:../admin/index.php");
}

?>
Vous êtes connecté <?= $utilisateur->getPseudo(); ?>
