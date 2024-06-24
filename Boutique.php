<?php

require_once "inc/functions.inc.php";

$metaDescription ="Grande Promotion Éclair ! 🌟 Bénéficiez de 50% de réduction sur une sélection exclusive de sacs";
$title = "Boutique";
require_once "inc/header.inc.php";




$info = "";
$produits = allProduits();

// //****  Delete  ****************
if (isset($_GET['action']) && $_GET['action'] == 'supprimer') {
    $pdo = connexionBdd();
    $id_produit = $_GET['id_produit'];

    $sql = "DELETE FROM produits WHERE id_produit = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $id_produit, PDO::PARAM_INT); // Correction ici
    $stmt->execute();
    // Redirect the user back to the user list
    header("Location: " . RACINE_SITE . "admin_php/dashboard.php?produits_php");
    exit();
}

$produits = allProduits();
?>
<main class="" style="background: rosybrown;"> 


<section class="">
<h1 class="A text-white text-center">Le sac parfait pour chaque occasion : A VOS_SACS</h1>
        <div class="container d-flex flex-justify-content-center text-bg-white p-3">
        <a href="<?= RACINE_SITE ?>index.php" class="btn bg-dark text-center" width="70%"><-- A VOS_SACS</a>
        <a href="<?= RACINE_SITE ?>boutique.php" class="btn bg-dark text-center" width="70%"><-- BOUTIQUE</a>
        <a href="<?= RACINE_SITE ?>nouveau.php" class="btn bg-dark text-center" width="70%"><-- COLLECTION</a>
        <a href="<?= RACINE_SITE ?>promo.php" class="btn bg-dark text-center" width="70%"><-- PROMOTION</a>
        <a href="<?= RACINE_SITE ?>profil.php" class="btn bg-dark text-center" width="70%"><-- MON PROFIL</a>
          <!-- Menu déroulant avec les catégories -->
          <li class="nav-item dropdown ">

<a class="nav-link dropdown-toggle btn btn-danger" data-bs-toggle="dropdown" href="Boutique.php"
     role="button" aria-expanded="false">Choisir une catégorie</a>


<ul class="dropdown-menu dropdown-menu-light w-100">

     <?php
     foreach ($categories as $valueCategory) {
      $info = "";

          ?>
          <li class="d-flex">
               <a class="dropdown-item text-dark fs-4"
                    href="?id_category=<?= $valueCategory['id_category'] ?>">
                    <?= $valueCategory['name'] ?>
               </a>
          </li>

          <?php
     }
     ?>
</ul>
</li> 
            </div>
    </section>
    <section class="container-fluid  mt-5">
      
      <!-- <div style="display: flex; flex-direction: column; ">
        <!-- Balise select pour le pourcentage de réduction -->
        <!-- <select name="pourcentage_reduction"> -->
          <!-- <option value="50">Pourcentage_reduction</option> -->
          <!-- <option value="50">Carré - 50%</option> -->
          <!-- <option value="20">Carré - 20%</option> -->
      
    
        
      <div class="row cadre">
                                      
        <?php
          echo $info;

          foreach ($produits as $produit) {
               ?>

<div class="card col-lg-3 col-md-3 col-sm-12 bg-light m-2 mx-auto" style="width: 20rem;">

<div class="card mb-3">
  
<div data-aos="fade-right"> 

          <img src="<?= RACINE_SITE . "assets/img/" . $produit['image'] ?>" class="card-img-top" alt="image du sac">
     </div>
  <div class="card-body">
    <h5 class="card-title"><?= ucfirst($produit['name']) ?></h5>
    <h5 class="card-title"><?= ucfirst($produit['price']) ?>€</h5>
    
    <a href="<?= RACINE_SITE . "showProduits.php?id_produit=" . $produit['id_produit'] ?>"
                              class="btn btn-dark w-50 fs-3 mx-auto ">Plus Detail</a>
  </div>
</div>
</div>
    
               <?php
          }
           ?>                               

</select> 










 </main>

<?php
require_once "inc/footer.inc.php";


?>