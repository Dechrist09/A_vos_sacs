<?php

require_once "inc/functions.inc.php";


if (!empty($_GET)) {

    $idProduit = htmlentities($_GET['id_produit']);

    $produit = showProduits($idProduit);

    if ($_GET['id_produit'] != $produit['id_produit']) {

        header("location:" . RACINE_SITE . "nouveau.php");
    } else {

        $name = ($produit['name']);
        $category = showCategory($produit['category_id']);
        $categoryName = $category['name'];
        $date_time = new DateTime($produit['date']);
        // $duration = $date_time->format('H:i');
    }
}










$metaDescription ="Decouvrez plus de detail du Produit ";
$title = $produit['name'];

require_once "inc/header.inc.php";
debug($produit);

?>

<main class="mt-5">
    <div class="produit bg-dark text-white">

        <div class="back">
            <a href="<?= RACINE_SITE . "index.php" ?>"><i class="bi bi-arrow-left-circle-fill"></i></a>
        </div>
        <div class="cardDetails row mt-5">
            <h2 class="text-center mb-5"><?= ucfirst($produit['name']) ?></h2>
            <div class="col-12 col-xl-5 row p-5">
                <img src="<?= RACINE_SITE . "assets/img/" . $produit['image'] ?>" alt="image du sac">
                <!--  -->
                <div class="col-12 mt-5">
                    <form action="<?= RACINE_SITE . 'panier/panier.php' ?>" method="POST" enctype="multipart/form-data" class="w-50 m-auto row justify-content-center p-5">

                        <input type="hidden" name="id_produit" value="<?= $produit['id_produit'] ?>">
                        <input type="hidden" name="name" value="<?= $produit['name'] ?>">
                        <input type="hidden" name="couleur" value="<?= $produit['couleur'] ?>">
                        <input type="hidden" name="price" value="<?= $produit['price'] ?>">
                        <input type="hidden" name="stock" value="<?= $produit['stock'] ?>">
                        <input type="hidden" name="image" value="<?= $produit['image'] ?>">
                        <select name="quantity" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                            <?php for ($i = 1; $i <= $produit['stock']; $i++) { ?>

                                <option value="<?= $i ?>"><?= $i ?></option>

                            <?php } ?>


                        </select>

                        <input class="btn btn-outline-danger mt-3 w-100" type="submit" value="Ajouter au panier" name="ajout_panier" id="addCart">

                    </form>
                </div>

                <!--  -->
            </div>
            <div class="detailsContent  col-md-7 p-5">
                <div class="container mt-5">
                    <div class="row">
                        <h3 class="col-4"><span>Name:</span></h3>
                        <ul class="col-8">
                            <li><?= ucfirst($produit['name']) ?></li>

                        </ul>
                        <hr>
                    </div>
                    <!-- <div class="row">
                        <h3 class="col-4"><span>Nom :</span></h3>
                        <ul class="col-8">
                            <?php
                            foreach ($name as $value) {
                            ?>
                                <li><?= $value ?></li>
                            <?php
                            }
                            ?>
                        </ul>
                        <hr>
                    </div> -->
                    
                    <div class="row">
                        <h3 class="col-4"><span>Genre : </span></h3>
                        <ul class="col-8">
                            <li><?= $categoryName ?></li>

                        </ul>
                        <hr>
                    </div>
                    <div class="row">
                        <h3 class="col-4"><span>Couleur: </span></h3>
                        <ul class="col-8">
                            <li><?= $produit['couleur']?></li>


                        </ul>
                        <hr>
                    </div>
                    <div class="row">
                        <h3 class="col-4"><span>Date d'Entrée:</span></h3>
                        <ul class="col-8">
                            <li><?= $produit['date'] ?></li>

                        </ul>
                        <hr>
                    </div>
                    <div class="row">
                        <h3 class="col-4"><span>Prix : </span></h3>
                        <ul class="col-8">
                            <li><?= $produit['price'] ?>€</li>

                        </ul>
                        <hr>
                    </div>
                    <div class="row">
                        <h3 class="col-4"><span>Stock :</span> </h3>
                        <ul class="col-8">
                            <li><?= $produit['stock'] ?></li>

                        </ul>
                        <hr>
                    </div>
                    <div class="row">
                        <h5 class="col-4"><span>Detail :</span></h5>
                        <ul class="col-8">
                            <li><?= html_entity_decode($produit['detail']) ?></li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>


    </div>
</main>



<?php
require_once "inc/footer.inc.php";


?>