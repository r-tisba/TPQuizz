<?php if(!empty($_GET["success"]) && $_GET["success"] == "ajout")
    {
        ?>
        <div class="alert alert-success">
            Le quiz a bien été modifiée<br>
            Vous allez être redirigé vers la page d'accueil<br>
            <a href="../visiteur/index.php">Cliquez ici pour une redirection manuelle</a>
        </div>
        <?php 
        header("refresh:3;../visiteur/index.php");
    } 

if (!empty($_GET["error"])) 
{
    ?>
    <div class="alert alert-danger mt-3">
    <?php switch($_GET["error"]) 
    {
        case "id": ?>
            <?php echo "Une erreur s'est produite lors de la récupération de la categorie"; ?>
            <?php break;?>
        <?php case "missing": ?>
            <?php echo "Erreur: vous n'êtes pas connecté ou vous n'avez pas remplis le nom du quiz"; ?>
            <?php break;?>
        
    <?php 
    }
    ?>
    </div>
<?php
}