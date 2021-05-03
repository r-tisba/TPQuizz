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

<div class="container">

<?php
if(!empty($_GET["success"]) && $_GET["success"] == "ajout") 
{
    ?>
    <div class="alert alert-success mt-3">La catégorie a bien été ajouté</div>
        <?php
        header("refresh:2;../admin/index.php");
}

if(!empty($_GET["success"]) && $_GET["success"] == "suppression") 
{
    ?>
    <div class="alert alert-success mt-3">La supression a bien été effectué</div>
        <?php
        header("refresh:2;../admin/index.php");
}

if (!empty($_GET["error"])) 
{
    ?>
    <div class="alert alert-danger mt-2">
    <?php switch($_GET["error"]) 
    {
        case "missing": ?>
            <?php echo "Au moins un des champs est vide"; ?>
            <?php break;?>
        <?php case "nomlength": ?>
            <?php echo "Le nom de la catégorie doit au minimum contenir 3 caractères"; ?>
            <?php break;?>
        <?php case "nomidentique": ?>
            <?php echo "Le nom de catégorie existe déjà"; ?>
            <?php break;?>
        <?php case "erreurajout": ?>
            <?php echo "Une erreur s'est produite lors de l'ajout"; ?>
            <?php break;?>
        <?php case "erreursuppression": ?>
            <?php echo "Une erreur s'est produite lors de la suppression"; ?>
            <?php break;?>
        <?php case "missingId": ?>
            <?php echo "Impossible de récuperer l'id de la catégorie"; ?>
            <?php break;?>
    <?php 
    }
    ?>
    </div>
<?php 
}

?>
<!-- ------------------------ AJOUT D'UNE NOUVELLE CATEGORIE ------------------------ -->
<?php

if(!empty($_SESSION["pseudo"]) && $_SESSION["idRole"] == 2 && empty($_GET["success"]))
{
?>

    <div class="row">
    <div class="col-md-12 mb-3">
    <div class="card card-white" style="border: none;">
    <div class="card-body">

        <nav class="navbar navbar-7">
            <h1 class="navbar-brand titreAjout">Ajout d'une nouvelle catégorie : </h1>
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent11" aria-controls="navbarSupportedContent11" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse" id="navbarSupportedContent11">
                <form method="post" action="../traitements/ajoutCategorie.php">
                    <div class="form-group">
                        <label for="nomCategorie">Nom de la catégorie :</label>
                        <input type="text" class="form-control" name="nomCategorie" id="nomCategorie" placeholder="Saisissez le nom de la catégorie" value="<?=(isset($_POST["nomCategorie"]) ? $_POST["nomCategorie"] : "")?>"/>
                    </div>

                    <div class="form-group">
                        <label for="illustration">Illustration (optionnel) :</label>
                        <input type="text" class="form-control" name="illustration" id="illustration" placeholder="Saisissez l'url de l'image" value="<?=(isset($_POST["illustration"]) ? $_POST["illustration"] : "")?>"/>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-outline-primary">Ajouter la catégorie</button>
                    </div>
                </form>
            </div>
        </nav>
    </div>
    </div>
    </div>
    </div>

<?php
}
?>
<!-- ------------------------ FIN AJOUT NOUVELLE CATEGORIE ------------------------ -->

<main>

<div class="container-fluid content-row">
    <div class="card-deck row">
        <?php

        $categories = $application->getCategories();
        foreach($categories as $categorie)
        {
            ?>
            <div class="col-9 col-sm-9 col-md-6 col-lg-4 mb-4">
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
                            <a href="../admin/modifierCategorie.php?id=<?=$categorie["idCategorie"];?>" class="btn btn-outline-primary my-2">Modifier</a>

                            <a href="../traitements/supprimerCategorie.php?id=<?=$categorie["idCategorie"];?>" onclick="return confirm('Êtes vous certain de supprimer la catégorie <?=$categorie['nomCategorie'];?> ?');" class="btn btn-outline-danger" id="bouton">Supprimer</a>

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

<?php
require_once "pied.php";