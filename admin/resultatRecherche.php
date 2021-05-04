<?php
require_once "../admin/entete.php";
$user = new Utilisateur($_SESSION["idUtilisateur"]);
$application = new Application();
$pseudo=$_POST["pseudo"];
echo $pseudo;
$resultats=$user->filtreUtilisateurs($pseudo);
print_r($resultats);
?>
<div class="mb-4">
    <a href="../admin/listeUtilisateurs.php" class="retour">
        <img src="../images/design/flecheRetour.png" class="fleche">Retour
    </a>
</div>
<main>

<ul class="list-group">
<div class="container-fluid content-row px-0">
    <div class="row">
        <?php
        $amis = $user->filtreAmis($_SESSION["idUtilisateur"]);
        $utilisateurs = $application->getUtilisateurs();
        foreach($resultats as $resultat)
        {
            if($resultat["idRole"] != 3 && $resultat["pseudo"] != $_SESSION["pseudo"])
            {
                
            ?>
            <div class="col-4 col-sm-4 col-md-3 col-lg-2 mb-4 mr-4">
                <li class="list-group-item py-0" style="border: none;">
                    <div class="show-image">
                        <img src="<?=$resultat["avatar"];?>" class="rounded-circle avatarProfil">
                        <?php

                        $nbAmis=0;

                        foreach($amis as $ami)
                        {
                            // echo "<pre>";
                            // print_r($ami);
                            // echo "</pre>";
                            // echo "<br/>";
                            // exit;
                            if($ami["idUtilisateur1"]== $resultat["idUtilisateur"] || $ami["idUtilisateur2"]== $resultat["idUtilisateur"])
                            {           
                                $nbAmis++;
                            
                            }
                        
                            }
                            if($nbAmis==0){
                                ?>
                                <a href="../traitements/ajoutAmi.php?id=<?=$resultat["idUtilisateur"];?>">
                                    <input class="btn btn-outline-success ajouterAmi" type="button" value="Ajouter ami">
                                    </a>
                                    <?php
                            }
                            ?>
                    </div>
                </li>
            </div>
            
            <div class="col-5 col-sm-5 col-md-7 col-lg-8 mb-4">
                <li class="list-group-item">Pseudo : <?=$resultat["pseudo"]?></li>
                <li class="list-group-item">Points : <?=$resultat["pointsUtilisateur"]?></li>
                <li class="list-group-item">Rôle : 
                <?php 
                if($resultat["idRole"]==1) { echo "Membre"; } else { echo "Administrateur"; }
                ?>
                </li>
            </div>
            
            <div class="float-right mb-4">
                <a href="modifierUtilisateur.php?id=<?=$resultat["idUtilisateur"];?>" class="btn btn-outline-primary w-100 py-4 h-50" id="bouton">Modifier</a>
                <br>
                <a href="../traitements/bannirUtilisateur.php?id=<?=$resultat["idUtilisateur"];?>&action=1" onclick="return confirm('Êtes vous certain de vouloir bannir <?=$resultat['pseudo'];?> ?');" 
                class="btn btn-outline-danger w-100 py-4 h-50" id="bouton">Bannir</a>
            </div>
            

            <?php
            }
            }
        ?>  
    </div>
</div>
</ul>
</main>

<?php
require_once "pied.php";