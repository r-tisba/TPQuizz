<?php
require_once "entete.php";
$quiz= new Quiz(1);
echo $quiz->getQuestion()[0]->getReponse()[2];
exit;
$questions=$quiz->getQuestion();
// echo "<pre>";
// print_r($questions);
// echo "</pre>";
// exit;
foreach($questions as $cleQuestion=>$question){
    ?>
<div class="card-header p-1">
                        <h5 class="card-title d-flex justify-content-center pt-2"><?=$question;?> </h5>
                    </div>


<?php
}
?>