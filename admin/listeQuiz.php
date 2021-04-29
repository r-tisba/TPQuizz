<?php
require_once "../admin/entete.php";
$utilisateur = new Utilisateur($_SESSION["pseudo"]);
$application = new Application();
?>

<div class="mb-4">
    <a href="../admin/index.php" class="retour">
        <img src="../images/design/flecheRetour.png" class="fleche">Retour
    </a>
</div>
<div class="justify-content-center col-6">
<a href="../Quiz/ajoutQuiz.php?id=<?=$_GET["id"]?>" class="btn btn-outline-primary">Ajout quiz </a>
</div>
<main>
<div class="container-fluid content-row">
    <div class="card-deck row">
        <?php

        $quizs = $application->getQuizs();
        foreach($quizs as $quiz)
        {
            ?>
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="card">
                    <div class="card-header p-1">
                        <h5 class="card-title d-flex justify-content-center pt-2"><?=$quiz["nomQuiz"];?> </h5>
                    </div>
                    <div class="view overlay">
                        <a href="../Quiz/Questionaire.php?id=<?=$quiz["idQuiz"];?>">
                            <img src="<?=$quiz["illustration"];?>" class="imageQuiz" style="max-width: 100%;">
                        </a>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">Crée par </small>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>  
    </div>
</div>
</main>

</div>

<?php
require_once "pied.php";