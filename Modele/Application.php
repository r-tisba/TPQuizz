<?php

class Application extends Modele
{

    public $categories = [];

    public function __construct()
    {
        $requete = $this->getBdd()->prepare("SELECT * FROM categories");
        $requete->execute();
        $categories=$requete->fetchAll(PDO::FETCH_ASSOC);

        $this->categories = $categories;

        $requete = $this->getBdd()->prepare("SELECT * FROM quiz");
        $requete->execute();
        $quizs=$requete->fetchAll(PDO::FETCH_ASSOC);

        $this->quizs = $quizs;
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