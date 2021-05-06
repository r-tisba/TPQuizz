<?php
require_once "../admin/entete.php";
$utilisateur = new Utilisateur($_SESSION["pseudo"]);
$application = new Application();
$quiz = new Quiz();

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
                <ul class="list-group Lquiz">
                  <div class="row nouveauQuiz">
                      <?php
                      $nouveauQuizs = $quiz->dernierQuiz();
                      foreach($nouveauQuizs as $nouveauQuiz)
                      { 
                        $date = $nouveauQuiz["dateCreation"];
                        $auteur = $utilisateur->recupererPseudoViaId($nouveauQuiz["idUtilisateur"]);         
                          ?>
                                    
                          <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 mb-4  ">
                        <div class="card mx-0 Lquiz">
                        <div class="card-header p-1">
                            <h5 class="card-title d-flex justify-content-center pt-2"><?=$nouveauQuiz["nomQuiz"];?> </h5>
                        </div>
                        <div class="view overlay">
                            <a href="../Quiz/quiz.php?id=<?=$nouveauQuiz["idQuiz"];?>">
                                <img src="<?=$nouveauQuiz["illustration"];?>" class="imageQuiz" style="max-width: 100%;">
                            </a>
                        </div>
                        <div class="card-footer">
                            <div class="text-muted small">
                                Crée par <?=$auteur["pseudo"];?> le <?=$application->dateFr($date);?>
                            </div>
                            <div class="btn-group d-flex justify-content-center mt-3">
                                <!-- A FINIR -->
                                <a href="../traitements/supprimerQuiz.php?id=<?=$nouveauQuiz["idQuiz"];?>&idCat=<?=$nouveauQuiz["idCategorie"];?>" onclick="return confirm('Êtes vous certain de supprimer le quiz <?=$nouveauQuiz['nomQuiz'];?> ?');" class="btn btn-outline-danger" id="bouton">Supprimer</a>
                            </div>
                        </div>
                        </div>
                        </div>
                          <?php
                          
                          }
                      ?>  
                  </div>
                </ul>

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
                <ul class="list-group ">
                  <div class="row nouveauQuiz">
                      <?php
                      $quizPopulaires = $quiz->dernierQuiz();
                      foreach($quizPopulaires as $quizPopulaire)
                      { 
                        $date = $quizPopulaire["dateCreation"];
                        $auteur = $utilisateur->recupererPseudoViaId($quizPopulaire["idUtilisateur"]);         
                          ?>
                                    
                          <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 mb-4 nouveauQuiz">
                        <div class="card mx-0 Lquiz">
                        <div class="card-header p-1">
                            <h5 class="card-title d-flex justify-content-center pt-2"><?=$quizPopulaire["nomQuiz"];?> </h5>
                        </div>
                        <div class="view overlay">
                            <a href="../Quiz/quiz.php?id=<?=$quizPopulaire["idQuiz"];?>">
                                <img src="<?=$quizPopulaire["illustration"];?>" class="imageQuiz" style="max-width: 100%;">
                            </a>
                        </div>
                        <div class="card-footer">
                            <div class="text-muted small">
                                Crée par <?=$auteur["pseudo"];?> le <?=$application->dateFr($date);?>
                            </div>
                            <div class="btn-group d-flex justify-content-center mt-3">
                                <!-- A FINIR -->
                                <a href="../traitements/supprimerQuiz.php?id=<?=$quizPopulaire["idQuiz"];?>&idCat=<?=$quizPopulaire["idCategorie"];?>" onclick="return confirm('Êtes vous certain de supprimer le quiz <?=$quizPopulaire['nomQuiz'];?> ?');" class="btn btn-outline-danger" id="bouton">Supprimer</a>
                            </div>
                        </div>
                        </div>
                        </div>
                          <?php
                          
                          }
                      ?>  
                  </div>
                </ul>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- CARD 4 : MEILLEURS JOUEURS -->
        <div class="text-center col-sm-12 col-lg-6 col-md-6 mb-4 ">
            <div class="card" style="border: none;">
            <div class="card-body bg-warning" style="border-radius: 10px;">
              <h5 class="card-title">Les meilleurs joueurs</h5>
              <div class="d-flex justify-content-center">
                <div class="btn-group">
                <ul class="list-group ">
                  <div class="row meilleurJoueur">
                      <?php
                      $resultats = $utilisateur->classement();
                      foreach($resultats as $resultat)
                      {               
                          ?>
                                    
                          <div class="col-5 col-sm-5 col-md-7 col-lg-8 mb-2">
                              <li class="list-group-item">Pseudo : <?=$resultat["pseudo"]?></li>
                              <li class="list-group-item">Points : <?=$resultat["pointsUtilisateur"]?></li>
                              
                          </div>
                                

                          <?php
                          
                          }
                      ?>  
                  </div>
                </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--"col-12 col-sm-6 col-md-4 col-lg-3"
        12 colonnes sur petit écran, 6 colonnes pour demi-écran, etc... 
        -->
        

  </div>
  </div>
  </div>

</main>


<?php
require_once "pied.php";