<?php
require_once "../admin/entete.php";
$utilisateur = new Utilisateur($_SESSION["pseudo"]);
$application = new Application();

if(!isset($_SESSION["pseudo"]))
{
  header("location:../visiteur/index.php");
}
if($_SESSION["idRole"] == 1)
{
  header("location:../membre/index.php");
}

?>
<main>

<div class="container-fluid content-row">
    <div class="card-deck row">
        <?php

        $categories = $application->getCategories();
        foreach($categories as $categorie)
        {
            ?>
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="card">
                    <div class="card-header p-1">
                        <h5 class="card-title d-flex justify-content-center pt-2"><?=$categorie["nomCategorie"];?> </h5>
                    </div>
                    <div class="view overlay">
                        <a href="listeQuiz.php?id=<?=$categorie["idCategorie"];?>">
                            <img src="<?=$categorie["illustration"];?>" class="imageCategorie zoom" style="max-width: 100%;">
                        </a>
                    </div>
                    <div class="card-footer p-1 cardFooterCategorie">
                       <div class="form-group text-center mb-0">
                            <a href="../admin/modifierCategorie.php" class="btn btn-outline-primary my-2">Modifier</a>
                            <a href="../admin/supprimerCategorie.php" class="btn btn-outline-danger my-2">Supprimer</a>
                       </div> 
                    </div>
                </div>
            </div>
            <?php
        }
        ?>  
    </div>
</div>
</div>
</main>
