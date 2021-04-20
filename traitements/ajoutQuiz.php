<?php
require_once "../Modele/Modele.php";
require_once "../Modele/Application.php";
require_once "../Modele/Quiz.php";
require_once "../Modele/Utilisateur.php";
require_once "../Modele/Categorie.php";
require_once "../Modele/Question.php";
require_once "../Modele/Reponse.php";
session_start();
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit;
if (!empty($_GET["id"]))
{
    $idCategorie=$_GET["id"];
    if(!empty($_POST["nomQuiz"]) && !empty($_SESSION["idUtilisateur"]))
    {
        $nomQuiz=$_POST["nomQuiz"];
        $idUtilisateur=$_SESSION["idUtilisateur"];
        $nouvQuiz= new Quiz();
        $idQuiz=$nouvQuiz->addQuiz($nomQuiz, $idUtilisateur, $idCategorie);
        foreach($_POST["question"] as $question){
            if(!empty($_POST["question"]) && !empty($idQuiz))
            {
                $idQuestion=$nouvQuiz->addQ($question, $idQuiz);
                foreach($_POST["reponse"] as $reponse){
                if(!empty($reponse)&&!empty($idQuestion)){
                        $validite;
                        $count=0;
                        $compteur=0;
                        
                        for($i=0; $i<4; $i++){
                            $reponse[$compteur++][$i];
                            if($i=0){
                                $validite=1;
                            }
                        }
                        
                        $Laquestion= new Question($idQuestion);
                        if($Laquestion->addReponse($reponse[$count++][$i], $validite, $idQuestion)){
                            header("location:../admin/ajoutQuestion.php?success=ajout");
                        }else{
                            header("location:../admin/ajoutQuestion.php?error=ajoutReponse");
                        }
                    }else{
                        header("location:../admin/ajoutQuestion.php?error=reponseVide");

                    }
                }
                
            }else{
                header("location:../admin/ajoutQuestion.php?error=questionVide");
            }
        }
        
    }else{
    header("location:../admin/ajoutQuestion.php?error=missing");
}
}else{
    header("location:../admin/ajoutQuestion.php?error=id");
}