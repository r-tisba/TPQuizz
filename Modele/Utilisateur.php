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
    private $reponseSecrete;
    private $idQuestionSecrete;

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
            $this->reponseSecrete=$utilisateur["reponseSecrete"];
            $this->idQuestionSecrete=$utilisateur["idQuestionSecrete"];
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
    public function setPseudo($newPseudo)
    {
        // $this permet de faire réference à l'objet
         $this->pseudo=$newPseudo;
    }
    public function setEmail($newEmail)
    {
        // $this permet de faire réference à l'objet
         $this->email=$newEmail;
    }
    public function setMdp($newMdp)
    {
        // $this permet de faire réference à l'objet
         $this->mdp=$newMdp;
    }
    public function setidRole($newIdRole)
    {
        // $this permet de faire réference à l'objet
         $this->idRole=$newIdRole;
    }
    public function setPU($newPU)
    {
        // $this permet de faire réference à l'objet
         $this->pointsUtilisateur=$newPU;
    }
    public function setAvatar($newAvatar)
    {
        // $this permet de faire réference à l'objet
         $this->avatar=$newAvatar;
    }

    public function connexion($pseudo){
        $requete = getBDD()->prepare("SELECT idUtilisateur, email, pseudo, mdp, idRole FROM utilisateurs WHERE pseudo = ?");
        $requete->execute([$pseudo]);
        $utilisateur=$requete->fetch(PDO::FETCH_ASSOC);

        $this->idUtilisateur=$utilisateur["idUtilisateur"];
        $this->pseudo=$utilisateur["pseudo"];
        $this->email=$utilisateur["email"];
        $this->mdp=$utilisateur["mdp"];
        $this->idRole=$utilisateur["idRole"];


    }
    public function inscription($idUtilisateur, $pseudo, $email, $mdp, $avatar, $idQuestionSecrete, $reponseSecrete){
        $requete = getBDD()->prepare("INSERT INTO utilisateurs(email, pseudo, mdp, avatar, reponseSecrete, idQuestionSecrete)
     VALUES(?, ?, ?, ?, ?, ?)");
     $requete->execute([$email, $pseudo, $mdp, $avatar]);
      $requete = getBDD()->prepare("INSERT INTO reponses_questionssecretes(idUtilisateur, idQuestion, reponse) VALUES(?,?,?)");
      $requete->execute([$idUtilisateur, $reponseSecrete, $idQuestionSecrete]);
        $this->idUtilisateur=$idUtilisateur;
        $this->pseudo=$pseudo;
        $this->email=$email;
        $this->mdp=$mdp;
        $this->avatar=$avatar;
        $this->reponseSecrete=$reponseSecrete;
        $this->idQuestionSecrete=$idQuestionSecrete;
    }

    
}