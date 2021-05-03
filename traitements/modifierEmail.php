<?php
require_once "../Modele/Modele.php";
require_once "../Modele/Utilisateur.php";
session_start();
$idUtilisateur = $_SESSION["idUtilisateur"];
$utilisateur = new Utilisateur($idUtilisateur);
if(!empty($_POST["email"]))
{
    extract($_POST);
    $nouvEmail=$utilisateur->modifierEmail($email, $idUtilisateur);
    if($nouvEmail==true){
        header("location:../admin/modifierEmail.php?success=modification");
    }else{
        header("location:../admin/modifierEmail.php?error=modification");

    }

}else{
    header("location:../admin/modifierEmail.php?error=email");
}