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
            $requete = $requete->fetch(PDO::FETCH_ASSOC);

            $this->idReponse = $idReponse;
            $this->reponse = $requete["reponse"];
            $this->validite = $requete["validite"];
            $this->idQuestion = $requete["idQuestion"];
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

    public function enregistrerReponse($idUtilisateur, $idQuestion, $idReponse)
    {
        $requete=$this->getBDD()->prepare("INSERT INTO reponses_utilisateurs(idUtilisateur, idQuestion, idReponse) VALUES(?, ?, ?)");
        $requete->execute([$idUtilisateur, $idQuestion, $idReponse]);

        $this->idUtilisateur=$idUtilisateur;
        $this->idQuestion=$idQuestion;
        $this->idReponse=$idReponse;
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
    public function getIdQuestion()
    {
        return $this->idQuestion;
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