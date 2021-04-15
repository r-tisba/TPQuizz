<?php
class Question extends Modele
{
    private $idQuestion ;
    private $question;

    private $idReponse;
    private $reponse;
    private $validite;

    public function __construct($idQ=null)
    {
        if($idQ!=null){
            $requete=$this->getBdd()->prepare("SELECT * FROM questions WHERE idQuestion=?");
            $requete->execute([$idQ]);
            $laQuestion=$requete->fetch(PDO::FETCH_ASSOC);
            $this->idQuestion=$idQ;
            $this->question=$laQuestion["question"];

            $requete=$this->getBdd()->prepare("SELECT * FROM reponses LEFT JOIN association_questionsreponses USING(idReponse) WHERE idQuestion=?");
            $requete->execute([$idQ]);
            $laReponse=$requete->fetch(PDO::FETCH_ASSOC);
            
            $this->idReponse=$laReponse["idReponse"];
            $this->reponse=$laReponse["reponse"];
            $this->validite=$laReponse["validite"];

 
        }
    }
    public function getQ()
    {
        // $this permet de faire réference à l'objet
        return $this->question;
    }
    public function setQ($newQ)
    {
        $this->question = $newQ;
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
}