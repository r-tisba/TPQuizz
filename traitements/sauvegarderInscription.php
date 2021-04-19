<?php
<<<<<<< HEAD
require_once "../Modele/Modele.php";
require_once "../Modele/Utilisateur.php";
$utilisateur = new Utilisateur();
=======
require_once "../Modele/Utilisateur.php";
require_once "../Modele/Modele.php";
>>>>>>> f7c050459624de4ad3cbe4ddc76eee1d82dfbb55

if (!empty($_POST)) 
{
    // Vérification que les données requises aient été entrées dans le formulaire
    if (!empty($_POST["pseudo"]) && !empty($_POST["email"]) 
    && !empty($_POST["mdp"]) && !empty($_POST["verifMdp"]) 
    && !empty($_POST["idQuestion"]) && !empty($_POST["reponseQuestionSecrete"])) 
    {
        // Verification de la validité de l'email
        if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) 
        {
            // Verification que l'email est unique
            $email = $utilisateur->recupererEmail($_POST["email"]);
            if($email->rowCount() == 0)
            {
               // Vérification que le mot de passe fait au moins 6 caractères
                if (strlen($_POST["mdp"]) >= 6) 
                {
                    // Vérification que les 2 mots de passe correspondent
                    if($_POST["mdp"] == $_POST["verifMdp"])
                    {
                        $mdp = password_hash($_POST["mdp"], PASSWORD_BCRYPT);
                        if ($utilisateur->inscription($_POST["email"], $_POST["pseudo"], $mdp) == true) 
                        {
                            $idUtilisateur = $utilisateur->recupererUtilisateurViaPseudo($_POST["pseudo"]);
                            if($utilisateur->ajouterReponseQuestionSecrete($idUtilisateur["idUtilisateur"], $_POST["idQuestion"], $_POST["reponseQuestionSecrete"]) == true)
                            {
                                header("location:../visiteur/inscription.php?success=inscription");
                            } else {
                                header("location:../visiteur/inscription.php?error=qssave");
                            }
                        } else {
                            header("location:../visiteur/inscription.php?error=inscriptionsave");
                        }
                    } else {
                        header("location:../visiteur/inscription.php?error=mdpnotsame");
                    }
                } else {
                    header("location:../visiteur/inscription.php?error=mdplength");
                }
            } else {
                header("location:../visiteur/inscription.php?error=emailnotunique");
            }
        } else {
            header("location:../visiteur/inscription.php?error=emailnotvalid");
        }
    } else {
        header("location:../visiteur/inscription.php?error=missing");
    }
} else {
    header("location:../");
}
