<?php
require_once "entete.php";
require_once "../Modele/Utilisateur.php";

if (!empty($_GET["id"])) 
{
    $idUtilisateur = $_GET["id"];
}
?>

<div class="container">
    <h1 class="d-flex justify-content-center">Mot de passe oublié</h1>

    <?php if (!empty($_GET["success"]) && $_GET["success"] == "mdp") 
    {
        ?>
        <div class="alert alert-success mt-3">Vous avez bien modifié votre mot de passe <br> 
            Vous allez être redirigé vers la page de connexion<br>
            <a href="../visiteur/connexion.php">Cliquez ici pour une redirection manuelle</a>
        </div>
        <?php
        header("refresh:5;../visiteur/connexion.php");
    }
    ?>
    <?php if (!empty($_GET["error"])) 
    {
    ?>
        <div class="alert alert-danger mt-3">
        <?php switch ($_GET["error"]) 
        {
            case "falsemdp": ?>
                <?php echo "Le mot de passe n'existe pas"; ?>
                <?php break;?>
            <?php case "falsepseudo": ?>
                <?php echo "Le pseudo n'existe pas"; ?>
                <?php break;?>
            <?php case "falsereponse": ?>
                <?php echo "La réponse est incorrecte"; ?>
                <?php break;?>
            <?php case "mdplength": ?>
                <?php echo "Le mot de passe doit faire au moins 6 caractères"; ?>
                <?php break;?>
            <?php case "mdpnotsame": ?>
                <?php echo "Les deux mots de passe saisies ne sont pas identiques"; ?>
                <?php break;?>
            <?php case "pseudomissing": ?>
                <?php echo "Veuillez saisir un pseudonyme"; ?>
                <?php break;?>
            <?php case "reponsemissing": ?>
                <?php echo "Veuillez saisir une réponse"; ?>
                <?php break;?>
            <?php case "mdpmissing": ?>
                <?php echo "Veuillez saisir un mot de passe"; ?>
                <?php break;?>
            <?php case "updatesave": ?>
                <?php echo "Erreur lors de la mise à jour du mot de passe"; ?>
                <?php break;?>
                
        <?php 
        }
        ?>
        </div>
    <?php 
    }

    if (empty($_GET["success"]) || $_GET["success"] != "reponse" && $_GET["success"] != "mdp") 
    {
        ?>
        <form method="post" action="../traitements/mdpOublie.php">
            <div class="form-group">
                <label for="pseudo">Pseudo :</label>
                <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Saisissez votre pseudo" value="<?=(isset($_POST["pseudo"]) ? $_POST["pseudo"] : "")?>" required/>
            </div>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-outline-primary" name="envoi" id="envoi" value="1">Afficher question secrète</button>
            </div>
        </form>

        <?php if (!empty($_GET["success"]) && $_GET["success"] == "pseudo") 
        {
            $utilisateur = new Utilisateur($idUtilisateur);
            ?>
            <form method="post" action="../traitements/mdpOublie.php?id=<?=$idUtilisateur?>">
                <h2>Question secrète :</h2>
                <div class="my-3">
                    Votre question secrète, <?=$utilisateur->getPseudo();?> est : <h1 class="display-4"><?=$utilisateur->getQuestionSecrete();?></h1>
                </div>
                <div class="form-group">
                    <label for="reponse">Votre réponse:</label>
                    <input type="text" class="form-control" name="reponse" id="reponse" placeholder="Saisissez votre réponse" value="<?=(isset($_POST["reponse"]) ? $_POST["reponse"] : "")?>" required/>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-outline-success" name="envoi" id="envoi" value="2">Valider la réponse</button>
                </div>
                        
            </form>
            <?php 
        }
    } else if (!empty($_GET["success"]) && $_GET["success"] == "reponse") {
        ?>
        <form method="post" action="../traitements/mdpOublie.php?id=<?=$idUtilisateur?>" class="mt-4">
            <h2>Nouveau mot de passe :</h2>
            <div class="form-group mt-3">
                <label for="mdp">Mot de passe (6 caractères minimum):</label>
                <input type="password" class="form-control" name="mdp" id="mdp" placeholder="Créer votre nouveau mot de passe" required/>
            </div>
            <div class="form-group">
                <label for="verifMdp">Vérifier votre mot de passe :</label>
                <input type="password" class="form-control" name="verifMdp" id="verifMdp" placeholder="Vérifier votre mot de passe" required/>
            </div>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-outline-primary" name="envoi" id="envoi" value="3">Confirmer le nouveau mot de passe</button>
            </div>
                        
        </form>
        <?php
    }
    ?>
</div>