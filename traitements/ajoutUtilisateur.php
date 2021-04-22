<?php
require_once "../Modele/Modele.php";
require_once "../Modele/Utilisateur.php";
$utilisateur = new Utilisateur();

// Vérification que les données aient bien été entrées dans le formulaire
if (!empty($_POST["email"]) && !empty($_POST["pseudo"]) && !empty($_POST["idRole"])
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
                    if ($utilisateur->creerUtilisateur($_POST["email"], $_POST["pseudo"], $mdp, $_POST["idRole"]) == true) 
                    {
                        $idUtilisateur = $utilisateur->recupererUtilisateurViaPseudo($_POST["pseudo"]);
                            
                        if($utilisateur->ajouterReponseQuestionSecrete($idUtilisateur["idUtilisateur"], $_POST["idQuestion"], $_POST["reponseQuestionSecrete"]) == true)
                        {
                            header("location:/admin/listeUtilisateurs.php?success=ajout");
                        } else {
                            header("location:../admin/listeUtilisateurs.php?error=qssave");
                        }
                    } else {
                    header("location:/admin/listeUtilisateurs.php?error=erreurajout");
                    }
                } else {
                    header("location:/admin/listeUtilisateurs.php?error=mdpnotsame");
                }
            } else {
                header("location:/admin/listeUtilisateurs.php?error=mdplength");
            }
        } else {
            header("location:/admin/listeUtilisateurs.php?error=emailnotunique");
        }
    } else {
        header("location:/admin/listeUtilisateurs.php?error=emailnotvalid");
    }
} else {
    header("location:/admin/listeUtilisateurs.php?error=missing");
}
