<?php
require_once "entete.php";

?>

<div class="container">

<?php if(!empty($_GET["success"]) && $_GET["success"] == "ajout") 
{
    ?>
    <div class="alert alert-success mt-3">Le quiz a bien été enregistrer <br> 
        Veuillez rentrer les réponses.
    </div>
       
        
    <div class="row">
    <div class="col-md-12">
    <div class="card card-white">
    <div class="card-body">

    <h1> Ajout d'une reponse</h1>
    <form method="post" action="../traitements/ajoutReponse.php?id">
        <div class="form-group">
            <label for="question">Nouvelle réponse :</label>
            <input type="text" class="form-control" name="question" id="question" placeholder="Saisissez la question"/>
        </div>
            
        <div class="form-group text-center">
            <button type="submit" class="btn btn-outline-primary">Ajouter la question</button>        
        </div>
        </div>
    </form>

    </div>
    </div>
    </div>
<?php
}
?>
    
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

    
    </div>
</div>

<?php
//}


