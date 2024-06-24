<?php

$title = "Accueil";
// require_once "inc/header.inc.php";
require_once "inc/functions.inc.php";




$info = "";


if (isset($_GET) && !empty($_GET)) {
     if (isset($_GET['id_category'])) {
          $message = "produits à vous proposer dans cette categorie";
          $produits = produitByCategory($_GET['id_category']);

          if (count($produit) == 0) {
               $info = alert("Aucun produit dans cette categorie", "danger");
          }
     } else if (isset($_GET['voirPlus'])) {
          $produits = allProduits();
          $message = "produits à vous proposer.";
     }
} else {
     $produits = produitByDate();
     $mssage = "produits récents à vous proposer.";

}

$metaDescription =" Découvrez notre nouvelle collection de sacs, où l’élégance rencontre la fonctionnalité.";
$title = "Collection";
require_once "inc/header.inc.php";

?>

<main>


<div class="card mb-3 text-left mx-auto" style="max-width: 940px;">
      <div class="row g-0">
        <div class="col-md-4">
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="assets/img/sacP2.jpg" class="d-block w-100" alt="image-sac6">
        </div>
        <div class="carousel-item">
          <img src="assets/img/Image.jpeg" class="d-block w-100" alt="image-sac7">
        </div>
        <div class="carousel-item">
          <img src="assets/img/Image(4).jpeg" class="d-block w-100" alt="image-sac8">
        </div>
        <div class="carousel-item">
          <img src="assets/img/Image.jpeg" class="d-block w-100" alt="image-sac9">
        </div>
        <div class="carousel-item">
          <img src="assets/img/Image(3).jpeg" class="d-block w-100" alt="image-10">
        </div>
      </div>
    </div>
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h2 class="card-title" style="color: red;">NOUVELLES COLLECTIONS</h2>
            <p class="card-text">  Découvrez notre nouvelle collection de sacs, où l’élégance rencontre la fonctionnalité. Chaque pièce est conçue avec soin pour refléter les dernières tendances tout en restant intemporelle. Que vous recherchiez un sac à main sophistiqué pour le bureau ou un sac à dos pratique pour vos aventures du week-end, notre collection offre une variété de styles pour compléter chaque aspect de votre vie. Avec des matériaux de première qualité et une attention méticuleuse aux détails, ces sacs ne sont pas seulement un accessoire, mais un compagnon de tous les jours. Faites votre choix et portez vos essentiels avec distinction.</p>
            <!-- <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p> -->
          </div>
        </div>
      </div>
    </div>
<div class="container produits">

     <h2 class="fw-bolder fs-1 my-5 mx-5"><span class="nbreProduits">
               <?= count($produits) ?>
          </span>
          <?= ($message) ?? "produits" ?>
     </h2>

     <div class="row">

          <?php
          echo $info;

          foreach ($produits as $produit) {
               ?>

               <div class="card bg-light m-2 mx-auto" style="width: 35rem;">
                    <div data-aos="zoom-in">
                         <img src="<?= RACINE_SITE . "assets/img/" . $produit['image'] ?>" class="card-img-top"
                              alt="image du sac">
                    </div>
                    <div class="card-body d-flex flex-column">
                         <h3 class="card-title">
                              <?= ucfirst($produit['name']) ?>
                         </h3>
                         <p class="card-text fs-4">
                              <?= substr(ucfirst($produit['detail']), 0, 100) . "..." ?> <br>
                              <span style="color: red;">Collection</span><br>
                         </p>
                         <a href="<?= RACINE_SITE . "showProduits.php?id_produit=" . $produit['id_produit'] ?>"
                              class="btn btn-danger w-50 fs-3 mx-auto ">Plus de détails</a>
                    </div>
               </div>


               <?php
          }

          if (empty($_GET)) {


               ?>

               <div class="col-12 text-center ">
                    <a href="<?= RACINE_SITE ?>nouveau.php?voirPlus" class="btn-dark p-4 fs-3">Voir plus</a>
               </div>


               <?php

          }
          ?>

     </div>

</div>


</div>



<section class=" greyi rounded">
     <h2 class="text-center" style="color: white;" >Les articles en rupture de stok</h2>
     <div class="row figur"> 
     <div class="container-fuid figur ">
    <div class="col-lg-4 col-md-6 col-sm-12 mb-4 ">
        <figure class=" btn-text-align-items-center pos">
          

      <div data-aos="fade-down-left">


            <img  src="assets/img/sacDos1.jpg" alt="image-portrait">
          </div>
            <button class="im2">Epuisé</button>
            <figcaption>
                Sac à Dos<br>
                Feminin Mini Sac a Dos Femme Elegant Leger Sacs à Main Portés Dos Femme Tendance Cartable Fille Backpack pour Voyage Loisir Collège
         <br>
                 30.00 €
            </figcaption>
        </figure>
        

        </div>
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4 ">
        <figure class=" btn-text-align-items-center pos">
          
      <div data-aos="fade-down-left">

            <img src="assets/img/sacVoyage1.jpg" alt="image-kids">
          </div>
            <button class="im2">Epuisé</button>
            <figcaption>
                Sac De Voyage <br>
                Feminin Mini Sac De Voyage Femme Elegant Leger Sacs à Main Portés  Femme Tendance sac  Femme Backpack pour Voyage Loisir Collège <br>
             70.00€
            </figcaption>
        </figure>

        </div>
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4 ">


        <figure class=" btn-text-align-items-center absolut">
          
        <div data-aos="fade-down-left">

            <img src="assets/img/Image(2).jpeg" alt="image-cours">
          </div>
            <button class="im2">Epuisé</button>
            <figcaption>
                Sac Caba <br>
                Feminin Sac Caba Femme, Elegant Leger Sacs à Main Porté  Femme Tendance  Fille Backpack 
                pour Voyage Loisir Collège <br>
                
              60.00€
            </figcaption>
          </figure>
    </div>
    </div>
</section>

</main>
<?php
require_once "inc/footer.inc.php";


?>

