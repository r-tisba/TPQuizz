<?php 

class Reponse extends Modele
{
    private $idReponse;
    private $reponse;
    private $validite;
    private $idQuestion;

    public function __construct($idReponse=null)
    {
        if($idReponse != null)
        {
            $requete = $this->getBdd()->prepare("SELECT * FROM reponses WHERE idReponse = ?");
            $requete->execute([$idReponse]);
            $LaReponse = $requete->fetch(PDO::FETCH_ASSOC);

            $this->idReponse = $idReponse;
            $this->reponse = $LaReponse["reponse"];
            $this->validite = $LaReponse["validite"];
        }
    }

    public function initialiserReponse($idReponse, $reponse, $validite)
    {
        $this->idReponse = $idReponse;
        $this->reponse = $reponse;
        $this->validite = $validite;
    }

    public function addR($reponse, $validite, $idQuestion)
    {
        $requete=$this->getBDD()->prepare("INSERT INTO reponses(reponse, validite, idQuestion) VALUES(?, ?, ?)");
        $requete->execute([$reponse, $validite, $idQuestion]);
        $this->idQuestion=$idQuestion;
        $this->reponses=$reponse;
        $this->validite=$validite;
        return true;
    }

    public function getIdReponse()
    {
        return $this->idReponse;
    }
    public function getReponse()
    {
        return $this->reponse;
    }
    public function getValidite()
    {
        return $this->validite;
    }

    public function setReponse($newReponse)
    {
        $this->reponse = $newReponse;
    } 
    public function setValidite($newValidite)
    {
        $this->validite = $newValidite;
    } 

    public function setIdReponse($newIdReponse)
    {
        $this->validite = $newIdReponse;
    }
}