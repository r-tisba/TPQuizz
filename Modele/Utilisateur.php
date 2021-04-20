<?php
class Utilisateur extends Modele
{
    private $idUtilisateur;
    private $email;
    private $pseudo;
    private $mdp;
    private $idRole;
    private $pointsUtilisateur;
    private $avatar;
    private $idQuestion;
    private $libelle;   // libelle de la question secrète
    private $reponse;


    public function __construct($idU =null)
    {
        if($idU!=null){
            $requete = $this->getBdd()->prepare("SELECT * FROM utilisateurs LEFT JOIN reponses_questionssecretes USING(idUtilisateur) LEFT JOIN questionssecretes USING(idQuestion) WHERE idUtilisateur = ?");
            $requete->execute([$idU]);
            $utilisateur = $requete->fetch(PDO::FETCH_ASSOC);

            $this->idUtilisateur=$idU;
            $this->pseudo=$utilisateur["pseudo"];
            $this->email=$utilisateur["email"];
            $this->mdp=$utilisateur["mdp"];
            $this->idRole=$utilisateur["idRole"];
            $this->pointsUtilisateur=$utilisateur["pointsUtilisateur"];
            $this->avatar=$utilisateur["avatar"];
            $this->idQuestion=$utilisateur["idQuestion"];
            $this->libelle=$utilisateur["libelle"];
            $this->reponse=$utilisateur["reponse"];
        }
    }

    public function connexion($pseudo){
        $requete = $this->getBDD()->prepare("SELECT idUtilisateur, email, pseudo, mdp, idRole FROM utilisateurs WHERE pseudo = ?");
        $requete->execute([$pseudo]);
        $utilisateur=$requete->fetch(PDO::FETCH_ASSOC);

        $this->idUtilisateur=$utilisateur["idUtilisateur"];
        $this->pseudo=$utilisateur["pseudo"];
        $this->email=$utilisateur["email"];
        $this->mdp=$utilisateur["mdp"];
        $this->idRole=$utilisateur["idRole"];
    }

    function recupererInfosConnexion($pseudo)
    {
        $requete = $this->getBDD()->prepare("SELECT idUtilisateur, pseudo, mdp, idRole FROM utilisateurs WHERE pseudo = ?");
        $requete->execute([$pseudo]);
        return $requete;
    }

    public function inscription($email, $pseudo, $mdp)
    {
        $requete = $this->getBDD()->prepare("INSERT INTO utilisateurs(email, pseudo, mdp) VALUES(?, ?, ?)");
        $requete->execute([$email, $pseudo, $mdp]);
        return true;

        $this->email=$email;
        $this->pseudo=$pseudo;
        $this->mdp=$mdp;
    }

    public function ajouterReponseQuestionSecrete($idUtilisateur, $idQuestion, $reponse)
    {
        $requete = $this->getBDD()->prepare("INSERT INTO reponses_questionssecretes(idUtilisateur, idQuestion, reponse) VALUES(?, ?, ?)");
        $requete->execute([$idUtilisateur, $idQuestion, $reponse]);
        return true;
    
        $this->idUtilisateur=$idUtilisateur;
        $this->reponse=$reponse;
        $this->idQuestionSecrete=$idQuestion;
    }

    public function changerMdp($mdp, $idUtilisateur)
    {
        $requete = $this->getBDD()->prepare("UPDATE utilisateurs SET mdp = ? WHERE idUtilisateur = ?");
        $requete->execute([$mdp, $idUtilisateur]);
        return true;

        $this->idUtilisateur=$idUtilisateur;
        $this->mdp=$mdp;
    }

    public function recupererEmail($email)
    {
        $requete = $this->getBDD()->prepare("SELECT email FROM utilisateurs WHERE email = ?");
        $requete->execute([$email]);
        return $requete;
    }
    public function recupererUtilisateurViaPseudo($pseudo)
    {
        $requete = $this->getBDD()->prepare("SELECT idUtilisateur FROM utilisateurs WHERE pseudo = ?");
        $requete->execute([$pseudo]);
        return $requete->fetch(PDO::FETCH_ASSOC);
    }

    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }   
    public function getPseudo()
    {
        return $this->pseudo;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getMdp()
    {
        return $this->mdp;
    }
    public function getidRole()
    {
        return $this->idRole;
    }
    public function getPointsUtilisateur()
    {
        return $this->pointsUtilisateur;
    }
    public function getAvatar()
    {
        return $this->avatar;
    }
    public function getIdQuestion()
    {
        return $this->idQuestion;
    }
    public function getQuestionSecrete()
    {
        return $this->libelle;
    }
    public function getReponse()
    {
        return $this->reponse;
    }

    public function setPseudo($newPseudo)
    {
         $this->pseudo=$newPseudo;
    }
    public function setEmail($newEmail)
    {
         $this->email=$newEmail;
    }
    public function setMdp($newMdp)
    {
         $this->mdp=$newMdp;
    }
    public function setidRole($newIdRole)
    {
         $this->idRole=$newIdRole;
    }
    public function setPU($newPointsUtilisateur)
    {
         $this->pointsUtilisateur=$newPointsUtilisateur;
    }
    public function setAvatar($newAvatar)
    {
         $this->avatar=$newAvatar;
    }
}