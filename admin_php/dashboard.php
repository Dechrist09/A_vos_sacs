<?php

require_once "../inc/functions.inc.php";


if(isset($_GET['action']) && isset($_GET['id_user'])){
    if(!empty($_GET['action']) && $_GET ['action']=='delete' && !empty($_GET['id_user'])){
        $idUser = htmlentities($_GET['id_user']);

        deleteUser($idUser);
    }
}

if(!empty($_GET['action']) && $_GET['action'] == 'update' && !empty($_GET['id_user'])){
    $user = showUser($_GET['id_user']);
    if($user['role']=='ROLE_ADMIN'){
        updateRole('ROLE_USER',$user['id_user']);

    }

    if($user['role']=='ROLE_USER'){
        updateRole('ROLE_ADMIN',$user['id_user']);

    }
}


if( !isset($_SESSION['user'])){
    header("location:".RACINE_SITE."authentification.php");
}else{
    if($_SESSION['user']['role'] == 'ROLE_USER'){
        header("location:".RACINE_SITE."index.php");
    }
}






$metaDescription ="La page de Gestion pour l'administrateur";
$title = "Backoffice";
require_once "../inc/header.inc.php";
?>

<main>

<section class="top">     <h1 class="text-center">Mon backoffice</h1></section>
 
<!-- 
<div class="d-flex flex-column text-bg-white p-3 sidebarre">
    <hr>
    <!-- <div class="container"> 
    <a href="?dashboard.php" class="btn bg-dark text-center" width="70%">Backoffice</a>
    <a href="?produits.php" class="btn bg-dark text-center" width="70%"> Gestion des Sacs</a>
    <a href="?categories.php" class="btn bg-dark text-center" width="70%">Gestion de Catégories</a>
    <a href="?users.php" class="btn bg-dark text-center" width="70%"> Gstion des Utilisateurs</a>
    <hr>
 </div>
 </div>
    </div> -->

    <div class="container text-center"> 
  <div class="col-sm-6 col-md-4 col-lg-2">
    <div class="d-flex flex-justify-content-center text-bg-white p-3 sidebarre">
      <hr>
      <a href="?dashboard.php" class="btn bg-dark text-center" style="width: 70%;">Backoffice</a>
      <a href="?produits.php" class="btn bg-dark text-center" style="width: 70%;">G. Sacs</a>
      <a href="?categories.php" class="btn bg-dark text-center" style="width: 70%;">G. Catégories</a>
      <a href="?users.php" class="btn bg-dark text-center" style="width: 70%;">G. des Utilisateurs</a>
      <hr>
    </div>
  </div>
</div>

    <div class="row">
        <!-- <div class="col-sm-6 col-md-4 col-lg-2">

            <div class="d-flex flex-column text-bg-dark p-3 sidebarre">
                <hr>

                <ul class="nav nav-pills flex-column mb-auto">
                    <li>
                        <a href="?dashboard.php" class="nav-link text-light">Backoffice</a>
                    </li>
                    <li>
                        <a href="?produits.php" class="nav-link text-light">Sacs</a>
                    </li>
                    <li>
                        <a href="?categories.php" class="nav-link text-light">Catégories</a>
                    </li>
                    <li>
                        <a href="?users.php" class="nav-link text-light">Utilisateurs</a>
                    </li>

                </ul>
                <hr>
            </div>
        </div> -->

        <?php
            if ( isset( $_GET['dashboard_php'] ) ) :
        ?>

        <div class="w-50 m-auto">
            <h2>Bonjour <?php echo $_SESSION['user']['prenom']?></h2>

            <p>Bienvenue sur le backoffice</p>
            <img src="<?=RACINE_SITE?>assets/img/Image.jpeg" alt="Affiche des sac sur le backoffice" width="500" height="800">
        </div>

        <?php
        
            endif;

        ?>


            <div class="col-sm-12">
            <?php

            /** $_GET représente les données qui transitent par l'URL. Il s'agit d'une Super Globale et comme toutes les superglobales elle sont de type array
             * 'superglobale' signifie que cette variable est disponible partout dans le script, y compris au sein des fonctions (pas besoin de faire global $_GET)
             * Les informations transitent dans l'URL selon la syntaxe suivante: 
             * 
             * ex: page.php?indice1=valeur1&indice2=valeur2&indiceN=valeurN
             * Quand on receptionne les données, $_GET est rempli selon le schéma suivant: 
             * 
             *                  $_GET = array(
             *                    'indice1' => 'valeur1',
             *                    'indice2' => 'valeur2',
             *                    'indiceN' => 'valeurN'
             *                   );
            */

            if ( !empty( $_GET ) ) {   //si ma variable $_GET n'est pas vide, cela veut dire que j'ai cliqué sur un lien de la sidebar ( l'indice de la variable $_GET change selon le lien indiqué dans la balise a)

                if ( isset( $_GET['produits_php'] ) ){
                    require_once "produits.php";

                }else if (isset($_GET['categories_php'])){
                    require_once "categories.php";

                }else if (isset($_GET['users_php'])){
                    require_once "users.php";
                }else{
                    require_once "dashboard.php";
                }
            }
            ?>
            </div>
    </div>
</main>


<?php
require_once "../inc/footer.inc.php";



?>