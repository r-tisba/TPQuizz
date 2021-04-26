<?php
require_once "../admin/entete.php";
$utilisateur = new Utilisateur($_SESSION["pseudo"]);
$application = new Application();

if(!isset($_SESSION["pseudo"]))
{
  header("location:../visiteur/index.php");
}
if($_SESSION["idRole"] == 1)
{
  header("location:../membre/index.php");
}
?>

<!-- MESSAGE D'ACCUEIL -->
<section class="py-3 text-center container">
    <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
            <h1 class="fw-dark">Quiz'Up<h1>
            <p class="lead text-muted">Bienvenue sur la réference du quiz en ligne</p>
        </div>
    </div>
</section>

<main>

<div class="album py-3">
    <div class="container">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">


    <!-- CARD 1 : ACCEDER CATEGORIES -->
    <div class="text-center col-12 col-lg-6 col-md-6 mb-4">
          <div class="card" style="border: none;">
            <div class="card-body">
              <h5 class="card-title">Explorer par catégories !</h5>
              <div class="d-flex justify-content-center">
                <a href="listeCategories.php">
                    <img src="../images/design/pi.png" class="imageCategorie"/>
                </a>
              </div>
            </div>
          </div>
        </div>

      <!-- CARD 2 : NOUVEAUX QUIZ -->
     
        <div class="text-center col-12 col-lg-6 col-md-6 mb-4">
          <div class="card" style="border: none;">
            <div class="card-body">
            <h5 class="card-title">Nouveaux quiz</h5>
              <div class="d-flex justify-content-center">
                <div class="btn-group">

                </div>
              </div>
            </div>
          </div>
        </div>
        
        <!-- CARD 3 : QUIZ POPULAIRES -->
        <div class="text-center col-12 col-lg-6 col-md-6 mb-4">
          <div class="card" style="border: none;">
          <div class="card-body">
          <h5 class="card-title">Quiz populaires</h5>
              <div class="d-flex justify-content-center">
                <div class="btn-group">

                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- CARD 4 : MEILLEURS JOUEURS -->
        <div class="text-center col-sm-12 col-lg-6 col-md-6 mb-4">
            <div class="card" style="border: none;">
            <div class="card-body">
              <h5 class="card-title">Les meilleurs joueurs</h5>
              <div class="d-flex justify-content-center">
                <div class="btn-group">
                  
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--"col-12 col-sm-6 col-md-4 col-lg-3"
        12 colonnes sur petit écran, 6 colonnes pour demi-écran, etc... 
        -->
        

  </div>

</main>


<?php
require_once "pied.php";