<?php

class Quizz extends Modele{
private $idQuiz; // int

    private $nomQuiz; // string



    private $categorie; // objet

    private $questions = []; // array
    private $Question;
    private $idQuestion ;

    private $idReponse;
    private $reponse;



    public function __construct($idQuiz = null)

    {

        if($idQuiz !== null){

            $requete = $this->getBdd()->prepare("SELECT nomQuiz, idCategorie FROM quiz WHERE idQuiz = ?");

            $requete->execute([$idQuiz]);

            $infos = $requete->fetch(PDO::FETCH_ASSOC);



            $requete = $this->getBdd()->prepare("SELECT * FROM questions LEFT JOIN association_questionsquiz USING(idQuestion) WHERE idQuiz = ?");

            $requete->execute([$idQuiz]);

            $questions = $requete->fetchAll(PDO::FETCH_ASSOC);



            $this->idQuiz = $idQuiz;

            $this->nomQuiz  = $infos["nomQuiz"];

            $this->categorie = $infos["idCategorie"];

            $requete=$this->getBdd()->prepare("SELECT * FROM questions LEFT JOIN association_questionsreponses USING(idQuestion) LEFT JOIN reponses USING(idReponse) LEFT JOIN association_questionsquiz USING(idQuestion) WHERE idQuiz=?");
            $requete->execute([$idQuiz]);
            $leQuiz=$requete->fetch(PDO::FETCH_ASSOC);

            $this->idReponse=$leQuiz["idReponse"];
            $this->reponse=$leQuiz["reponse"];
            $this->idQuestion=$leQuiz["idQuestion"];
            $this->Question =$leQuiz["question"];
            



            foreach ( $questions as $question ){

                $objetQuestion = new Question($question["idQuestion"]);

                $this->questions[] = $objetQuestion;



            }



        }

    }
    public function getNQu()
    {
        // $this permet de faire réference à l'objet
        return $this->nomQuiz;
    }
    
    public function getQ()
    {
        // $this permet de faire réference à l'objet
        return $this->Question;
    }
    public function getIdQ()
    {
        // $this permet de faire réference à l'objet
        return $this->idQuestion;
    }
    
    public function getIdCat()
    {
        // $this permet de faire réference à l'objet
        return $this->categorie;
    }
    public function getR()
    {
        // $this permet de faire réference à l'objet
        return $this->reponse;
    }
    public function getIdR()
    {
        // $this permet de faire réference à l'objet
        return $this->idReponse;
    }
}