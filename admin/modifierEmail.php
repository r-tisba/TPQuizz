<?php
require_once "entete.php";

if(!empty($_GET["success"]) && $_GET["success"] == "modification")
    {
        ?>
        <div class="alert alert-success">
            Votre email a bien été modifiée<br>
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
        case "email": ?>
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

<form method="post" action="../traitements/modifierEmail.php">
        <div class="form-group">
            <label for="email">Nouvelle Email :</label>
            <input type="text" class="form-control" name="email" id="email" placeholder="Saisissez votre nouvelle email"/>
        </div>
                
        <div class="form-group text-center">
            <button type="submit" class="btn btn-outline-primary">Modifier l'email</button>
        </div>
    </form>

<?php
require_once "pied.php";