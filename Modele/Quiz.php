<?php 

class Quiz extends Modele 
{
    private $idQuiz; // int
    private $nomQuiz; // string
    private $auteur; // string

    private $categorie; // objet
    private $questions = []; // array

    public function __construct($idQuiz = null)
    {
        if($idQuiz !== null)
        {
            $requete = $this->getBdd()->prepare("SELECT nomQuiz, idCategorie FROM quiz WHERE idQuiz = ?");
            $requete->execute([$idQuiz]);
            $infos = $requete->fetch(PDO::FETCH_ASSOC);

            $requete = $this->getBdd()->prepare("SELECT * FROM questions WHERE idQuiz = ?");
            $requete->execute([$idQuiz]);
            $questions = $requete->fetchAll(PDO::FETCH_ASSOC);

            $this->idQuiz = $idQuiz;
            $this->nomQuiz  = $infos["nomQuiz"];

            $this->categorie = $infos["idCategorie"];

            /*
            $requete = $this->getBdd()->prepare("SELECT * FROM questions LEFT JOIN reponses USING(idQuestion)  WHERE idQuiz = ?");
            $requete->execute([$idQuiz]);
            $leQuiz = $requete->fetch(PDO::FETCH_ASSOC);

            // A déclarer en amont
            $this->idReponse = $leQuiz["idReponse"];
            $this->reponse = $leQuiz["reponse"];
            $this->idQuestion = $leQuiz["idQuestion"];
            $this->Question = $leQuiz["question"];
            */

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

    public function addQ($question, $idQuiz){
        $requete=$this->getBDD()->prepare("INSERT INTO questions(question, idQuiz) VALUES(?,?)");
        $requete->execute([$question, $idQuiz]);
        $this->questions=$question;
        $this->idQuiz=$idQuiz;
        return true;

    }
    public function addQuiz($nomQuiz, $auteur, $idCategorie){
        $requete=$this->getBDD()->prepare("INSERT INTO questions(nomQuiz, auteur, idCategorie) VALUES(?,?,?)");
        $requete->execute([$nomQuiz, $auteur, $idCategorie]); 
        $this->nomQuiz  = $nomQuiz;
        $this->auteur  = $auteur;
        $this->categorie = $idCategorie;
        return true;

    }
    
}