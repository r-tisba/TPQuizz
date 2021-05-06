<?php 

class Question extends Modele 
{
    private $idQuestion; // Int
    private $question; // String

    private $idQuiz;
    private $reponses = []; // Array of objects

    public function __construct($idQ = null)
    {
        if($idQ !== null)
        {
            $requete = $this->getBdd()->prepare("SELECT * FROM questions WHERE idQuestion = ?");
            $requete->execute([$idQ]);
            $requete = $requete->fetch(PDO::FETCH_ASSOC);

            $this->idQuestion = $idQ;
            $this->question = $requete["question"];
            $this->idQuiz = $requete["idQuiz"];


            $requete = $this->getBdd()->prepare("SELECT * FROM reponses WHERE idQuestion = ?");
            $requete->execute([$idQ]);
            $reponses = $requete->fetchAll(PDO::FETCH_ASSOC);


            foreach($reponses as $reponse)
            {
                $objetReponse = new Reponse($reponse["idReponse"]);
                $this->reponses[] = $objetReponse;
            }

        }
    }

    /*
    $Quiz = new Quiz(1)
    echo $Quiz->getQuestions()[0]->getReponses()[3]
    $questions = $Quizz->getQuestions()[2]
    */

    public function initialiserQuestion($idQuestion, $question)
    {
        $this->idQuestion = $idQuestion;
        $this->question = $question;
    
        $requete = $this->getBdd()->prepare("SELECT idReponse, reponse, validite FROM reponses WHERE idQuestion = ?");
        $requete->execute([$idQuestion]);
        $reponsesQuiz = $requete->fetchAll(PDO::FETCH_ASSOC);

        foreach($reponsesQuiz as $reponseQuiz)
        {
            $objetReponse = new Reponse();
            $objetReponse->initialiserReponse($reponseQuiz["idReponse"], $reponseQuiz["reponse"], $reponseQuiz["validite"]);
            $this->reponses[] = $objetReponse;
        }
    }

    public function addQ($question, $idQuiz)
    {
        $requete=$this->getBDD()->prepare("INSERT INTO questions(question, idQuiz) VALUES(?,?)");
        $requete->execute([$question, $idQuiz]);
        $this->questions=$question;
        $this->idQuiz=$idQuiz;
        $requete=$this->getBDD()->prepare("SELECT MAX(idQuestion) AS ID_Question FROM questions");
        $requete->execute();
        $idQuestion=$requete->fetch(PDO::FETCH_ASSOC);
        return $idQuestion["ID_Question"];

    }

    public function removeReponse($idReponse)
    {
        $requete=$this->getBdd()->prepare("DELETE * FROM reponses WHERE idReponse=?");
        $requete->execute([$idReponse]);
        $this->reponses=$idReponse;
    }

    public function recupererQuestionsQuiz($idQuiz)
    {
        $requete = $this->getBdd()->prepare("SELECT * FROM questions WHERE idQuiz = ?");
        $requete->execute([$idQuiz]);
        $questions=$requete->fetchAll(PDO::FETCH_ASSOC);

        $this->questions = $questions;
        return $questions;
    }

    // Verifie si la question n'a pas déjà été posé à cet utilisateur
    public function verifQuestionTermine($idUtilisateur, $idQuestion)
    {
        $requete = $this->getBDD()->prepare("SELECT * FROM reponses_utilisateurs WHERE idUtilisateur = ? AND idQuestion = ?");
        $requete->execute([$idUtilisateur, $idQuestion]);
        if($requete->rowCount() == 0)
        {
            return true;
        } else {
            return false;
        }
    }

    public function recupererQuestionsNonJoues($idQuiz, $idUtilisateur)
    {
        $requete = $this->getBdd()->prepare(
            
            "SELECT * 
            FROM questions Q 
            WHERE Q.idQuiz = ?
            AND (SELECT idUtilisateur FROM reponses_utilisateurs RU WHERE Q.idQuestion = RU.idQuestion AND idUtilisateur = ?) IS NULL");

        $requete->execute([$idQuiz, $idUtilisateur]);
        $questions = $requete->fetchAll(PDO::FETCH_ASSOC);

        $this->questions = $questions;
        return $questions;
    }
    

    public function getIdQuestion()
    {
        return $this->idQuestion;
    }
    public function getQuestion()
    {
        return $this->question;
    }
    public function getReponses()
    {
        return $this->reponses;
    }
    public function getValidite()
    {
        return $this->validite;
    }
    public function getIdQuiz()
    {
        return $this->idQuiz;
    }

    public function setQuestion($newQuestion)
    {
        $this->question = $newQuestion;
    } 
    public function setReponse($newReponse)
    {
        $this->reponse = $newReponse;
    } 
    public function setValidite($newValidite)
    {
        $this->validite = $newValidite;
    } 
}

