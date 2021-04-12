<?php
require_once "entete.php";
?>
<div class="container">
    <h1>Connexion</h1>

    <?php if (!empty($_GET["success"]) && $_GET["success"] == "connexion") 
    {
        ?>
        <div class="alert alert-success mt-3">Vous avez bien été connecté <br> 
            Vous allez être redirigé vers la page d'accueil<br>
            <a href="index.php">Cliquez ici pour une redirection manuelle</a>
        </div>
        <?php
        header("refresh:5;index.php");
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
            <?php case "mdplength": ?>
                <?php echo "Le mot de passe incorrecte"; ?>
                <?php break;?>
            <?php case "missing": ?>
                <?php echo "Au moins un champ n'a pas été saisi"; ?>
                <?php break;?>
        <?php 
        }
        ?>
        </div>
    <?php 
    }
    ?>

    <form method="post" action="../traitements/sauvegarderConnexion.php">
            <div class="form-group">
                <label for="pseudo">Pseudo :</label>
                <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Saisissez votre pseudo" value="<?=(isset($_POST["pseudo"]) ? $_POST["pseudo"] : "")?>" required/>
            </div>
            <div class="form-group">
                <label for="mdp">Mot de passe :</label>
                <input type="password" class="form-control" name="mdp" id="mdp" placeholder="Saisissez votre mot de passe" required/>
            </div>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary" name="envoi" id="envoi" value="1">Connexion</button>
            </div>
    </form>
</div>