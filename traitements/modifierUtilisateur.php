<?php
require_once "../Modele/Modele.php";
require_once "../Modele/Utilisateur.php";

$utilisateur = new Utilisateur();

if (!empty($_GET["id"])) 
{
    $idUtilisateur = $_GET["id"];
    if(!empty($_POST["email"]))
    {
        if(!empty($_POST["pseudo"]))
        {
            if(!empty($_POST["idRole"]))
            {

                extract($_POST);
                if($utilisateur->modifierUtilisateur($email, $pseudo, $idRole, $idUtilisateur) == true)
                {
                    header("location:../admin/modifierUtilisateur.php?success=modification&id=$idUtilisateur");
                } else {
                    header("location:../admin/modifierUtilisateur.php?error=fonction&id=$idUtilisateur");
                }
            } else {
                header("location:../admin/modifierUtilisateur.php?error=idRole&id=$idUtilisateur");
            }
        } else {
            header("location:../admin/modifierUtilisateur.php?error=pseudo&id=$idUtilisateur");
        }
    } else {
        header("location:../admin/modifierUtilisateur.php?error=email&id=$idUtilisateur");
    }
} else {
    header("location:../admin/modifierUtilisateur.php?error=missing&id=$idUtilisateur");
}