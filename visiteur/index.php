<?php
require_once "entete.php";


if (!empty($_SESSION["idRole"]) && $_SESSION["idRole"] == 2) 
{
    header("location:../admin/indexAdmin.php");
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
$quiz= new Quizz(1);
print_r($quiz);

echo "<br>".$quiz->getR()."<br>";
echo $quiz-> getNQu()."<br>";

echo $quiz-> getQ()."<br>";
echo $quiz-> getIdQ()."<br>";
echo $quiz-> getIdCat()."<br>";
echo $quiz-> getR()."<br>";
echo $quiz-> getIdR()."<br>";
