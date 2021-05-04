<?php
require_once "../admin/entete.php";
$utilisateur = new Utilisateur($_SESSION["pseudo"]);
$application = new Application();

$idQuiz = $_GET["id"];
$quiz = new Quiz($_GET["id"]);

/*
echo "<pre>";
print_r($quiz->getQuestions());
echo "</pre>";
*/
?>
<div class="container">
    <div id="home" class="flex-column flex-center">
        <h1>Prêt pour le quiz "<?=$quiz->getNomQuiz();?>" ?</h1>
        <a href="../Quiz/jeu.php?id=<?=$idQuiz;?>" class="btn">Commencer le quiz</a>
    </div>
</div>
<?php

