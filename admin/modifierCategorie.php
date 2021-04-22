<?php
require_once "../admin/entete.php";
require_once "../modeles/modele.php";
require_once "../Modele/Modele.php";
require_once "../Modele/Categorie.php";

if (!empty($_GET["id"])) 
{
    $idCategorie = $_GET["id"];
} else {
    header("location:../admin/index.php");
}

$categorie = new Categorie($idCategorie);

$idCategorie = $categorie->getIdCat();
$nomCategorie = $categorie->getNomCat();
$illustration = $categorie->getIllustration();

?>

<div class="container">

    <?php if(!empty($_GET["success"]) && $_GET["success"] == "modification")
    {
        ?>
        <div class="alert alert-success">
            La catégorie "<?=$nomCategorie;?>" a bien été modifiée<br>
            Vous allez être redirigé vers la page d'accueil<br>
            <a href="../admin/index.php">Cliquez ici pour une redirection manuelle</a>
        </div>
        <?php 
        header("refresh:3;../admin/index.php");
    } 

if (!empty($_GET["error"])) 
{
    ?>
    <div class="alert alert-danger mt-3">
    <?php switch($_GET["error"]) 
    {
        case "missing": ?>
            <?php echo "Une erreur s'est produite lors de la récupération de l'id"; ?>
            <?php break;?>
        <?php case "nomCategorie": ?>
            <?php echo "Une erreur s'est produite lors de la modification du nom de la catégorie"; ?>
            <?php break;?>
        <?php case "illustration": ?>
            <?php echo "Une erreur s'est produite lors de la modification de l'illustration"; ?>
            <?php break;?>
        <?php case "fonction": ?>
            <?php echo "Une erreur s'est produite lors de la modification"; ?>
            <?php break;?>
    <?php 
    }
    ?>
    </div>
<?php
}
?>

<h1> Modification de la catégorie : <?=$nomCategorie;?></h1>
    <form method="post" action="../traitements/modifierCategorie.php?id=<?=$idCategorie;?>">
        <div class="form-group">
            <label for="nomCategorie">Libellé de la catégorie :</label>
            <input type="text" class="form-control" name="nomCategorie" id="nomCategorie" placeholder="Saisissez le nouveau nom" value="<?=$nomCategorie?>"/>
        </div>
        <div class="form-group">
            <label for="illustration">Illustration :</label>
            <input type="text" class="form-control" name="illustration" id="illustration" placeholder="Saisissez le lien de la nouvelle image" value="<?=$illustration;?>"/>
        </div>
        
        <div class="form-group text-center">
            <button type="submit" class="btn btn-outline-primary">Modifier la catégorie</button>
            <a href="../admin/index.php" class="btn btn-outline-secondary">Revenir à l'accueil</a>
        </div>
    </form>
</div>

<?php
require_once "pied.php";
?>