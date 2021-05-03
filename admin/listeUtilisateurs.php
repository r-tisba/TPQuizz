<?php
require_once "../admin/entete.php";
$utilisateur = new Utilisateur($_SESSION["idUtilisateur"]);
$application = new Application();
$amis = $utilisateur->filtreAmis($_SESSION["idUtilisateur"]);

?>

<div class="mb-4">
    <a href="../admin/index.php" class="retour">
        <img src="../images/design/flecheRetour.png" class="fleche">Retour
    </a>
</div>


<!-- ---------------------- AJOUT D'UN NOUVEAU UTILISATEUR ---------------------- -->
<div class="container pl-0">

<?php
if(!empty($_GET["success"]) && $_GET["success"] == "ajout") 
{
    ?>
    <div class="alert alert-success mt-3">L'utilisateur a bien été ajouté</div>
        <?php
        header("refresh:2;../admin/listeUtilisateurs.php");
}

if(!empty($_GET["success"]) && $_GET["success"] == "ajoutAmi") 
{
    ?>
    <div class="alert alert-success mt-3">L'utilisateur a bien été ajouté en ami</div>
        <?php
        header("refresh:2;../admin/listeUtilisateurs.php");
}

if(!empty($_GET["success"]) && $_GET["success"] == "bannissement") 
{
    ?>
    <div class="alert alert-success mt-3">L'utilisateur a bien été banni</div>
        <?php
        header("refresh:2;../admin/listeUtilisateurs.php");
}

if (!empty($_GET["error"])) 
{
    ?>
    <div class="alert alert-danger mt-2">
    <?php switch ($_GET["error"]) 
        {
            case "inscriptionsave": ?>
                <?php echo "Une erreur s'est produite lors de l'enregistrement utilisateur"; ?>
                <?php break;?>
            <?php case "qssave": ?>
                <?php echo "Une erreur s'est produite lors de l'enregistrement de la qs"; ?>
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
            <?php case "fonction": ?>
                <?php echo "Erreur lors de la modification du rôle"; ?>
                <?php break;?>
            <?php case "missingid": ?>
                <?php echo "Impossible de récuperer l'id de l'utilisateur"; ?>
                <?php break;?>
            <?php case "ajoutAmi": ?>
                <?php echo "Erreur lors de l'ajout de l'ami"; ?>
                <?php break;?>
            <?php case "verifAmi": ?>
                <?php echo "Vous êtes déjà ami avec cet utilisateur"; ?>
                <?php break;?>
        <?php 
        }
        ?>
    </div>
<?php 
}

if(!empty($_SESSION["pseudo"]) && $_SESSION["idRole"] == 2 && empty($_GET["success"]))
{   
?>

    <div class="row">
    <div class="col-md-12 mb-3">
    <div class="card card-white" style="border: none;">
    <div class="card-body">

        <nav class="navbar navbar-7">
            <h1 class="navbar-brand titreAjout">Ajout d'un nouvel utilisateur : </h1>
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent11" aria-controls="navbarSupportedContent11" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse" id="navbarSupportedContent11">
            <form method="post" action="../traitements/ajoutUtilisateur.php" class="navbar-nav mr-auto">

                <div class="form-group nav-item active">
                    <label for="email">Email :</label>
                    <input type="text" class="form-control" name="email" id="email" placeholder="Saisissez l'adresse mail de l'utilisateur" value="<?=(isset($_POST["email"]) ? $_POST["email"] : "")?>" required/>
                </div>

                <div class="form-group">
                    <label for="pseudo">Pseudo :</label>
                    <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Saisissez le pseudo de l'utilisateur" value="<?=(isset($_POST["pseudo"]) ? $_POST["pseudo"] : "")?>" required/>
                </div>

                <div class="form-group">
                    <label for="idRole">Rôle :</label>
                    <select name="idRole" id="idRole" class="form-control">
                        <?php
                        $roles = $application->getRoles();
                        foreach ($roles as $role)
                        {
                            ?>
                            <option value="<?=$role["idRole"];?>">
                                <?=$role["nomRole"];?>
                            </option>
                            <?php
                        }
                    ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="mdp">Mot de passe (6 caractères minimum):</label>
                    <input type="password" class="form-control" name="mdp" id="mdp" placeholder="Créer un mot de passe" required/>
                </div>

                <div class="form-group">
                    <label for="verifMdp">Vérifier votre mot de passe :</label>
                    <input type="password" class="form-control" name="verifMdp" id="verifMdp" placeholder="Saisissez à nouveau le mot de passe" required/>
                </div>

                <div class="form-group">
                    <label for="idQuestion">Question secrète :</label>
                    <select name="idQuestion" id="idQuestion" class="form-control">
                        <?php
                        $questions = $application->getQuestionsSecretes();
                        foreach ($questions as $question)
                        {
                            ?>
                            <option value="<?=$question["idQuestion"];?>">
                                <?=$question["libelle"];?>
                            </option>
                            <?php
                        }
                    ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="reponseQuestionSecrete">Réponse :</label>
                    <input type="text" class="form-control" name="reponseQuestionSecrete" id="reponseQuestionSecrete" placeholder="Saisissez la reponse à la question secrète" value="<?=(isset($_POST["reponse"]) ? $_POST["reponse"] : "")?>" required/>
                </div>
      
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-outline-primary">Créer le compte</button>
                </div>
            </form>
            </div>
        </nav>

    </div>
    </div>
    </div>
    </div>

<?php
}
?>
<!-- ------------------------ FIN AJOUT NOUVEAU UTILISATEUR ------------------------ -->

<main>
<ul class="list-group">
<div class="container-fluid content-row px-0">
    <div class="row">
        <?php

        $utilisateurs = $application->getUtilisateurs();
        foreach($utilisateurs as $utilisateur)
        {
            if($utilisateur["idRole"] != 3 && $utilisateur["pseudo"] != $_SESSION["pseudo"])
            {
            ?>
            <div class="col-4 col-sm-4 col-md-3 col-lg-2 mb-4 mr-4">
                <li class="list-group-item py-0" style="border: none;">
                    <div class="show-image">
                        <img src="<?=$utilisateur["avatar"];?>" class="rounded-circle avatarProfil">
                        <?php
                        
                        // foreach($amis as $ami){
                        // if($ami["idUtilisateur1"]!==$_SESSION["idUtilisateur"] && $ami["idUtilisateur2"]!==$utilisateur["idUtilisateur"]){
                        // ?>
                        <a href="../traitements/ajoutAmi.php?id=<?=$utilisateur["idUtilisateur"];?>">
                        <input class="btn btn-outline-success ajouterAmi" type="button" value="Ajouter ami">
                        </a>
                        <?php
                        // }
                        // }
                        ?>
                    </div>
                </li>
            </div>
            
            <div class="col-5 col-sm-5 col-md-7 col-lg-8 mb-4">
                <li class="list-group-item">Pseudo : <?=$utilisateur["pseudo"]?></li>
                <li class="list-group-item">Points : <?=$utilisateur["pointsUtilisateur"]?></li>
                <li class="list-group-item">Rôle : 
                <?php 
                if($utilisateur["idRole"]==1) { echo "Membre"; } else { echo "Administrateur"; }
                ?>
                </li>
            </div>
            
            <div class="float-right mb-4">
                <a href="modifierUtilisateur.php?id=<?=$utilisateur["idUtilisateur"];?>" class="btn btn-outline-primary w-100 py-4 h-50" id="bouton">Modifier</a>
                <br>
                <a href="../traitements/bannirUtilisateur.php?id=<?=$utilisateur["idUtilisateur"];?>&action=1" onclick="return confirm('Êtes vous certain de vouloir bannir <?=$utilisateur['pseudo'];?> ?');" 
                class="btn btn-outline-danger w-100 py-4 h-50" id="bouton">Bannir</a>
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