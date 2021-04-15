<?php
class Reponse extends Modele{
    private $idReponse;
    private $reponse;
    private $validite;

    public function __construct($idR=null)
    {
        if($idR!=null){
            $requete=$this->getBdd()->prepare("SELECT * FROM reponses WHERE idReponse=?");
            $requete->execute([$idR]);
            $LaReponse = $requete->fetch(PDO::FETCH_ASSOC);

            $this->idReponse=$idR;
            $this->reponse = $LaReponse["reponse"];
            $this->validite = $LaReponse["validite"];
        }
    }
    public function getR()
    {
        // $this permet de faire réference à l'objet
        return $this->reponse;
    }
    public function setR($newR)
    {
        $this->reponse = $newR;
    } 
    public function getV()
    {
        // $this permet de faire réference à l'objet
        return $this->validite;
    }
    public function setV($newV)
    {
        $this->validite = $newV;
    } 
    public function initialiserReponse($idR, $reponse)
    {
        $this->idQuestion = $idR;
        $this->reponse = $reponse;


        $requete = $this->getBdd()->prepare("SELECT idReponse, reponse, validite FROM reponses LEFT JOIN association_questionsreponses USING(idReponse) WHERE idQuestion = ?");
        $requete->execute(["idQuestion"]);
        $reponsesQuiz = $requete->fetchAll(PDO::FETCH_ASSOC);

        foreach($reponsesQuiz as $reponseQuiz)
        {
            $objetReponse = new Reponse();
            $objetReponse->initialiserReponse($reponseQuiz["idReponse"], $reponseQuiz["reponse"], $reponseQuiz["validite"]);
            $this->reponses[] = $objetReponse;
        }
    }
}