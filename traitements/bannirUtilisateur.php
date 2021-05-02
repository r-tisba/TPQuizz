<?php
require_once "../Modele/Modele.php";
require_once "../Modele/Utilisateur.php";

$utilisateur = new Utilisateur();

if (!empty($_GET["id"])) 
{
    $idUtilisateur = $_GET["id"];

    if($_GET["action"]==1)
    {
        if($utilisateur->bannirUtilisateur($idUtilisateur) == true)
        {
            header("location:../admin/listeUtilisateurs.php?success=bannissement");
        } else {
            header("location:../admin/listeUtilisateurs.php?error=fonction");
        }
    } else if($_GET["action"]==2)
    {
        if($utilisateur->debannirUtilisateur($idUtilisateur) == true)
        {
            header("location:../admin/listeUtilisateursBannis.php?success=deban");
        } else {
            header("location:../admin/listeUtilisateursBannis.php?error=fonction");
        }
    }
} else {
    header("location:../admin/listeUtilisateurs.php?error=missingid");
}