<?php
session_start();
require_once "../Modele/Modele.php";
require_once "../Modele/Application.php";
require_once "../Modele/Quiz.php";
require_once "../Modele/Utilisateur.php";
require_once "../Modele/Categorie.php";
require_once "../Modele/Question.php";
require_once "../Modele/Reponse.php";
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz'Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../styleQuiz.css">
    <link rel="shortcut icon" href="logo.png" type="image/x-icon">
</head>

<body>
<nav class="navbar navbar-dark navbar-expand-md bg-dark">
  <a class="navbar-brand" href="index.php">
    <img src="../images/design/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
    Quiz'Up
  </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">

        <?php
        if(!empty($_SESSION["pseudo"]))
        {
        ?>   
        <li class="nav-item">
          <a class="nav-item nav-link" href="listeUtilisateurs.php">Autres joueurs</a>
        </li>
        <li class="nav-item">
          <a class="nav-item nav-link" href="listeUtilisateursBannis.php">Joueurs bannis</a>
        </li>
        <li class="nav-item">
          <a class="nav-item nav-link" href="listeAmis.php">Amis</a>
        </li>
        <li class="nav-item">
          <a class="nav-item nav-link" href="profil.php">Mon profil</a>
        </li>
        <?php
        if($_SESSION["idRole"]==2){
          ?>
          <li class="nav-item">
          <a class="nav-item nav-link" href="validation.php">Quiz a valider</a>
        </li>
        <?php
        }  
        }
        ?>
      </ul> 
        <?php

        if (isset($_SESSION["pseudo"]) && !empty($_SESSION))
        {
          ?>
          
          <div class="div-inline my-2 my-lg-0">
            <a class="nav-item active nav-link" style="color: #00FF00;">
              <?= "Vous ??tes connect?? " . $_SESSION["pseudo"]?>
            </a>
          </div>
          <a class="btn btn-outline-danger ml-1" href="../admin/deconnexion.php">Se d??connecter</a>
          
          <?php
        } else {
          ?>
          <a class="btn btn-outline-success ml-auto" href="inscription.php">S'inscrire</a>
          <a class="btn btn-outline-primary ml-1" href="connexion.php">Se connecter</a> 
          <?php
        }
        ?>
    </div> 
</nav>
<div class="container mt-4">
