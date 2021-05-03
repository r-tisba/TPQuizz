<?php
require_once "entete.php";
$utilisateur= new Utilisateur($_SESSION["idUtilisateur"]);

?>
<div class="row">
<div class="col-md-12">
<div class="card card-white">
<div class="card-body">
<div class="container-fluid">

    <div class="show-image">
        <img src="<?=$utilisateur->getAvatar();?>" class="rounded-circle avatarProfil">
        <a href="../admin/modifPP.php">
            <input class="btn btn-outline-primary" type="button" value="Changer Photo">
        </a>
    </div>
    
    <div class="form-group" >
        <h3><b>Pseudo :</b> <?=$utilisateur->getPseudo();?></h3>
        <div class="float-right mt-1" >
        <a href="../admin/modifierPseudo.php" type="submit" class="btn btn-outline-primary" >Modifier Pseudo</a>
        </div>
    </div>
    
    <hr>
    <div class="form-group" >
        <h3><b>Email :</b> <?=$utilisateur->getEmail();?></h3>
        <div class="float-right mb-4">
        <a href="modifierEmail.php" type="submit" class="btn btn-outline-primary">Modifier email</a>
        </div>
    </div>
    <hr>
    <div class="form-group" >
        <h3><b>Mot De Passe :</b> </h3>
        <div class="float-right mb-4">
        <a href="modifierMdp.php" type="submit" class="btn btn-outline-primary">Modifier mot de passe</a>
        </div>
    </div>
    <hr>
    <div class="form-group">
        <h3><b>Rôle :</b> 
        <?php 
                if($utilisateur->getidRole()==1) { echo "Membre"; } else { echo "Administrateur"; }
                ?>
        </h3>
    </div>
    <hr>
    <div class="form-group">
        <h3><b>Point :</b> <?=$utilisateur->getPointsUtilisateur();?></h3>
    </div>
    </div>
    </div>
    </div>

</div>
</div>
<?php
require_once "pied.php";