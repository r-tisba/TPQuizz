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
            $categorie = $requete->fetch(PDO::FETCH_ASSOC);
            $this->idCategorie = $idCat;
            $this->nomCategorie = $categorie["nomCategorie"];
            $this->illustration = $categorie["illustration"];
        }
    }

    public function creerCategorie($nomCategorie, $illustration)
    {
        $requete = $this->getBDD()->prepare("INSERT INTO categories(nomCategorie, illustration) VALUES (?, ?)");
        $requete->execute([$nomCategorie, $illustration]);
        return true;
    
        $this->nomCategorie=$nomCategorie;
        $this->illustration=$illustration;
    }

    public function supprimerCategorie($idCategorie)
    {
        $requete = $this->getBDD()->prepare("DELETE FROM categories WHERE idCategorie = ?");
        $requete->execute([$idCategorie]);
        return true;
    
        $this->idCategorie=$idCategorie;
    }

    public function modifierCategorie($idCategorie, $nomCategorie, $illustration)
    {
        $requete = $this->getBDD()->prepare("UPDATE categories SET nomCategorie = ?, illustration = ? WHERE idCategorie = ?");
        $requete->execute([$nomCategorie, $illustration, $idCategorie]);
        return true;
    }

    public function recupererNomCategorie($nomCategorie)
    {
        $requete = $this->getBDD()->prepare("SELECT nomCategorie FROM categories WHERE nomCategorie = ?");
        $requete->execute([$nomCategorie]);
        return $requete;
    }
    
    public function getIdCat()
    {
        return $this->idCategorie;
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