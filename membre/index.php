<?php
require_once "../membre/entete.php";
require_once "../Modele/Utilisateur.php";

$utilisateur = new Utilisateur($_SESSION["pseudo"]);
?>
Vous êtes connecté <?= $utilisateur->getPseudo(); ?>
