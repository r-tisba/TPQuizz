<?php
require_once "entete.php";
$idUtilisateur = $_SESSION["idUtilisateur"];
$utilisateur = new Utilisateur($idUtilisateur);
$question=$utilisateur->questionSecrete($idUtilisateur);
print_r($question);

if (!empty($_GET["error"])&& $_GET["error"] == "reponse") 
{
    ?>
    <div class="alert alert-danger mt-3">
    <?php
    echo "Votre réponse est fausse";
    ?>
    </div>
<?php
}
?>
<h2><?=$question["libelle"];?></h2>
<br>
<form method="post" action="../traitements/reponseSecrete.php">
    <div class="form-group">
        <label for="reponse">Réponse :</label>
        <input type="text" class="form-control" name="reponse" id="reponse" placeholder="Saisissez votre réponse secrète"/>
    </div>
                
    <div class="form-group text-center">
        <button type="submit" class="btn btn-outline-primary">Continuer</button>
    </div>
</form>

<?php
require_once "pied.php";