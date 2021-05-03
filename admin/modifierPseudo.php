<?php
require_once "entete.php";

if(!empty($_GET["success"]) && $_GET["success"] == "modification")
    {
        ?>
        <div class="alert alert-success">
            Votre pseudo a bien été modifiée<br>
            Vous allez être redirigé vers votre profil<br>
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
        case "pseudo": ?>
            <?php echo "Une erreur s'est produite lors de la récupération du nouveau pseudo"; ?>
            <?php break;?>
        <?php case "modification": ?>
            <?php echo "Une erreur s'est produite lors de la modification du pseudo"; ?>
            <?php break;?>
    <?php 
    }
    ?>
    </div>
<?php
}
?>

<form method="post" action="../traitements/modifierPseudo.php">
        <div class="form-group">
            <label for="pseudo">Nouveau Pseudo :</label>
            <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Saisissez votre nouveau pseudo"/>
        </div>
                
        <div class="form-group text-center">
            <button type="submit" class="btn btn-outline-primary">Modifier le pseudo</button>
        </div>
    </form>

<?php
require_once "pied.php";