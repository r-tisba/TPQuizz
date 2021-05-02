<?php
require_once "../Modele/Modele.php";
require_once "../Modele/Categorie.php";

$categorie = new Categorie();

if (!empty($_GET["id"]))
{
    $idCategorie = $_GET["id"];

    if($categorie->supprimerCategorie($idCategorie) == true)
    {
        header("location:../admin/index.php?success=suppression&id=$idCategorie");
    } else {
        header("location:../admin/index.php?error=erreursuppression&id=$idCategorie");
    }

} else {
    header("location:../admin/index.php?error=missingId&id=$idCategorie");
}