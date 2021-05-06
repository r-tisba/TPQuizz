<?php
require_once "../Modele/Modele.php";
require_once "../Modele/Utilisateur.php";
session_start();

$idUtilisateur = $_SESSION["idUtilisateur"];
$utilisateur = new Utilisateur($idUtilisateur);
$reponse=$utilisateur->questionSecrete($idUtilisateur);

if ($_POST["reponse"]==$reponse["reponse"]) 
    {
    header("location:../admin/modifierMdp.php");
                
        
} else {
    header("location:../admin/questionSecrete.php?error=reponse");
}