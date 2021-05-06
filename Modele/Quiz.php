<?php 

class Quiz extends Modele 
{
    private $idQuiz; // int
    private $nomQuiz; // string
    private $idUtilisateur; // string
    private $illustration; // string

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

    
    public function addQuiz($nomQuiz, $idUtilisateur, $idCategorie, $illustration)
    {
        $requete=$this->getBDD()->prepare("INSERT INTO quiz(nomQuiz, idUtilisateur, idCategorie, illustration, dateCreation) VALUES(?, ?, ?, ?, ?)");
        $requete->execute([$nomQuiz, $idUtilisateur, $idCategorie, $illustration, date("Y-m-d H:i:s")]); 
        
        $this->nomQuiz  = $nomQuiz;
        $this->idUtilisateur  = $idUtilisateur;
        $this->illustration  = $illustration;
        $this->categorie = new Categorie($idCategorie);
        $requete=$this->getBDD()->prepare("SELECT MAX(idQuiz) AS ID_Quiz FROM quiz");
        $requete->execute();
        $idQuiz=$requete->fetch(PDO::FETCH_ASSOC);
        return $idQuiz["ID_Quiz"];

    }

    // A FINIR
    public function supprimerQuiz($idQuiz)
    {
        $requete = $this->getBDD()->prepare("DELETE FROM reponses INNER JOIN questions USING(idQuestion) WHERE idQuiz = ? ");
        $requete->execute([$idQuiz]);
        
        $requete = $this->getBDD()->prepare("DELETE FROM questions WHERE idQuiz = ?");
        $requete->execute([$idQuiz]);

        $requete = $this->getBDD()->prepare("DELETE FROM quiz WHERE idQuiz = ?");
        $requete->execute([$idQuiz]);

        $this->idQuiz=$idQuiz;
        return true;
    }
    public function dernierQuiz()
    {
        $requete = $this->getBDD()->prepare("SELECT * FROM quiz WHERE verification=1 ORDER BY idQuiz DESC LIMIT 1");
        $requete->execute();
        $dernierQuiz = $requete->fetchAll(PDO::FETCH_ASSOC);
        
        return $dernierQuiz;
        

    }
    public function quizPopulaire()
    {
        $requete = $this->getBDD()->prepare("SELECT * FROM quiz_termines LEFT JOIN quiz USING(idQuiz) GROUP BY idQuiz ORDER BY COUNT(quiz_termines.idUtilisateur) DESC LIMIT 1 ");
        $requete->execute();
        $quizPop = $requete->fetchAll(PDO::FETCH_ASSOC);
        
        return $quizPop;
        

    }
    public function verifierQuiz()
    {
        $requete = $this->getBDD()->prepare("SELECT * FROM quiz WHERE verification=0");
        $requete->execute();
        $quizAVerifier = $requete->fetchAll(PDO::FETCH_ASSOC);
        
        return $quizAVerifier;
        

    }
    public function validerQuiz($idQuiz)
    {
        $requete = $this->getBDD()->prepare("UPDATE quiz SET verification=1 WHERE idQuiz=?");
        $requete->execute([$idQuiz]);
        $this->idQuiz=$idQuiz;
        return true;
                

    }

    public function getIdQuiz()
    {
       return $this->idQuiz;
    }
    public function getNomQuiz()
    {
       return $this->nomQuiz;
    }
    public function getQuestions()
    {
        return $this->questions;
    }
    public function getIdCat()
    {
        return $this->categorie;
    }
    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }
    public function getIllustration()
    {
        return $this->illustration;
    }
}