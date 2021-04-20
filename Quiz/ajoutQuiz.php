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

    <h1> Ajout d'un nouveau quiz</h1><br>
    <form method="post" action="../traitements/ajoutQuiz.php?id=<?=$_GET["id"];?>">
        <div class="form-group">
            <label for="nomQuiz"><h3><b>Nouveau Quiz :</b></h3></label>
            <input type="text" class="form-control" name="nomQuiz" id="nomQuiz" placeholder="Saisissez la nom du quiz" />
        </div><br>
        <?php
        for($i=0; $i<10; $i++){
        ?>
        <div class="form-group">
            <label for="question"><h5><b>Question <?=$i+1;?> :</b></h5></label>
            <input type="text" class="form-control" name="question[<?=$i?>]" id="question" placeholder="Saisissez la question"/>
        </div><br>
        <div class="form-group">
            <label for="reponse" style="color:green;"><b>bonne réponse :</b></label>
            <input type="text" class="form-control" name="reponse[<?=$i?>][]" id="reponse" placeholder="Saisissez la bonne réponse"/>
        </div><br>
        <div class="form-group">
            <label for="reponse" style="color:red;"><b>mauvaises réponses :</b></label>
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


