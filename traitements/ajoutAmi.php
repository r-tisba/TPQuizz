<?php
session_start();
require_once "../Modele/Modele.php";
require_once "../Modele/Utilisateur.php";
$utilisateur = new Utilisateur();

$idUtilisateur = $_SESSION["idUtilisateur"];



if (!empty($_GET["id"])) 
{
    $idUtilisateurCible = $_GET["id"];
    
    print_r($idUtilisateur);
    print_r($idUtilisateurCible);

    /*
    if($utilisateur->verifAmitie($idUtilisateur, $idUtilisateurCible) == true)
    {
        */
        if($utilisateur->ajoutAmi($idUtilisateur, $idUtilisateurCible) == true)
        {
            header("location:/admin/listeUtilisateurs.php?success=ajoutAmi");
        } else {
        header("location:/admin/listeUtilisateurs.php?error=ajoutAmi");
        }
        /*
    } else {
        header("location:/admin/listeUtilisateurs.php?error=verifAmi");
    }
    */
} else {
    header("location:/admin/listeUtilisateurs.php?error=missingid");
}