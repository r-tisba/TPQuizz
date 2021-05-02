<?php
require_once "../Modele/Modele.php";
require_once "../Modele/Utilisateur.php";
session_start();

$utilisateur = new Utilisateur();
if($_SESSION["idUtilisateur"]){
    $idUtilisateur1=$_SESSION["idUtilisateur"];
    if (!empty($_GET["id"]))
    {
        $idUtilisateur2 = $_GET["id"];

        if($utilisateur->suprAmi($idUtilisateur1, $idUtilisateur2) == true)
        {
            header("location:../admin/listeAmis.php?success=suppression");
        } else {
            header("location:../admin/listeAmis.php?error=erreursuppression");
        }

    } else {
        header("location:../admin/listeAmis.php?error=erreurid");
    }
}else{
    header("location:../admin/listeAmis.php?error=erreursession");

}