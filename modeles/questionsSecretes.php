<?php 

function recupererQuestionsSecretes()
{
    $requete = getBDD()->prepare("SELECT * FROM questionsSecretes");
    $requete->execute();
    return $requete->fetchAll(PDO::FETCH_ASSOC);
}

function recupererReponsesQuestionsSecretes()
{
    $requete = getBDD()->prepare("SELECT * FROM reponsesQuestionsSecretes");
    $requete->execute();
    return $requete->fetchAll(PDO::FETCH_ASSOC);
}

function ajouterReponseQuestionSecrete($idUtilisateur, $idQuestion, $reponse)
{
    $requete = getBDD()->prepare("INSERT INTO reponses_questionssecretes(idUtilisateur, idQuestion, reponse ) 
    VALUES(?, ?, ?)");
    $requete->execute([$idUtilisateur, $idQuestion, $reponse]);
    return true;
}

