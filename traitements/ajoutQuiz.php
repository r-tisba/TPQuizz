<?php
require_once "../Modele/Modele.php";
require_once "../Modele/Application.php";
require_once "../Modele/Quiz.php";
require_once "../Modele/Utilisateur.php";
require_once "../Modele/Categorie.php";
require_once "../Modele/Question.php";
require_once "../Modele/Reponse.php";
session_start();
$illustration;

if (empty($_POST["illustration"]))
{
    $illustration = "../images/design/illustrationQuizDefaut.jpg";
} else {
    $illustration = $_POST["illustration"];
}
if (!empty($_GET["id"]))
{
    $idCategorie=$_GET["id"];
    if(!empty($_POST["nomQuiz"]) && !empty($_SESSION["idUtilisateur"]))
    {
        $nomQuiz=$_POST["nomQuiz"];
        $idUtilisateur=$_SESSION["idUtilisateur"];

        $nouvQuiz= new Quiz();
        $idQuiz=$nouvQuiz->addQuiz($nomQuiz, $idUtilisateur, $idCategorie, $illustration);
        foreach($_POST["question"] as $cleQuestion => $question)
        {    
            $nouvQuestion = new Question();
            // déplacer la méthode addQ vers Question
            $idQuestion=$nouvQuestion->addQ($question, $idQuiz);
            $reponses=$_POST["reponse"][$cleQuestion];

            foreach($reponses as $cleReponse=>$reponse)
            {
                $validite = 0;
                if($cleReponse == 0)
                {
                    $validite=1;
                }
                $nouvReponse = new Reponse();
                // déplacer la méthode addR vers Reponse
                $nouvReponse->addR($reponse, $validite, $idQuestion);

            }
                    
        }                                            
        header("location:../Quiz/ajoutQuiz.php?success=ajout&id=$idCategorie");

    } else {
    header("location:../Quiz/ajoutQuiz.php?error=missing&id=$idCategorie");
    }

} else {
    header("location:../Quiz/ajoutQuiz.php?error=id&id=$idCategorie");
}