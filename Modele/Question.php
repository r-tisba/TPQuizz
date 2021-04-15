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
            $laQuestion = $requete->fetch(PDO::FETCH_ASSOC);

            $this->idQuestion = $idQ;
            $this->question = $laQuestion["question"];

            /*
            $requete=$this->getBdd()->prepare("SELECT * FROM reponses LEFT JOIN association_questionsreponses USING(idReponse) WHERE idQuestion = ?");
            $requete->execute([$idQ]);
            $laReponse=$requete->fetch(PDO::FETCH_ASSOC);
            
            $this->idReponse = $laReponse["idReponse"];
            $this->reponse = $laReponse["reponse"];
            $this->validite = $laReponse["validite"];
            */
            

            $requete = $this->getBdd()->prepare("SELECT * FROM reponses WHERE idQuestion = ?");
            $requete->execute([$idQ]);
            $reponses = $requete->fetchAll(PDO::FETCH_ASSOC);

            $this->idReponse=$reponses["idReponse"];
            $this->reponse=$reponses["reponse"];
            $this->validite=$reponses["validite"];

            foreach($reponses as $reponse)
            {
                $objetReponse = new Reponse($reponse["idReponse"]);
                $this->reponses[] = $objetReponse;
            }

        }
    }

    public function initialiserQuestion($idQuestion, $description)
    {
        $this->idQuestion = $idQuestion;
        $this->description = $description;
    

        $requete = $this->getBdd()->prepare("SELECT idReponse, reponse, validite FROM reponses WHERE idQuestion = ?");
        $requete->execute(["idQuestion"]);
        $reponsesQuiz = $requete->fetchAll(PDO::FETCH_ASSOC);

        foreach($reponsesQuiz as $reponseQuiz)
        {
            $objetReponse = new Reponse();
            $objetReponse->initialiserReponse($reponseQuiz["idReponse"], $reponseQuiz["reponse"], $reponseQuiz["validite"]);
            $this->reponses[] = $objetReponse;
        }
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