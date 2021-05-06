<?php
require_once "../Modele/Modele.php";
require_once "../Modele/Quiz.php";

$quiz = new Quiz();

if (!empty($_GET["id"]))
{
    $idQuiz = $_GET["id"];

    if($quiz->supprimerQuiz($idQuiz) == true)
    {
        header("location:../admin/validation.php?success=suppression");
    } else {
        header("location:../admin/validation.php?error=erreursuppression");
    }
} else {
    header("location:../admin/validation.php?error=missingId");
}