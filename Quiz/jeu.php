<?php
require_once "../Quiz/entete.php";
?> <link rel="stylesheet" href="../Quiz/styleJeu.css"> <?php

$utilisateur = new Utilisateur($_SESSION["pseudo"]);
$application = new Application();
$objetReponse = new Reponse();

$idUtilisateur = $_SESSION["idUtilisateur"];
$idQuiz = $_GET["id"];
$quiz = new Quiz($_GET["id"]);

$questions = $quiz->getQuestions();
$nQ = 1;

$objetQuestion = new Question();

$listeQuestions = $objetQuestion->recupererQuestionsNonJoues($idQuiz, $idUtilisateur);

$random = rand(0, count($listeQuestions) - 1);

if(count($listeQuestions) == 0)
{
    ?>
    <div class="alert alert-danger mt-2">Test couleur</div>

    <div class="container">
        <div class="bilan">
            <div class="questions-container">
            <?php 
            $reponsesUtilisateur = $objetReponse->recupererReponsesUtilisateur($idUtilisateur, $idQuiz);

            foreach($reponsesUtilisateur as $reponseUtilisateur)
            {
                ?>
                <div class="question-element">
                    <label for="question" id="question">
                        Question <?=$nQ;?> : <?=$reponseUtilisateur["question"];?>
                    </label>
                    <?php
                    $idQuestion = $reponseUtilisateur["idQuestion"];
                    $objetQuestion = new Question($idQuestion);
                    $nQ++;
                    
                    ?>
                    
                    <?php 
                    $reponses = $objetReponse->recupererReponsesViaQuestion($idQuestion);
                    // shuffle($reponses);
                    ?>

                    <div class="reponses-container">
                        <div class="corrige">
                            <div class="corrige-bonneReponse">
                                Bonne réponse : <label id="bonneReponse"><?=$reponses[0]["reponse"];?> </label><br>
                            </div>
                            <div class="corrige-mauvaiseReponse">
                                Mauvaises réponses : <label id="mauvaiseReponse"><?=$reponses[1]["reponse"];?> / <?=$reponses[2]["reponse"];?> / <?=$reponses[3]["reponse"];?></label>
                            </div>
                            <br>
                        </div>
                        <?php
                        if ($reponseUtilisateur["validite"] == 1)
                        {
                        ?>
                        <div class="reponseUtilisateur-container">
                            <p>
                                Votre réponse : 
                                <label class="reponseUtilisateur" id="bonneReponse"><?=$reponseUtilisateur['reponse']?></label>
                                <img class="icone-reponse ml-2" src="../images/design/validerVert.png">
                            </p>
                        </div>

                        <?php
                        } else {
                            ?>
                            <div class="reponseUtilisateur-container">
                            Votre réponse : <label class="reponseUtilisateur" id="mauvaiseReponse"><?=$reponseUtilisateur['reponse']?></label>
                            <img class="icone-reponse" src="../images/design/croixRouge.png">
                            </div>
                            <?php
                        }
                        ?>

                    </div>
                </div>
                <hr class="hrPerso">
                <?php
            }
            ?>
        </div>
        <div id="end" class="flex-center flex-column">
            <h1 id="scoreFinal">Score</h1>
            <a href="../admin/listeCategories.php" class="btn">Retourner à l'accueil</a>
        </div>
    </div>
    <?php
    exit;
}

$idQuestionEnCours = $listeQuestions[$random]["idQuestion"];
if($objetQuestion->verifQuestionTermine($idUtilisateur, $idQuestionEnCours) == true)
{
    ?>
    <div class="container appQuiz">
        <form method="post" action="../traitements/enregistrerReponse.php">
            <div class="form-group">
                <label for="question">

                <?php /*
                echo "<pre>";
                print_r($listeQuestions);
                echo "</pre>";
                */ ?>
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
                        <div class="reponse-prefix">Réponse <?=$nR;?> :</div>
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
    $nQ++;
} else {
    header("location:../Quiz/jeu.php?id=$idQuiz");
}

require_once "../admin/pied.php";