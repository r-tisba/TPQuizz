<?php
require_once "../visiteur/entete.php";

if (!empty($_SESSION["idRole"]) && $_SESSION["idRole"] == 2) 
{
    header("location:../admin/index.php");
} 
if (!empty($_SESSION["idRole"]) && $_SESSION["idRole"] == 1) 
{
    header("location:../membre/index.php");
} 

if (!empty($_SESSION["idRole"]) && $_SESSION["idRole"] == 3){
    ?>
    <p>Vous avez été banni</p>
<?php
}
// $quiz= new Quizz(1);
// print_r($quiz);

$quiz = new Quiz(1);

echo "<pre>";
print_r($quiz);
echo "</pre>";

echo "Nom du quiz : " . $quiz->getNomQuiz();
echo "<br>";

$categorie = new Categorie(1);
print_r("La catégorie du quiz est : " . $categorie->getNomCat());
echo "<br>";

$reponse = new Reponse(1);
echo "Reponse 1 : " . $reponse->getReponse() . "<br>";
$reponse = new Reponse(2);
echo "Reponse 2 : " . $reponse->getReponse() . "<br>";
$reponse = new Reponse(3);
echo "Reponse 3 : " . $reponse->getReponse() . "<br>";
$reponse = new Reponse(4);
echo "Reponse 4 : " . $reponse->getReponse() . "<br>";
echo "<br> <hr>";


$question = new Question(1);
echo "<pre>";
print_r($question);
echo "</pre>";

?>
