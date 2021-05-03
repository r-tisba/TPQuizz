<?php
require_once "../admin/entete.php";
require_once "../Modele/Modele.php";
require_once "../Modele/Utilisateur.php";
$application = new Application();

if (!empty($_GET["id"])) 
{
    $idUtilisateur = $_GET["id"];
} else {
    header("location:../admin/index.php");
}

$utilisateur = new Utilisateur($idUtilisateur);

$idUtilisateur = $utilisateur->getIdUtilisateur();
$email = $utilisateur->getEmail();
$pseudo = $utilisateur->getPseudo();
$idRole = $utilisateur->getIdRole();
$nomRole = $utilisateur->recupererNomRoleViaIdRole($idRole);

?>

<div class="container">

    <?php if(!empty($_GET["success"]) && $_GET["success"] == "modification")
    {
        ?>
        <div class="alert alert-success">
            L'utilisateur "<?=$pseudo;?>" a bien été modifiée<br>
            Vous allez être redirigé vers la liste des utilisateurs<br>
            <a href="../admin/listeUtilisateurs.php">Cliquez ici pour une redirection manuelle</a>
        </div>
        <?php 
        header("refresh:3;../admin/listeUtilisateurs.php");
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
        <?php case "email": ?>
            <?php echo "Une erreur s'est produite lors de la modification de l'email"; ?>
            <?php break;?>
        <?php case "pseudo": ?>
            <?php echo "Une erreur s'est produite lors de la modification du pseudo"; ?>
            <?php break;?>
        <?php case "idRole": ?>
            <?php echo "Une erreur s'est produite lors de la modification du rôle"; ?>
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

<h1> Modification de l'utilisateur : <?=$pseudo;?></h1>
    <form method="post" action="../traitements/modifierUtilisateur.php?id=<?=$idUtilisateur;?>">
        <div class="form-group">
            <label for="email">Adresse mail :</label>
            <input type="text" class="form-control" name="email" id="email" placeholder="Saisissez la nouvelle adresse mail" value="<?=$email?>"/>
        </div>
        <div class="form-group">
            <label for="pseudo">Pseudo :</label>
            <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Saisissez le nouveau pseudo" value="<?=$pseudo;?>"/>
        </div>
        <div class="form-group">
                    <label for="idRole">Rôle :</label>
                    <select name="idRole" id="idRole" class="form-control">
                        <?php
                        $roles = $application->getRoles();
                        foreach ($roles as $role)
                        {
                            if ($role["idRole"] != 3)
                            {
                                ?>
                                <option value="<?=$role["idRole"];?>"
                                    <?=($role["idRole"] === $idRole ? "selected" : "");?>>
                                    <?=$role["nomRole"];?>
                                </option>
                                <?php                          
                            }
                        }
                        ?>
                    </select>
                </div>
        
        <div class="form-group text-center">
            <button type="submit" class="btn btn-outline-primary">Modifier l'utilisateur</button>
            <a href="../admin/listeUtilisateurs.php" class="btn btn-outline-secondary">Revenir à la liste des utilisateurs</a>
        </div>
    </form>
</div>

<?php
require_once "pied.php";
?>