<?php
require_once "../Modele/Modele.php";
require_once "../Modele/Categorie.php";

$categorie = new Categorie();

if (!empty($_GET["id"])) 
{
    $idCategorie = $_GET["id"];
    if(!empty($_POST["nomCategorie"]))
    {
        if(!empty($_POST["illustration"]))
        {
            extract($_POST);
            if($categorie->modifierCategorie($idCategorie, $nomCategorie, $illustration) == true)
            {
                header("location:../admin/modifierCategorie.php?success=modification&id=$idCategorie");
            } else {
                header("location:../admin/modifierCategorie.php?error=fonction&id=$idCategorie");
            }
        } else {
            header("location:../admin/modifierCategorie.php?error=illustration&id=$idCategorie");
        }
    } else {
        header("location:../admin/modifierCategorie.php?error=nomCategorie&id=$idCategorie");
    }
} else {
    header("location:../admin/modifierCategorie.php?error=missing&id=$idCategorie");
}