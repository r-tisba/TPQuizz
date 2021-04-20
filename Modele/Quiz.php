<?php 

class Quiz extends Modele 
{
    private $idQuiz; // int
    private $nomQuiz; // string

    private $categorie; // objet
    private $questions = []; // array

    public function __construct($idQuiz = null)
    {
        if($idQuiz !== null)
        {
            $requete = $this->getBdd()->prepare("SELECT nomQuiz, idCategorie FROM quiz WHERE idQuiz = ?");
            $requete->execute([$idQuiz]);
            $infos = $requete->fetch(PDO::FETCH_ASSOC);

            $this->idQuiz = $idQuiz;
            $this->nomQuiz  = $infos["nomQuiz"];
            $this->categorie = $infos["idCategorie"];

            $requete = $this->getBdd()->prepare("SELECT * FROM questions WHERE idQuiz = ?");
            $requete->execute([$idQuiz]);
            $questions = $requete->fetchAll(PDO::FETCH_ASSOC);

            // Pour chaque question
            foreach ($questions as $question)
            {
                $objetQuestion = new Question();
                $objetQuestion->initialiserQuestion($question["idQuestion"], $question["question"]);
                $this->questions[] = $objetQuestion;
                // Le getter return le tableau questions[]
            }        
        }
    }

    public function getNomQuiz()
    {
       return $this->nomQuiz;
    }
    public function getQuestion()
    {
        return $this->Question;
    }
    public function getIdQuestion()
    {
        return $this->idQuestion;
    }
    public function getIdCat()
    {
        return $this->categorie;
    }
    public function getReponse()
    {
        return $this->reponse;
    }
    public function getIdReponse()
    {
        return $this->idReponse;
    }
}