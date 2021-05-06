<?php
require_once "../Modele/Modele.php";
require_once "../Modele/Quiz.php";

$quiz = new Quiz();

if (!empty($_GET["id"]))
{
    $idQuiz = $_GET["id"];

    if($quiz->validerQuiz($idQuiz)==true)
    {
        header("location:../admin/validation.php?success=valider");
    } else {
        header("location:../admin/validation.php?error=erreurvalider");
    }
} else {
    header("location:../admin/validation.php?error=missingId");
}