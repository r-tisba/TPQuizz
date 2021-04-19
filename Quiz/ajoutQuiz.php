<?php
require_once "entete.php";

?>

<div class="container">


    
<?php if (!empty($_GET["error"])) 
{
    ?>
    <div class="alert alert-danger mt-2">
    <?php switch($_GET["error"]) 
    {
        case "missing": ?>
            <?php echo "Au moins un des champs est vide"; ?>
            <?php break;?>
        <?php case "erreurajout": ?>
            <?php echo "Une erreur s'est produite lors de l'ajout"; ?>
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

    <h1> Ajout d'un nouveau quiz</h1>
    <form method="post" action="../traitements/ajoutQuiz.php">
        <div class="form-group">
            <label for="nomQuiz">Nouvelle question :</label>
            <input type="text" class="form-control" name="nomQuiz" id="nomQuiz" placeholder="Saisissez la nom du quiz"/>
        </div>
        <div class="form-group">
            <label for="categorie">Nouvelle question :</label>
            <input type="selected" class="form-control" name="nomQuiz" id="nomQuiz" placeholder="Saisissez la nom du quiz"/>
        </div>
        <?php
        for($i=0; $i<10; $i++){
        ?>
        <div class="form-group">
            <label for="question">Nouvelle question :</label>
            <input type="text" class="form-control" name="question" id="question" placeholder="Saisissez la question"/>
        </div>
        <div class="form-group">
            <label for="reponse">bonne réponse :</label>
            <input type="text" class="form-control" name="reponse" id="reponse" placeholder="Saisissez la bonne réponse"/>
            <?php $LaReponse["validite"]=1;?>
        </div>
        <div class="form-group">
            <label for="reponse">mauvaise réponse :</label>
            <input type="text" class="form-control" name="reponse" id="reponse" placeholder="Saisissez une mauvaise réponse"/>
            <?php $LaReponse["validite"]=0;?>
        </div>
        <div class="form-group">
            <label for="reponse">mauvaise réponse :</label>
            <input type="text" class="form-control" name="reponse" id="reponse" placeholder="Saisissez une mauvaise réponse"/>
            <?php $LaReponse["validite"]=0;?>
        </div>
        <div class="form-group">
            <label for="reponse">mauvaise réponse :</label>
            <input type="text" class="form-control" name="reponse" id="reponse" placeholder="Saisissez une mauvaise réponse"/>
            <?php $LaReponse["validite"]=0;?>
        </div>
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


