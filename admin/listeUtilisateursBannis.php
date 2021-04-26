<?php
require_once "../admin/entete.php";
$utilisateur = new Utilisateur($_SESSION["pseudo"]);
$application = new Application();
?>

<?php
if(!empty($_GET["success"]) && $_GET["success"] == "deban") 
{
    ?>
    <div class="alert alert-success mt-3">L'utilisateur a bien été débanni</div>
        <?php
        header("refresh:2;../admin/listeUtilisateursBannis.php");
}

if (!empty($_GET["error"])) 
{
    ?>
    <div class="alert alert-danger mt-2">
    <?php switch ($_GET["error"]) 
        {
            case "fonction": ?>
                <?php echo "Erreur lors de la modification du rôle"; ?>
                <?php break;?>
            <?php case "missingid": ?>
                <?php echo "Impossible de récuperer l'id de l'utilisateur"; ?>
                <?php break;?>
        <?php 
        }
        ?>
    </div>
    <?php 
}
?>

<div class="mb-4">
    <a href="../admin/index.php" class="retour">
        <img src="../images/design/flecheRetour.png" class="fleche">Retour
    </a>
</div>

<main>
<ul class="list-group">
<div class="container-fluid content-row px-0">
    <div class="row">
        <?php

        $utilisateurs = $application->getUtilisateurs();
        foreach($utilisateurs as $utilisateur)
        {
            if($utilisateur["idRole"] == 3)
            {
            ?>
            <div class="col-4 col-sm-4 col-md-3 col-lg-2 mb-4 mr-4">
                <li class="list-group-item py-0" style="border: none;">
                    <img src="<?=$utilisateur["avatar"];?>" class="rounded-circle avatarProfil">
                </li>
            </div>
            
            <div class="col-5 col-sm-5 col-md-7 col-lg-8 mb-4">
                <li class="list-group-item">Pseudo : <?=$utilisateur["pseudo"]?></li>
                <li class="list-group-item">Points : <?=$utilisateur["pointsUtilisateur"]?></li>
                <li class="list-group-item">Rôle : Banni
                </li>
            </div>
            
            <div class="float-right mb-4">
                <a href="../traitements/bannirUtilisateur.php?id=<?=$utilisateur["idUtilisateur"];?>&action=2" onclick="return confirm('Êtes vous certain de vouloir lever le ban de <?=$utilisateur['pseudo'];?> ?');" 
                class="btn btn-outline-danger w-100 py-5 h-100" id="bouton">Enlever le ban</a>
            </div>

            <?php
            }
        }
        ?>  
    </div>
</div>
</ul>
</main>

<?php
require_once "pied.php";