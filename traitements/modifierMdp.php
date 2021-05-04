<?php
require_once "../Modele/Modele.php";
require_once "../Modele/Utilisateur.php";
session_start();
$idUtilisateur = $_SESSION["idUtilisateur"];
$utilisateur = new Utilisateur($idUtilisateur);

if (strlen($_POST["mdp"]) >= 6) 
    {
    if($_POST["mdp"] == $_POST["verifMdp"])
    {
        extract($_POST);
        $mdp = password_hash($mdp, PASSWORD_BCRYPT);
        if ($utilisateur->modifierMdp($mdp, $idUtilisateur) == true) 
        {
            header("location:../admin/modifierMdp.php?success=modification");
                
        } else {
                header("location:../admin/modifierMdp.php?error=modification");
                }
    } else {
                header("location:../admin/modifierMdp.php?error=mdpnotsame");
            }
}else {
    header("location:../admin/modifierMdp.php?error=mdplength");
}