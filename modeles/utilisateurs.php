<?php

function recupererUtilisateurs()
{
    $requete = getBDD()->prepare("SELECT * FROM utilisateurs");
    $requete->execute();
    return $requete->fetchAll(PDO::FETCH_ASSOC);
}

function recupererUtilisateurViaPseudo($pseudo)
{
    $requete = getBDD()->prepare("SELECT idUtilisateur FROM utilisateurs WHERE pseudo = ?");
    $requete->execute([$pseudo]);
    return $requete->fetch(PDO::FETCH_ASSOC);
}

function recupererUtilisateur($idUtilisateur)
{
    $requete = getBDD()->prepare("SELECT * FROM utilisateurs WHERE idUtilisateur = ?");
    $requete->execute([$idUtilisateur]);
    return $requete->fetch(PDO::FETCH_ASSOC);
}

function mailUnique($email)
{
    $requete = getBDD()->prepare("SELECT email FROM utilisateurs WHERE email = ?");
    $requete->execute([$email]);
    return $requete;
}

function recupererEmail($email)
{
    $requete = getBDD()->prepare("SELECT email FROM utilisateurs WHERE email = ?");
    $requete->execute([$email]);
    return $requete;
}

function creerUtilisateur($email, $pseudo, $mdp)
{
    $requete = getBDD()->prepare("INSERT INTO utilisateurs(email, pseudo, mdp)
    VALUES(?, ?, ?)");
    $requete->execute([$email, $pseudo, $mdp]);
    return true;
}

function modifierUtilisateur($idUtilisateur, $email, $pseudo, $idRole)
{
    $requete = getBDD()->prepare("UPDATE utilisateurs SET email = ?, pseudo = ?, idRole = ?  
    WHERE idUtilisateur = ?");
    $requete->execute([$email, $pseudo, $idRole, $idUtilisateur]);
    return true;
}

function supprimerUtilisateur($idUtilisateur)
{
    $requete = getBDD()->prepare("DELETE FROM utilisateurs 
    WHERE idUtilisateur = ?");
    $requete->execute([$idUtilisateur]);
    return true;
}
function recupererInfosConnexion($pseudo)
{
    $requete = getBDD()->prepare("SELECT idUtilisateur, pseudo, mdp, idRole FROM utilisateurs WHERE pseudo = ?");
    $requete->execute([$pseudo]);
    return $requete;
}