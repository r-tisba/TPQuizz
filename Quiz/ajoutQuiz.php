<?php
require_once "entete.php";

$idCategorie=$_GET["id"];
?>

<div class="container">

    <?php if(!empty($_GET["success"]) && $_GET["success"] == "ajout")
        {
            ?>
            <div class="alert alert-success">
                Le quiz a bien été crée<br>
                Vous allez être redirigé vers la liste des quiz<br>
                <a href="../admin/listeQuiz.php?id=<?=$idCategorie;?>">Cliquez ici pour une redirection manuelle</a>
            </div>
            <?php 
            header("refresh:3;../admin/listeQuiz.php?id=$idCategorie");
        } 
        ?>

    <?php if (!empty($_GET["error"])) 
    {
        ?>
        <div class="alert alert-danger mt-2">
        <?php switch($_GET["error"]) 
        {
            case "id": ?>
                <?php echo "Une erreur s'est produite lors de la récupération de la categorie"; ?>
                <?php break;?>
            <?php case "missing": ?>
                <?php echo "Erreur: vous n'êtes pas connecté ou vous n'avez pas saisi le nom du quiz"; ?>
                <?php break;?>
        <?php 
        }
        ?>
        </div>
    <?php 
    }
//if(!empty($_SESSION["identifiant"]) && $_SESSION["idRole"] == 2)
//{
?>

    <div class="row">
    <div class="col-md-12">
    <div class="card card-white">
    <div class="card-body">

    <h1>Ajout d'un nouveau quiz</h1><br>
    <form method="post" action="../traitements/ajoutQuiz.php?id=<?=$_GET["id"];?>">
        <div class="form-group">
            <label for="nomQuiz"><h3><b>Nouveau quiz :</b></h3></label>
            <input type="text" class="form-control" name="nomQuiz" id="nomQuiz" placeholder="Saisissez la nom du quiz" />
        </div>
        <div class="form-group">
            <label for="nomQuiz"><h3><b>Lien de l'illustration (optionel) :</b></h3></label>
            <input type="text" class="form-control" name="illustration" id="illustration" placeholder="Saisissez le lien de l'illustration" />
        </div><br>
        <?php
        for($i=0; $i<10; $i++)
        {
            ?>
            <div class="form-group">
                <label for="question"><h5><b>Question :<?=$i+1;?> :</b></h5></label>
                <input type="text" class="form-control" name="question[<?=$i?>]" id="question" placeholder="Saisissez la question"/>
            </div><br>
            <div class="form-group">
                <label for="reponse" style="color:green;"><b>Bonne réponse :</b></label>
                <input type="text" class="form-control" name="reponse[<?=$i?>][]" id="reponse" placeholder="Saisissez la bonne réponse"/>
            </div><br>
            <div class="form-group">
                <label for="reponse" style="color:red;"><b>Mauvaises réponses :</b></label>
                <input type="text" class="form-control" name="reponse[<?=$i?>][]" id="reponse" placeholder="Saisissez une mauvaise réponse"/><br>
            
                <input type="text" class="form-control" name="reponse[<?=$i?>][]" id="reponse" placeholder="Saisissez une mauvaise réponse"/><br>
            
                <input type="text" class="form-control" name="reponse[<?=$i?>][]" id="reponse" placeholder="Saisissez une mauvaise réponse"/><br>
            </div>
            <hr>
            <?php
        }
        ?> 
        <div class="form-group text-center">
            <button type="submit" class="btn btn-outline-primary">Ajouter le quiz</button>        
        </div>
        </div>
    </form>

    </div>
    </div>
    </div>
    </div>
</div>

<?php
//}


