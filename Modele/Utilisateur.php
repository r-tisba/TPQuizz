<?php
class Utilisateur extends Modele
{
    private $idUtilisateur;
    private $email;
    private $pseudo;
    private $mdp;
    private $idRole;
    private $pointsUtilisateur ;
    private $avatar;

    public function __construct($idU =null)
    {
        if($idU!=null){
            $requete = getBdd()->prepare("SELECT * FROM utilisateurs WHERE idUtilisateur=?");
            $requete->execute([$idU]);
            $utilisateur= $requete->fetch(PDO::FETCH_ASSOC);

            $this->idUtilisateur=$idU;
            $this->pseudo=$utilisateur["pseudo"];
            $this->email=$utilisateur["email"];
            $this->mdp=$utilisateur["mdp"];
            $this->idRole=$utilisateur["idRole"];
            $this->pointsUtilisateur=$utilisateur["pointsUtilisateur"];
            $this->avatar=$utilisateur["avatar"];
        }
    }

    public function getPseudo()
    {
        // $this permet de faire réference à l'objet
        return $this->pseudo;
    }
    public function getEmail()
    {
        // $this permet de faire réference à l'objet
        return $this->email;
    }
    public function getMdp()
    {
        // $this permet de faire réference à l'objet
        return $this->mdp;
    }
    public function getidRole()
    {
        // $this permet de faire réference à l'objet
        return $this->idRole;
    }
    public function getPU()
    {
        // $this permet de faire réference à l'objet
        return $this->pointsUtilisateur;
    }
    public function getAvatar()
    {
        // $this permet de faire réference à l'objet
        return $this->avatar;
    }

    
}