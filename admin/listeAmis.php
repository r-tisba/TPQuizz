<?php
require_once "entete.php";
$user = new Utilisateur($_SESSION["idUtilisateur"]);
$application = new Application();
$idUtilisateur = $_SESSION["idUtilisateur"];

print_r($idUtilisateur);


// exit;
?>
<ul class="list-group">
<div class="container-fluid content-row px-0">
    <div class="row">
        <?php

        $utilisateurs = $application->getUtilisateurs();

        foreach($utilisateurs as $utilisateur)
        {
            $amis = $user->Amis();
            foreach($amis as $cleAmis=>$ami){
              if($_SESSION["idUtilisateur"]==$amis[$cleAmis]["idUtilisateur1"] && $utilisateur["idUtilisateur"]==$amis[$cleAmis]["idUtilisateur2"]){
                ?>
                   

            
            <div class="col-4 col-sm-4 col-md-3 col-lg-2 mb-4 mr-4">
                <li class="list-group-item py-0" style="border: none;">
                    <div class="show-image">
                        <img src="<?=$utilisateur["avatar"];?>" class="rounded-circle avatarProfil">
                        <a href="../traitements/supprimerAmi.php?id=<?=$utilisateur["idUtilisateur"];?>&action=1" onclick="return confirm('Êtes vous certain de vouloir suprimer <?=$utilisateur['pseudo'];?> de vos amis?');">
                        <input class="btn btn-outline-danger ajouterAmi" type="button" value="Supprimer ami">
                        </a>
                    </div>
                </li>
            </div>
            
            <div class="col-5 col-sm-5 col-md-7 col-lg-8 mb-4">
                <li class="list-group-item">Pseudo : <?=$utilisateur["pseudo"]?></li>
                <li class="list-group-item">Points : <?=$utilisateur["pointsUtilisateur"]?></li>
                <li class="list-group-item">Rôle : 
                <?php 
                if($utilisateur["idRole"]==1) { echo "Membre"; } else { echo "Administrateur"; }
                ?>
                </li>
            </div>
            
            <!-- <div class="float-right mb-4">
                <a href="../traitements/supprimerAmi.php?id=<?=$utilisateur["idUtilisateur"];?>&action=1" onclick="return confirm('Êtes vous certain de vouloir suprimer <?=$utilisateur['pseudo'];?> de vos amis?');" 
                class="btn btn-outline-danger w-100 py-4 h-50" id="bouton">Supprimer</a>
            </div> -->

            <?php
            
        }
        if($_SESSION["idUtilisateur"]==$amis[$cleAmis]["idUtilisateur2"] && $utilisateur["idUtilisateur"]==$amis[$cleAmis]["idUtilisateur1"]){
            ?>
            <div class="col-4 col-sm-4 col-md-3 col-lg-2 mb-4 mr-4">
                    <li class="list-group-item py-0" style="border: none;">
                        <div class="show-image">
                            <img src="<?=$utilisateur["avatar"];?>" class="rounded-circle avatarProfil">
                        </div>
                    </li>
            </div>
            
            <div class="col-5 col-sm-5 col-md-7 col-lg-8 mb-4">
                <li class="list-group-item">Pseudo : <?=$utilisateur["pseudo"]?></li>
                <li class="list-group-item">Points : <?=$utilisateur["pointsUtilisateur"]?></li>
                <li class="list-group-item">Rôle : 
                <?php 
                if($utilisateur["idRole"]==1) { echo "Membre"; } else { echo "Administrateur"; }
                ?>
                </li>
            </div>
            
            <div class="float-right mb-4">
                <a href="../traitements/supprimerAmi.php?id=<?=$utilisateur["idUtilisateur"];?>&action=1" onclick="return confirm('Êtes vous certain de vouloir suprimer <?=$utilisateur['pseudo'];?> de vos amis?');" 
                class="btn btn-outline-danger w-100 py-4 h-50" id="bouton">Supprimer</a>
            </div>

            <?php
        }
    }
}
        ?>  
    </div>
</div>
</ul>

<?php
require_once "pied.php";