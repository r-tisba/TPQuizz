<?php
session_start();
require_once "../Modele/Modele.php";
require_once "../Modele/Reponse.php";
require_once "../Modele/Question.php";

$idUtilisateur = $_SESSION["idUtilisateur"];

$idReponse = $_POST["idReponse"];

$objetReponse = new Reponse($idReponse);

$idQuestion = $objetReponse->getIdQuestion();
$objetQuestion = new Question($idQuestion);
$idQuiz = $objetQuestion->getIdQuiz();
print_r($idQuiz);

if($objetReponse->enregistrerReponse($idUtilisateur, $idQuestion, $idReponse) == true)
{
    print_r("true");
    
    header("location:../Quiz/jeu.php?id=$idQuiz");
    

} else {
    print_r("false");
}
