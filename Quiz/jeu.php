<?php
require_once "../Quiz/entete.php";
?> <link rel="stylesheet" href="../Quiz/styleJeu.css"> <?php

$utilisateur = new Utilisateur($_SESSION["pseudo"]);
$application = new Application();

$random = rand(0, 9);

$idUtilisateur = $_SESSION["idUtilisateur"];
$idQuiz = $_GET["id"];
$quiz = new Quiz($_GET["id"]);

$questions = $quiz->getQuestions();
$nQ = 1;

$objetQuestion = new Question();

$listeQuestions = $objetQuestion->recupererQuestionsNonJoues($idQuiz, $idUtilisateur);


echo "<pre>";
print_r($listeQuestions);
echo "</pre>";

$idQuestionEnCours = $listeQuestions[$random]["idQuestion"];
if($objetQuestion->verifQuestionTermine($idUtilisateur, $idQuestionEnCours) == true)
{
    ?>
    <div class="container appQuiz">
        <form method="post" action="../traitements/enregistrerReponse.php">
            <div class="form-group">
                <label for="pseudo">
                    Question <?=$nQ;?> : <?=$listeQuestions[$random]["question"];?>
                </label>
                <?php
                $idQuestion = $listeQuestions[$random]["idQuestion"];
                $objetQuestion = new Question($idQuestion);
                $reponses = $objetQuestion->getReponses();

                $nR = 1;
                foreach($reponses as $reponse)
                {
                    $idReponse = $reponse->getIdReponse();
                    $objetReponse = new Reponse($idReponse);
                    
                    ?>
                    <div class="reponse-container">
                        <div class="reponse-prefix">Réponse : <?=$nR;?></div>
                        <div class="reponse-text">
                            <button type="submit" name="idReponse" id="idReponse" value="<?=$application->gererGuillemets($objetReponse->getIdReponse());?>">
                                <?=$application->gererGuillemets($objetReponse->getReponse());?>
                            </button>
                        </div>
                    </div>
                    <?php
                    $nR++;
                }
                ?>
            </div>
        </form>
    </div>
    <?php
} else {
    header("location:../Quiz/jeu.php?id=$idQuiz");
}

require_once "../admin/pied.php";