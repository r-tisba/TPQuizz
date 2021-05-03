<?php
require_once "../Modele/Modele.php";
require_once "../Modele/Utilisateur.php";
session_start();
$idUtilisateur = $_SESSION["idUtilisateur"];
$utilisateur = new Utilisateur($idUtilisateur);
if(!empty($_POST["pseudo"]))
{
    extract($_POST);
    $nouvPseudo=$utilisateur->modifierPseudo($pseudo, $idUtilisateur);
    if($nouvPseudo==true){
        header("location:../admin/modifierPseudo.php?success=modification");
    }else{
        header("location:../admin/modifierPseudo.php?error=modification");

    }

}else{
    header("location:../admin/modifierPseudo.php?error=pseudo");
}


