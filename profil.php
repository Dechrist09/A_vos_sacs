<?php

require_once "./inc/functions.inc.php";

if (empty($_SESSION['user'])) {

    header("location:".RACINE_SITE."authentification.php");

} else if ( $_SESSION['user']['role'] == 'ROLE_ADMIN') {

    header("location:".RACINE_SITE."admin_php/dashboard.php?dashboard.php");


    } 

$metaDescription ="Bienvenue sur la page Profil";
$title = "Profil";
require_once "inc/header.inc.php";
?>

<main>
  <section class="top"> 
<div class="w-75 m-auto p-5" style="background: rosybrown;"> 
        <h1 class="text-center text-white p-3 mb-5"> Bienvenu sur notre page profil</h1>
      
            <div class="card   bA" style=" width: 20rem; ">
              <div class="card-body">
                

                   <div class="Profil ">
                    <img class="profil1" src="assets/img/img sophie.jpg" alt="" width="400px">
                      
                  <h2 class="text-center">Bonjour <?=$_SESSION['user']['prenom']?></h2>
                  <?php
        if (estAdmin()) {
                    echo "Bienvenue, administrateur";
                } else {
                    echo "Vous êtes bien connectés";
                }
                ?> 
                    </div>
              </div>
              <div class="text-center">
              </div> 
              </div>
              <p class="card-text text-white"> Si vous avez un compte veuillez vous connectez, au cas contraire  inscrivez- vous svp ! </p>
                     
              <a href="<?= RACINE_SITE ?>users.php" class="btn bg-dark text-center" width="70%">Inscription</a>
              <a href="<?= RACINE_SITE ?>authentification.php" class="btn bg-dark text-center" width="70%">Connexion</a>
                       
              </div>      
          </div>
    <h2 class="text-center">Bonjour <?=$_SESSION['user']['prenom']?></h2>
    </section>
</main>




<?php
require_once "inc/footer.inc.php";

?>