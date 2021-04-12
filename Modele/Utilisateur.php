<?php
class Utilisateur
{
    public $idUtilisateur;
    private $pseudo;
    private $email;
    private $mdp;

    public function __construct($pseudo)
    {
        $this->pseudo=$pseudo;
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