<?php
require_once "../Modele/Modele.php";
require_once "../Modele/Quiz.php";

if (!empty($_GET["id"]))
{
    $idQuiz=$_GET["id"];
    if(!empty($_POST["question"]) && !empty($_POST["idQuiz"]))
    {
        extract($_POST);
    
        $Lequiz=new Quiz($idQuiz);
        if($Lequiz->addQ($question, $idQuiz)){
            header("location:../admin/ajoutQuestion.php?success=ajout");
        }else{
        header("location:../admin/ajoutQuestion.php?error=fonction");

        }
    }else{
    header("location:../admin/ajoutQuestion.php?error=missing");
}
}else{
    header("location:../admin/ajoutQuestion.php?error=id");
}