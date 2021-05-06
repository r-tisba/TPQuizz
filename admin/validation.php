<?php
require_once "../admin/entete.php";
$utilisateur = new Utilisateur($_SESSION["pseudo"]);
$application = new Application();

$Lesquizs = new Quiz();

if(!empty($_GET["success"]) && $_GET["success"] == "suppression") 
{
    ?>
    <div class="alert alert-success mt-3">La supression a bien été effectué</div>
        <?php
        header("refresh:2;../admin/listeQuiz.php?id=$idCategorie");
}

if (!empty($_GET["error"])) 
{
    ?>
    <div class="alert alert-danger mt-2">
    <?php switch($_GET["error"]) 
    {
        case "erreursuppression": ?>
            <?php echo "Une erreur s'est produite lors de la suppression"; ?>
            <?php break;?>
        <?php case "missingId": ?>
            <?php echo "Impossible de récuperer l'id du quiz"; ?>
            <?php break;?>
    <?php 
    }
    ?>
    </div>
<?php 
}
if(!empty($_GET["success"]) && $_GET["success"] == "valider") 
{
    ?>
    <div class="alert alert-success mt-3">La supression a bien été effectué</div>
        <?php
        header("refresh:2;../admin/listeQuiz.php?id=$idCategorie");
}

if (!empty($_GET["error"])) 
{
    ?>
    <div class="alert alert-danger mt-2">
    <?php switch($_GET["error"]) 
    {
        case "erreurvalider": ?>
            <?php echo "Une erreur s'est produite lors de la validation"; ?>
            <?php break;?>
        <?php case "missingId": ?>
            <?php echo "Impossible de récuperer l'id du quiz"; ?>
            <?php break;?>
    <?php 
    }
    ?>
    </div>
<?php 
}
?>
<div class="mb-4">
    <a href="../admin/listeCategories.php" class="retour">
        <img src="../images/design/flecheRetour.png" class="fleche">Retour
    </a>
</div>

<main>
<div class="container-fluid content-row">
    <div class="card-deck row">
        <?php

        $quizs = $Lesquizs->verifierQuiz();
        foreach($quizs as $quiz)
        {
            
                $date = $quiz["dateCreation"];
                $auteur = $utilisateur->recupererPseudoViaId($quiz["idUtilisateur"]);
                ?>
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 mb-4">
                    <div class="card mx-0">
                        <div class="card-header p-1">
                            <h5 class="card-title d-flex justify-content-center pt-2"><?=$quiz["nomQuiz"];?> </h5>
                        </div>
                        <div class="view overlay">
                            <a href="../Quiz/quiz.php?id=<?=$quiz["idQuiz"];?>">
                                <img src="<?=$quiz["illustration"];?>" class="imageQuiz" style="max-width: 100%;">
                            </a>
                        </div>
                        <div class="card-footer">
                            <div class="text-muted small">
                                Crée par <?=$auteur["pseudo"];?> le <?=$application->dateFr($date);?>
                            </div>
                            <div class="btn-group d-flex justify-content-center mt-3">
                                <!-- A FINIR -->
                                <a href="../traitements/invaliderQuiz.php?id=<?=$quiz["idQuiz"];?>" onclick="return confirm('Êtes vous certain de supprimer le quiz <?=$quiz['nomQuiz'];?> ?');" class="btn btn-outline-danger" id="bouton">Supprimer</a>
                                <a href="../traitements/ValiderQuiz.php?id=<?=$quiz["idQuiz"];?>" onclick="return confirm('Êtes vous certain de valider le quiz <?=$quiz['nomQuiz'];?> ?');" class="btn btn-outline-success" id="bouton">Valider</a>
                            </div>
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
