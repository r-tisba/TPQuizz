<?php

class Application extends Modele
{

    public $utilisateurs = [];
    public $categories = [];
    public $quizs = [];
    public $roles = [];
    public $questionsSecretes = [];
    // public $questions = [];

    public function __construct()
    {
        $requete = $this->getBdd()->prepare("SELECT * FROM utilisateurs");
        $requete->execute();
        $utilisateurs=$requete->fetchAll(PDO::FETCH_ASSOC);

        $this->utilisateurs = $utilisateurs;

        $requete = $this->getBdd()->prepare("SELECT * FROM roles");
        $requete->execute();
        $roles=$requete->fetchAll(PDO::FETCH_ASSOC);

        $this->roles = $roles;

        $requete = $this->getBdd()->prepare("SELECT * FROM questionssecretes");
        $requete->execute();
        $questionsSecretes=$requete->fetchAll(PDO::FETCH_ASSOC);

        $this->questionsSecretes = $questionsSecretes;

        $requete = $this->getBdd()->prepare("SELECT * FROM categories");
        $requete->execute();
        $categories=$requete->fetchAll(PDO::FETCH_ASSOC);

        $this->categories = $categories;

        $requete = $this->getBdd()->prepare("SELECT * FROM quiz");
        $requete->execute();
        $quizs=$requete->fetchAll(PDO::FETCH_ASSOC);

        $this->quizs = $quizs;

        $requete = $this->getBDD()->prepare("SELECT * FROM amis");
        $requete->execute();
        $amis=$requete->fetchAll(PDO::FETCH_ASSOC);

        $this->amis = $amis;

        /*
        $requete = $this->getBdd()->prepare("SELECT * FROM questions");
        $requete->execute();
        $questions=$requete->fetchAll(PDO::FETCH_ASSOC);

        $this->questions = $questions;
        */
    }

    // A DEPLACER (entete ou Services)
    public function gererGuillemets($string)
    {
        /* return str_replace('"', '\"', $string); */
        return trim(htmlspecialchars($string, ENT_QUOTES, 'UTF-8', false));
    }


    // A DEPLACER (entete ou Services)
    public function dateFr($date)
    {
        if($datetime = DateTime::createfromformat("Y-m-d H:i:s", $date))
        {
            return $date = $datetime->format("d/m/Y à H:i");
            
        } else if($datetime = DateTime::createfromformat("Y-m-d", $date))
        {
            return $date = $datetime->format("d/m/Y");
        }
    }

    public function getUtilisateurs()
    {
        return $this->utilisateurs;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function getQuestionsSecretes()
    {
        return $this->questionsSecretes;
    }

    public function getCategories()
    {
        return $this->categories;
    }

    public function getQuizs()
    {
        return $this->quizs;
    }

    public function getAmis()
    {
        return $this->amis;
    }

    /*
    public function getQuestions()
    {
        return $this->questions;
    }
    */

}