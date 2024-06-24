<?php

 require_once "../inc/functions.inc.php";
// require_once"../inc/functions.inc.php";
if( !isset($_SESSION['user'])){
    header("location:".RACINE_SITE."authentification.php");
}else{
    if($_SESSION['user']['role'] == 'ROLE_USER'){
        header("location:".RACINE_SITE."index.php");
    }
}



// ************************************************




$title = "Produits";

?>

<main>

    <div class="d-flex flex-column m-auto mt-5">

        <h2 class="text-center fw-bolder mb-5 text-danger">Liste des produits</h2>
        <a href="gestionProduits.php" class="btn btn-dark p-3 fs-3 align-self-end "> Ajouter un sac</a>
        <table class="table table-dark table-bordered mt-5 ">
            <thead>
                <tr>
                    <!-- th*7 -->
                    <th>ID</th>
                    <th>Name</th>
                    <th>Affiche</th>
                    <th>Couleur</th>
                    <th>Genre</th>
                    <th>Date d entrée</th>
                    <th>Prix</th>
                    <th>Stock</th>
                    <th>promo</th>
                    <th>Supprimer</th>
                    <th> Modifier</th>
                </tr>
            </thead>
            <tbody>
            <?php

$produits = allProduits();

foreach($produits as $produit){


?>
                <tr>

                    <!-- Je récupére les valeus de mon tabelau $film dans des td -->
                    <td><?=$produit['id_produit']?></td>
                    <td><?=ucfirst($produit['name'])?></td>


                    <!-- <td> <img src="<?php //echo RACINE_SITE.$film['image']?>" alt="image du film" class="img-fluid"> </td> -->
                    <!-- puis dans la bdd mettre le lien depuis assets -->

                    <td> <img src=" <?= RACINE_SITE."assets/img/".$produit['image']?> " alt="image du produit" class="img-fluid"> </td>
                    <td><?=ucfirst($produit['couleur'])?></td>
                    <td><?=isset($produit['genre'])?ucfirst($produit['genre']): "Ajouter une catégorie"?></td>
                    <td><?=substr(ucfirst($produit['detail']),0,250)."..."?></td>
                    <td><?=ucfirst($produit['date'])?></td>
                    <td><?=ucfirst($produit['price'])?>£</td>
                    <td><?=ucfirst($produit['stock'])?></td>
                    <td><?=ucfirst($produit['promo'])?></td>
                    <td class="text-center"><a href="gestionProduits.php?action=delete&id_produit=<?= $produit['id_produit']?>"><i class="bi bi-trash3-fill text-danger"></i></a></td>

                    <td class="text-center"><a href="gestionProduits.php?action=update&id_produit=<?= $produit['id_produit']?>"><i class="bi bi-pen-fill text-danger"></i></a></td>

                </tr>
<?php
}
?>

            </tbody>


        </table>


    </div>

</main>

<?php
require_once "../inc/footer.inc.php";
?>




