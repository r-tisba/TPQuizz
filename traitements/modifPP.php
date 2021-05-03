<?php
require_once "../Modele/Modele.php";
require_once "../Modele/Application.php";
require_once "../Modele/Quiz.php";
require_once "../Modele/Utilisateur.php";
require_once "../Modele/Categorie.php";
require_once "../Modele/Question.php";
require_once "../Modele/Reponse.php";
$dossier = "../images/avatar/";
session_start();
$utilisateur= new Utilisateur($_SESSION["idUtilisateur"]);

$extension = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));

$avatar=$dossier . "avatar" . $_SESSION["pseudo"] . "." . $extension;

//Vérifier si on peut récupérer les dimensions de l'image
if(getimagesize($_FILES["image"]["tmp_name"])){
    //Vérifier si le poids en octet de l'image ne dépasse pas 3M
    if($_FILES["image"]["size"]<=3000000){
        //Vérifier le vrai type du fichier
        if($_FILES["image"]["type"]=="image/png"|| $_FILES["image"]["type"]=="image/jpeg"){
            if(move_uploaded_file($_FILES["image"]["tmp_name"], $avatar)){
                $PP=$utilisateur->modifierAvatar($avatar, $_SESSION["idUtilisateur"]);
                if($PP==true){
                    header("location:../admin/modifPP.php?success=modification");
                }else{
                    header("location:../admin/modifPP.php?error=ajout");
                }
            }else{
                header("location:../admin/modifPP.php?error=fichier");
            }
        }else{
            header("location:../admin/modifPP.php?error=type");
        }
    }else{
            header("location:../admin/modifPP.php?error=taille");
    }
}else{
    header("location:../admin/modifPP.php?error=image");
}

?>
