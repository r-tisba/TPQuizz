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


    public function __construct($idU = null)
    {
        if($idU!=null)
        {
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

    public function creerUtilisateur($email, $pseudo, $mdp, $idRole)
    {
        $requete = $this->getBDD()->prepare("INSERT INTO utilisateurs(email, pseudo, mdp, idRole) VALUES(?, ?, ?, ?)");
        $requete->execute([$email, $pseudo, $mdp, $idRole]);
        return true;

        $this->email=$email;
        $this->pseudo=$pseudo;
        $this->idRole=$idRole;
        $this->mdp=$mdp;
    }

    public function modifierUtilisateur($email, $pseudo, $idRole, $idUtilisateur)
    {
        $requete = $this->getBDD()->prepare("UPDATE utilisateurs SET email = ?, pseudo = ?, idRole = ?WHERE idUtilisateur = ?");
        $requete->execute([$email, $pseudo, $idRole, $idUtilisateur]);
        return true;

        $this->email=$email;
        $this->pseudo=$pseudo;
        $this->idRole=$idRole;
        $this->idUtilisateur=$idUtilisateur;
    }
    public function modifierAvatar($avatar, $idUtilisateur)
    {
        $requete = $this->getBDD()->prepare("UPDATE utilisateurs SET avatar = ? WHERE idUtilisateur = ?");
        $requete->execute([$avatar, $idUtilisateur]);
        return true;

        $this->avatar=$avatar;
        $this->idUtilisateur=$idUtilisateur;
    }
    public function modifierPseudo($pseudo, $idUtilisateur)
    {
        $requete = $this->getBDD()->prepare("UPDATE utilisateurs SET pseudo = ? WHERE idUtilisateur = ?");
        $requete->execute([$pseudo, $idUtilisateur]);
        return true;

        $this->pseudo=$pseudo;
        $this->idUtilisateur=$idUtilisateur;
    }
    public function modifierEmail($email, $idUtilisateur)
    {
        $requete = $this->getBDD()->prepare("UPDATE utilisateurs SET email = ? WHERE idUtilisateur = ?");
        $requete->execute([$email, $idUtilisateur]);
        return true;

        $this->email=$email;
        $this->idUtilisateur=$idUtilisateur;
    }
    public function modifierMdp($mdp, $idUtilisateur)
    {
        $requete = $this->getBDD()->prepare("UPDATE utilisateurs SET mdp = ? WHERE idUtilisateur = ?");
        $requete->execute([$mdp, $idUtilisateur]);
        return true;

        $this->email=$mdp;
        $this->idUtilisateur=$idUtilisateur;
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

    public function recupererPseudoViaId($idUtilisateur)
    {
        $requete = $this->getBDD()->prepare("SELECT pseudo FROM utilisateurs WHERE idUtilisateur = ?");
        $requete->execute([$idUtilisateur]);
        return $requete->fetch(PDO::FETCH_ASSOC);
    }

    public function recupererNomRoleViaIdRole($idRole)
    {
        $requete = $this->getBDD()->prepare("SELECT nomRole FROM utilisateurs LEFT JOIN roles USING(idRole) WHERE idRole = ?");
        $requete->execute([$idRole]);
        return $requete->fetch(PDO::FETCH_ASSOC);
    }

    public function bannirUtilisateur($idUtilisateur)
    {
        $requete = $this->getBDD()->prepare("UPDATE utilisateurs SET idRole = 3 WHERE idUtilisateur = ?");
        $requete->execute([$idUtilisateur]);
        return true;
    }

    public function debannirUtilisateur($idUtilisateur)
    {
        $requete = $this->getBDD()->prepare("UPDATE utilisateurs SET idRole = 1 WHERE idUtilisateur = ?");
        $requete->execute([$idUtilisateur]);
        return true;
    }

    /*
    // Verifie si une amitié entre 2 utilisateurs existe
    // A OPTIMISER
    public function verifAmitie($idUtilisateur1, $idUtilisateur2)
    {
        $verif = 0;
        $associations = $this->getBDD()->prepare("SELECT idUtilisateur2 FROM amis WHERE idUtilisateur1 = ?");
        $associations->execute([$idUtilisateur1]);
        $associations->fetch(PDO::FETCH_ASSOC);
        foreach($associations as $association)
        {
            if($association["idUtilisateur2"] == $idUtilisateur2)
            { $verif++; } 
        }

        $associations = $this->getBDD()->prepare("SELECT idUtilisateur1 FROM amis WHERE idUtilisateur2 = ?");
        $associations->execute([$idUtilisateur1]);
        $associations->fetch(PDO::FETCH_ASSOC);
        foreach($associations as $association)
        {
            if($association["idUtilisateur1"] == $idUtilisateur2)
            { $verif++; }
        }
        if($verif == 0)
        { return true; } else { return false; }
    }
    */

    public function ajoutAmi($idUtilisateur1, $idUtilisateur2)
    {
        $requete = $this->getBDD()->prepare("INSERT INTO amis(idUtilisateur1, idUtilisateur2) VALUES(?, ?)");
        $requete->execute([$idUtilisateur1, $idUtilisateur2]);

        $this->idUtilisateur1 = $idUtilisateur1;
        $this->idUtilisateur2 = $idUtilisateur2;
        return true;
    }
    public function questionSecrete($idUtilisateur)
    {
        $requete = $this->getBDD()->prepare("SELECT * FROM reponses_questionssecretes LEFT JOIN questionssecretes USING (idQuestion) WHERE idUtilisateur=?");
        $requete->execute([$idUtilisateur]);
        $this->idUtilisateur = $idUtilisateur;
        $question=$requete->fetch(PDO::FETCH_ASSOC);
        return $question;

        
    }
    // public function reponseSecrete($idUtilisateur, $reponse)
    // {
    //     $requete = $this->getBDD()->prepare("SELECT * FROM reponses_questionssecretes  WHERE idUtilisateur=?");
    //     $requete->execute([$idUtilisateur]);
    //     $this->idUtilisateur = $idUtilisateur;
    //     $question=$requete->fetch(PDO::FETCH_ASSOC);
    //     return $question;

        
    // }
   
    public function filtreAmis($idUtilisateur)
    {
        $requete = $this->getBDD()->prepare("SELECT * FROM amis LEFT JOIN utilisateurs ON utilisateurs.idUtilisateur=idUtilisateur1 OR 
        utilisateurs.idUtilisateur=idUtilisateur2 WHERE utilisateurs.idUtilisateur=?");
        $requete->execute([$idUtilisateur]);
        $amis = $requete->fetchAll(PDO::FETCH_ASSOC);
        $this->idUtilisateur = $idUtilisateur;
        return $amis;
    }
    public function filtreUtilisateurs($pseudo)
    {
        $requete = $this->getBDD()->prepare("SELECT * FROM utilisateurs WHERE pseudo LIKE'%$pseudo%'");
        $requete->execute([$pseudo]);
        $this->pseudo = $pseudo;
        $resultats = $requete->fetchAll(PDO::FETCH_ASSOC);
        
        return $resultats;
        

    }
    public function classement()
    {
        $requete = $this->getBDD()->prepare("SELECT * FROM utilisateurs ORDER BY pointsUtilisateur DESC LIMIT 5");
        $requete->execute();
        $resultats = $requete->fetchAll(PDO::FETCH_ASSOC);
        
        return $resultats;
        

    }
    public function supprimerAmi($idUtilisateur1, $idUtilisateur2)
    {
        $requete = $this->getBDD()->prepare("DELETE FROM amis WHERE idUtilisateur1 = ? AND idUtilisateur2 = ?");
        $requete->execute([$idUtilisateur1, $idUtilisateur2]);

        $this->idUtilisateur1 = $idUtilisateur1;
        $this->idUtilisateur2 = $idUtilisateur2;
        return true;
    }

    /*
    public function barreDeRecherche($pseudo)
    {
        $requete = $this->getBDD()->prepare("SELECT * FROM utilisateurs ORDER BY idUtilisateur DESC");
        if(!empty($_GET['q'])) 
        {
            $q = htmlspecialchars($_GET['q']);
            $requete = $this->getBDD()->prepare("SELECT * FROM utilisateurs WHERE pseudo LIKE "%'.$q.'%" ORDER BY idUtilisateur DESC");
            if($requete->rowCount() == 0) 
            {
                $requete = $this->getBDD()->prepare('SELECT * FROM utilisateurs WHERE CONCAT(pseudo) LIKE "%'.$q.'%" ORDER BY idUtilisateur DESC');
            }
        }
    }
    */

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