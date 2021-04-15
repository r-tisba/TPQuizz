<?php

// class Utilisateur{
//     public $email;
//     public $pseudo;
//     public $mdp;
//     public $idRole;
//     public $pointsUtilisateur ;
//     public $avatar ;
    
//     public function __construct($email, $pseudo, $mdp)
//     {
//         $this->email=$email;
//         $this->pseudo=$pseudo;
//         $this->mdp=$mdp;
//     }
    

//     public function creerUtilisateur($email, $pseudo, $mdp)
// {
    
//     $requete = getBDD()->prepare("INSERT INTO utilisateurs(email, pseudo, mdp)
//     VALUES(?, ?, ?)");
//     $requete->execute([$email, $pseudo, $mdp]);
//     return true;
// }

// }

// function recupererInfosConnexion($pseudo)
// {
//     $requete = getBDD()->prepare("SELECT idUtilisateur, pseudo, mdp, idRole FROM utilisateurs WHERE pseudo = ?");
//     $requete->execute([$pseudo]);
//     return $requete;
// }
// function recupererUtilisateurs()
// {
//     $requete = getBDD()->prepare("SELECT * FROM utilisateurs");
//     $requete->execute();
//     return $requete->fetchAll(PDO::FETCH_ASSOC);
// }

// function recupererUtilisateurViaPseudo($pseudo)
// {
//     $requete = getBDD()->prepare("SELECT idUtilisateur FROM utilisateurs WHERE pseudo = ?");
//     $requete->execute([$pseudo]);
//     return $requete->fetch(PDO::FETCH_ASSOC);
// }

// function recupererUtilisateur($idUtilisateur)
// {
//     $requete = getBDD()->prepare("SELECT * FROM utilisateurs WHERE idUtilisateur = ?");
//     $requete->execute([$idUtilisateur]);
//     return $requete->fetch(PDO::FETCH_ASSOC);
// }



// function recupererEmail($email)
// {
//     $requete = getBDD()->prepare("SELECT email FROM utilisateurs WHERE email = ?");
//     $requete->execute([$email]);
//     return $requete;
// }