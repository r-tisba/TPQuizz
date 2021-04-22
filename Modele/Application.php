<?php

class Application extends Modele
{

    public $utilisateurs = [];
    public $categories = [];
    public $quizs = [];
    public $roles = [];
    public $questions = [];

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
        $questions=$requete->fetchAll(PDO::FETCH_ASSOC);

        $this->questions = $questions;

        $requete = $this->getBdd()->prepare("SELECT * FROM categories");
        $requete->execute();
        $categories=$requete->fetchAll(PDO::FETCH_ASSOC);

        $this->categories = $categories;

        $requete = $this->getBdd()->prepare("SELECT * FROM quiz");
        $requete->execute();
        $quizs=$requete->fetchAll(PDO::FETCH_ASSOC);

        $this->quizs = $quizs;
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
        return $this->questions;
    }

    public function getCategories()
    {
        return $this->categories;
    }

    public function getQuizs()
    {
        return $this->quizs;
    }

}