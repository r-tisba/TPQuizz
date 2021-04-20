<?php 

class Reponse extends Modele
{
    private $idReponse;
    private $reponse;
    private $validite;

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

    public function setIdReponse($newIdReponse){

    }
    
}