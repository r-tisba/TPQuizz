<?php
require_once "entete.php";

if(!empty($_GET["success"]) && $_GET["success"] == "modification")
    {
        ?>
        <div class="alert alert-success">
            La photo de profil a bien été modifiée<br>
            Vous allez être redirigé vers votres profil<br>
            <a href="../admin/profil.php">Cliquez ici pour une redirection manuelle</a>
        </div>
        <?php 
        header("refresh:3;../admin/profil.php");
    } 

if (!empty($_GET["error"])) 
{
    ?>
    <div class="alert alert-danger mt-3">
    <?php switch($_GET["error"]) 
    {
        case "missing": ?>
            <?php echo "Le document n'est pas une image"; ?>
            <?php break;?>
        <?php case "taille": ?>
            <?php echo "L'image est trop lourde séléctionez une image qui ne dépasse pas 3Mo"; ?>
            <?php break;?>
        <?php case "type": ?>
            <?php echo "L'image doit être en jpeg ou png"; ?>
            <?php break;?>
        <?php case "fichier": ?>
            <?php echo "Une erreur s'est produite lors du chargement de l'image"; ?>
            <?php break;?>
        <?php case "ajout": ?>
            <?php echo "Une erreur s'est produite lors de la modification de votre photo de profil"; ?>
            <?php break;?>
    <?php 
    }
    ?>
    </div>
<?php
}
?>

<h1>Charger une image</h1>
    <form action="../traitements/modifPP.php" method="post" enctype="multipart/form-data">
        <b>Sélectionnez votres nouvelle photo de profil :</b>
        <input type="file" name="image"/>
        <br>
        <button type="submit">Modifier la photo de profil</button>
    </form>

<?php
require_once "pied.php";