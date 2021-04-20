<?php
require_once "../modeles/modele.php";
require_once "../Modele/Modele.php";
require_once "../Modele/Categorie.php";

$categorie = new Categorie();

if (empty($_POST["illustration"]))
{
    $_POST["illustration"] = "../images/design/illustrationCategorieDefaut.png";
}

if (!empty($_POST)) 
{
    // Vérification que les données aient bien été entrées dans le formulaire
    if (!empty($_POST["nomCategorie"])) 
    {
        // Vérification que le mot de passe fait au moins 3 caractères
        if (strlen($_POST["nomCategorie"]) >= 3) 
        {
            // Verification que l'email est unique
            $nomCategorie = $categorie->recupererNomCategorie($_POST["nomCategorie"]);
            if($nomCategorie->rowCount() == 0)
            {
                if ($categorie->creerCategorie($_POST["nomCategorie"], $_POST["illustration"]) == true) 
                {
                    header("location:../admin/index.php?success=ajout");
                } else {
                    header("location:../admin/index.php?error=erreurajout");
                }
            } else {
                header("location:../admin/index.php?error=nomidentique");
            }
        } else {
            header("location:../admin/index.php?error=nomlength");
        }
    } else {
        header("location:../admin/index.php?error=missing");
    }
} else {
    header("location:/");
}
