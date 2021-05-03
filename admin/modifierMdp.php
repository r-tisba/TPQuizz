<?php
require_once "entete.php";

if(!empty($_GET["success"]) && $_GET["success"] == "modification")
    {
        ?>
        <div class="alert alert-success">
            Votre mot de passe a bien été modifiée<br>
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
        case "mdplength": ?>
            <?php echo "Votre mot de passe fait moins de 6 caractères"; ?>
            <?php break;?>
        <?php case "mdpnotsame": ?>
            <?php echo "La vérification et le mot de passe ne corresponde pas"; ?>
            <?php break;?>
        <?php case "modification": ?>
            <?php echo "Une erreur s'est produite lors de la modification du mot de passe"; ?>
            <?php break;?>
    <?php 
    }
    ?>
    </div>
<?php
}
?>

<form method="post" action="../traitements/modifierMdp.php">
        <div class="form-group">
            <label for="mdp">Nouveau mot de passe (6 caractères minimum) :</label>
            <input type="password" class="form-control" name="mdp" id="mdp" placeholder="Saisissez votre nouveau mot de passe"/>
        </div>
        <div class="form-group">
            <label for="verifMdp">Vérifier mot de passe :</label>
            <input type="password" class="form-control" name="verifMdp" id="verifMdp" placeholder="Vérifier votre nouveau mot de passe"/>
        </div>
                
        <div class="form-group text-center">
            <button type="submit" class="btn btn-outline-primary">Modifier le mot de passe</button>
        </div>
    </form>

<?php
require_once "pied.php";