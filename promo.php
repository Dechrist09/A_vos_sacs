<?php

require_once "inc/functions.inc.php";

$metaDescription =" Grande Promotion Éclair ! Bénéficiez de 50% de réduction sur une sélection exclusive de sacs.";
$title = "Promo";
require_once "inc/header.inc.php";



$produits = recupererPromo();
?>
<main class="greyi">

     <section class="titre">
          <h1 class="marquee" style="color: red;">Découvrez Nos Offres Exclusives !</h1>
          <div class=" text-center p-5 titre">
          <h1 class="A2" style="color: white;">PROMOTION !!!</h1>

                <p style="color: white;" >Grande Promotion Éclair ! 🌟 Bénéficiez de 50% de réduction sur une sélection exclusive de sacs pour une durée limitée. Découvrez des modèles qui allient élégance et tendance pour compléter votre garde-robe. Attention, l’offre est soumise à la disponibilité des stocks. Profitez-en rapidement et ajoutez votre sac préféré à votre panier à un prix exceptionnel. C’est le moment idéal pour s’offrir le sac de luxe dont vous avez toujours rêvé !<br></p>
            
          </div>
     </section>
     <section class="index-img container m-5 text-center">
          <div class="container"> 
          <div class="row">
               <?php
               foreach ($produits as $produit) {
               ?>
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4 ">

                    <figure class=" btn-text-align-items-center bg-light pos">
                         <!-- <div class="card"> -->
                              <div data-aos="flip-left"> 
                              <img src="<?= RACINE_SITE . "assets/img/" . $produit['image'] ?>" alt="image-sac <?= $produit['name'] ?>">
                              </div>
                              <!-- <div class="card-body"> -->
                              <button class="im">Promo</button>
                              <figcaption class="figure-caption">

                                   <h5 class="card-title"><?= ($produit['name']); ?></h5>
                                   <p class="card-text"><?= substr($produit['detail'], 0, 100) ?>...</p>
                                   <h5><?= $produit['couleur'] ?></h5>
                                   <h5 class="prix"><strike><?= $produit['price'] ?>€ </strike>.<br>
                                   <span style="color: red;">15.00€</span><br></h5>
                                   
                                   <a href="<?= RACINE_SITE . "showProduits.php?id_produit=" . $produit['id_produit'] ?>"
                              class="btn btn-danger w-50 fs-3 mx-auto "> Voir plus </a>
                              <!-- </div> -->
                         <!-- </div> -->
                         </figcaption>
            </figure>

           

    



                    </div>
               <?php
               }
               ?>
               </div>
          </div>
     </section>
</main>

<?php
require_once "inc/footer.inc.php";


?>









    

   