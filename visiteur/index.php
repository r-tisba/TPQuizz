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



?>

<a href="connexion.php">Connexion</a>