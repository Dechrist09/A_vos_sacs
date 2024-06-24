<?php
// require_once "inc/functions.inc.php";


// déconnexion ($_SESSION)
logOut();


$categories = allCategories();
?>

<!doctype html>
<html lang="fr">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description"content="<?= $metaDescription ?>"
  <meta name="description" content="Explorez notre collection exclusive de sacs pour femmes, où chaque pièce est conçue pour allier style, confort et qualité. Découvrez votre sac parfait en ligne aujourd’hui!">
  <meta name="author" content="Christelle kambemba">
  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <!-- Font family -->
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;700&family=Roboto:wght@300;400;700;900&display=swap"
    rel="stylesheet">
    
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Tangerine">
     <!-- icons reseau -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

  <!-- Icons Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <!-- mon style -->
  <link rel="stylesheet" href="<?= RACINE_SITE ?>assets/css/style.css">

  <title>
    <?= $title ?>
  </title>
</head>
<body>
     <header class="">

          <nav class="navbar navbar-expand-lg fixed-top bg-secondaire text-black">
               <div class="container-fluid">


                    <!-- <a class="nav-link active" aria-current="page" href="<?//= RACINE_SITE ?>index.php">  -->
                    <a class="navbar-brand" href="<?= RACINE_SITE ?>index.php">
                         <img src="assets/img/Store1 Logo.png" alt="image-logo" height="100vh" width="100"></a>

                    
                    

                    <div class=" collapse navbar-collapse" id="navbarSupportedContent">
                         <!-- w-100 d-flex justify-content-end -->
                         <ul class="navbar-nav w-100 d-flex justify-content-between">

                              <li class="nav-item">
                                   <a class="nav-link" aria-current="page"
                                        href="<?= RACINE_SITE ?>Boutique.php">Boutique</a>
                              </li>

                              <li class="nav-item">
                                   <a class="nav-link" aria-current="page" href="<?= RACINE_SITE ?>promo.php">promo</a>
                              </li>

                              <li class="nav-item">
                                   <a class="nav-link" aria-current="page"
                                        href="<?= RACINE_SITE ?>nouveau.php">Nouveautés</a>
                              </li>

                              <!-- Menu déroulant avec les catégories -->
                              <li class="nav-item dropdown ">

                                   <a class="nav-link dropdown-toggle btn btn-danger" data-bs-toggle="dropdown" href="#"
                                        role="button" aria-expanded="false">Choisir une catégorie</a>


                                   <ul class="dropdown-menu dropdown-menu-light w-100">

                                        <?php
                                        foreach ($categories as $valueCategory) {


                                             ?>
                                             <li class="d-flex">
                                                  <a class="dropdown-item text-dark fs-4"
                                                       href="<?= RACINE_SITE ?>?id_category=<?= $valueCategory['id_category'] ?>">
                                                       <?= $valueCategory['name'] ?>
                                                  </a>
                                             </li>

                                             <?php
                                        }
                                        ?>
                                   </ul>
                              </li>

                              <!--  -->
                              <!--  -->
                              <?php if (empty($_SESSION['user'])) { ?>

                                   <!-- Lien ver le formulaire d'inscription -->
                                   <li class="nav-item">
                                        <a class="nav-link" href="<?= RACINE_SITE ?>inscription.php">inscription</a>
                                   </li>
                                   <!-- Lien vers la page de connexion -->
                                   <li class="nav-item">
                                        <a class="nav-link" href="<?= RACINE_SITE ?>authentification.php">Connexion</a>
                                   </li>
                                   <!--  -->
                              <?php } else { ?>

                                   <li class="nav-item">
                                        <a class="nav-link" href="<?= RACINE_SITE ?>profil.php">Compte <sup
                                                  class="badge rounded-pill text-bg-danger ms-2 fs-6">
                                                  <?= $_SESSION['user']['prenom'] ?>
                                             </sup></a>
                                   </li>

                                   <?php if ($_SESSION['user']['role'] == 'ROLE_ADMIN') { ?>
                                        <!--  -->
                                        <li class="nav-item">
                                             <a class="nav-link"
                                                  href="<?= RACINE_SITE ?>admin_php/dashboard.php">Backoffice</a>
                                        </li>

                                   <?php } ?>

                                   <li class="nav-item">
                                        <a class="nav-link" href="?action=deconnexion">Déconnexion</a>
                                   </li>
                                   <!--  -->
                              <?php } ?>

                              <li class="nav-item">

                                   <a class="nav-link" href="<?= RACINE_SITE ?>panier/panier.php"><i
                                             class="bi bi-cart3 text-danger "></i></a>
                              </li>


                         </ul>

               </div>
               </div>
          </nav>

     </header>