<?php
require_once "../admin/entete.php";
$utilisateur = new Utilisateur($_SESSION["pseudo"]);
$application = new Application();

$idQuiz = $_GET["id"];
$quiz = new Quiz($_GET["id"]);

/*
echo "<pre>";
print_r($quiz->getQuestions());
echo "</pre>";
*/

$questions = $quiz->getQuestions();
$nQ = 1;
foreach($questions as $question)
{
    $idQuestion = $question->getIdQuestion();
    $objetQuestion = new Question($idQuestion);
    $nR = 1;

    echo "<br>" . "Question " . $nQ . " : " . $objetQuestion->getQuestion() . "<br>";
    $nQ++;

    $reponses = $question->getReponses();
    foreach($reponses as $reponse)
    {
        $idReponse = $reponse->getIdReponse();
        $objetReponse = new Reponse($idReponse);

        echo "<br>" . "<div class='d-flex justify-content-center'>" . " Réponse " . $nR . " : " . $objetReponse->getReponse() . " </div>" . "<br>";
        $nR++;
    }
}

require_once "../admin/pied.php";