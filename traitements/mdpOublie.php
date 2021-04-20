<?php
require_once "../Modele/Modele.php";
require_once "../Modele/Utilisateur.php";
$utilisateur = new Utilisateur();

if (!empty($_GET["id"])) 
{
    $idUtilisateur = $_GET["id"];
}

if(isset($_POST["envoi"]) && !empty($_POST["envoi"]) && $_POST["envoi"] == 1)
{
    extract($_POST);

    // Vérification que les inputs aient été remplit
    if (!empty($pseudo))
    {
        $requete = $utilisateur->recupererInfosConnexion($pseudo);

        // Vérification si le pseudo existe
        if($requete->rowCount() != 0)
        {
            // Le pseudo existe
            $utilisateur = $requete->fetch(PDO::FETCH_ASSOC);
            $idUtilisateur = $utilisateur["idUtilisateur"];

            header("location:../visiteur/mdpOublie.php?success=pseudo&id=$idUtilisateur");
                
        } else {
                header("location:../visiteur/mdpOublie.php?error=falsepseudo");
        }
    } else {
        header("location:../visiteur/mdpOublie.php?error=pseudomissing");
    } 

} else if(isset($_POST["envoi"]) && !empty($_POST["envoi"]) && $_POST["envoi"] == 2)
{
    $utilisateur = new Utilisateur($idUtilisateur);
    extract($_POST);

    // Vérification que les inputs aient été remplit
    if (!empty($reponse))
    {
        $requete = $utilisateur->recupererInfosConnexion($pseudo);

        // Vérification si la réponse est correcte
        if($_POST["reponse"] == $utilisateur->getReponse())
        {
            header("location:../visiteur/mdpOublie.php?success=reponse&id=$idUtilisateur");
                    
        } else {
            header("location:../visiteur/mdpOublie.php?success=pseudo&error=falsereponse&id=$idUtilisateur");
        }
    } else {
        header("location:../visiteur/mdpOublie.php?error=reponsemissing");
    } 


} else if(isset($_POST["envoi"]) && !empty($_POST["envoi"]) && $_POST["envoi"] == 3) 
{
    // Vérification que les données requises aient été entrées dans le formulaire
    if (!empty($_POST["mdp"]) && !empty($_POST["verifMdp"])) 
    {
        // Vérification que le mot de passe fait au moins 6 caractères
        if (strlen($_POST["mdp"]) >= 6) 
        {
            // Vérification que les 2 mots de passe correspondent
            if($_POST["mdp"] == $_POST["verifMdp"])
            {
                $mdp = password_hash($_POST["mdp"], PASSWORD_BCRYPT);
                if ($utilisateur->changerMdp($mdp, $idUtilisateur) == true) 
                {
                    header("location:../visiteur/mdpOublie.php?success=mdp");
                } else {
                    header("location:../visiteur/mdpOublie.php?error=updatesave");
                }
            } else {
                header("location:../visiteur/mdpOublie.php?error=mdpnotsame&success=reponse&id=$idUtilisateur");
            }
        } else {
            header("location:../visiteur/mdpOublie.php?error=mdplength&success=reponse&id=$idUtilisateur");
        }
    } else {
        header("location:../visiteur/mdpOublie.php?error=mdpmissing");
    }
} else {
    header("location:../");
}