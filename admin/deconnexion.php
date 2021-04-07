<?php
require_once "../admin/entete.php";
@session_start();

// On détruit les variables de notre session
session_unset();

// On détruit la session
session_destroy();

?>
<div class="alert alert-success mt-3">
    Vous avez été déconnecté<br>
    Vous allez être redirigé vers la page d'accueil<br>
    <a href="../visiteur/index.php">Cliquez ici pour une redirection manuelle</a>
 </div>
<?php 
header("refresh:3;../visiteur/index.php");
?>

<?php
//require_once "../admin/pied.php";