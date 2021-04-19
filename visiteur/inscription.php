<?php
require_once "../visiteur/entete.php";
require_once "../Modele/Modele.php";
require_once "../Modele/Utilisateur.php";
$utilisateur = new Utilisateur();

$idUtilisateur = $utilisateur->recupererUtilisateurViaPseudo("Pod3us");
print_r($idUtilisateur);
echo "<br>";
print_r($idUtilisateur["idUtilisateur"]);
?>

<div class="container">
    <h1>Inscription</h1>

    <?php if (!empty($_GET["success"]) && $_GET["success"] == "inscription") 
    {
        ?>
        <div class="alert alert-success mt-2">Vous avez bien été inscrit <br>
        Vous allez être redirigé vers l'accueil</div>
    <?php
    header("refresh:4;../visiteur/index.php");
    }
    ?>
    <?php if (!empty($_GET["error"])) 
    {
    ?>
        <div class="alert alert-danger mt-2">
        <?php switch ($_GET["error"]) 
        {
            case "inscriptionsave": ?>
                <?php echo "Une erreur s'est produite lors de l'enregistrement utilisateur"; ?>
                <?php break;?>
            <?php case "qssave": ?>
                <?php echo "Une erreur s'est produite lors de l'enregistrement qs"; ?>
                <?php break;?>
            <?php case "emailnotvalid": ?>
                <?php echo "L'adresse email choisi n'est pas valide"; ?>
                <?php break;?>
            <?php case "emailnotunique": ?>
                <?php echo "L'adresse email saisie existe déjà"; ?>
                <?php break;?>
            <?php case "mdplength": ?>
                <?php echo "Le mot de passe doit faire au moins 6 caractères"; ?>
                <?php break;?>
            <?php case "mdpnotsame": ?>
                <?php echo "Les deux mots de passe saisies ne sont pas identiques"; ?>
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

    <form method="post" action="../traitements/sauvegarderInscription.php">

        <div class="form-group">
            <label for="pseudo">Pseudo :</label>
            <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Entrez votre pseudo" value="<?=(isset($_POST["pseudo"]) ? $_POST["pseudo"] : "")?>" required/>
        </div>
        <div class="form-group">
            <label for="email">Adresse mail :</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Saisissez votre adresse mail" value="<?=(isset($_POST["email"]) ? $_POST["email"] : "")?>" required/>
        </div>
        <div class="form-group">
            <label for="mdp">Mot de passe (6 caractères minimum):</label>
            <input type="password" class="form-control" name="mdp" id="mdp" placeholder="Créer votre mot de passe" required/>
        </div>
        <div class="form-group">
            <label for="verifMdp">Vérifier votre mot de passe :</label>
            <input type="password" class="form-control" name="verifMdp" id="verifMdp" placeholder="Vérifier votre mot de passe" required/>
        </div>
        <div class="form-group">
            <label for="idQuestion">Question secrète :</label>
            <select name="idQuestion" id="idQuestion" class="form-control">
            <?php
                $questionsSecretes = recupererQuestionsSecretes();
                foreach ($questionsSecretes as $questionsSecrete)
                {
                    ?>
                    <option value="<?=$questionsSecrete["idQuestion"];?>">
                    <?=$questionsSecrete["libelle"];?>
                    </option>
                    <?php
                }
            ?>
            </select>  
        </div>
        <div class="form-group">
            <label for="reponseQuestionSecrete">Réponse à la question secrète :</label>
            <input type="text" class="form-control" name="reponseQuestionSecrete" id="reponseQuestionSecrete" placeholder="Saisissez la réponse de votre question secrète" required/>
        </div>
        
        <div class="form-group text-center">
            <button type="submit" class="btn btn-outline-primary" name="envoi" id="envoi" value="1">S'inscrire !</button>
        </div>
    </form>
</div>
