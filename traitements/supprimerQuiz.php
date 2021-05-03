<?php
require_once "../Modele/Modele.php";
require_once "../Modele/Quiz.php";

$quiz = new Quiz();

if (!empty($_GET["id"]) && !empty($_GET["idCat"]))
{
    $idQuiz = $_GET["id"];
    $idCategorie = $_GET["idCat"];

    if($quiz->supprimerQuiz($idQuiz) == true)
    {
        header("location:../admin/listeQuiz.php?success=suppression&id=$idCategorie");
    } else {
        header("location:../admin/listeQuiz.php?error=erreursuppression&id=$idCategorie");
    }
} else {
    header("location:../admin/listeQuiz.php?error=missingId&id=$idCategorie");
}