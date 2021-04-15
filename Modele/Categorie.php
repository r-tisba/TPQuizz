<?php 

class Categorie extends Modele 
{
    private $idCategorie;
    private $nomCategorie;
    private $illustration;

    public function __construct($idCat = null)
    {
        if($idCat != null)
        {
            $requete = $this->getBdd()->prepare("SELECT * FROM categories WHERE idCategorie = ?");
            $requete->execute([$idCat]);
            $categorie=$requete->fetch(PDO::FETCH_ASSOC);
            $this->idCategorie = $idCat;
            $this->nomCategorie = $categorie["nomCategorie"];
            $this->illustration = $categorie["illustration"];
        }
    }

    public function getNomCat()
    {
        return $this->nomCategorie;
    }
    public function getIllustration()
    {
        return $this->illustration;
    }
    
    public function setNomCat($newCat)
    {
        $this->nomCategorie = $newCat;
    }
    public function setIllu($newIllu)
    {
        $this->illustration = $newIllu;
    }
}