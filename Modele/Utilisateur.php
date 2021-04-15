<?php
class Utilisateur extends Modele
{
    public $idUtilisateur;
    public $email;
    public $pseudo;
    public $mdp;
    public $idRole;
    public $pointsUtilisateur ;
    public $avatar;

    public function __construct($idU)
    {
        $requete = getBdd()->prepare("SELECT * FROM utilisateurs");
        $requete->execute();
        $utilisateur= $requete->fetch(PDO::FETCH_ASSOC);
        $this->idUtilisateur=$idU;
        $this->pseudo=$utilisateur["pseudo"];
        $this->email=$utilisateur["email"];
        $this->mdp=$utilisateur["mdp"];
        $this->idRole=$utilisateur["idRole"];
        $this->pointsUtilisateur=$utilisateur["pointsUtilisateur"];
        $this->avatar=$utilisateur["avatar"];
    }

    public function getPseudo()
    {
        // $this permet de faire réference à l'objet
        return $this->pseudo;
    }

    public function setPseudo($newpseudo)
    {
        $this->pseudo = $newpseudo;
    }

    public function setPassword($newmdp)
    {
        $this->mdp = $newmdp;
    }

    public function creerUtilisateur($email, $pseudo, $mdp)
    {
    $requete = getBDD()->prepare("INSERT INTO utilisateurs(email, pseudo, mdp)
    VALUES(?, ?, ?)");
    $requete->execute([$email, $pseudo, $mdp]);
    return true;
    }
}