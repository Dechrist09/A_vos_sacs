<?php

require_once "../inc/functions.inc.php";

if (!isset($_SESSION['user'])) {
    header("location:" . RACINE_SITE . "authentification.php");
} else {
    if ($_SESSION['user']['role'] == 'ROLE_USER') {
        header("location:" . RACINE_SITE . "index.php");
    }
}


// **********************************************//

if (isset($_GET['action']) && isset($_GET['id_produit'])) {

    if (!empty($_GET['action']) && $_GET['action'] == 'update' && !empty($_GET['id_produit'])) {

        $idProduit = $_GET['id_produit'];
        $produit = showProduits($idProduit);
    }
}

if (isset($_GET['action']) && isset($_GET['id_produit'])) {
    if (!empty($_GET['action']) && $_GET['action'] == 'delete' && !empty($_GET['id_produit'])) {

        $idCategory = $_GET['id_produit'];
        $category = deleteProduits($idCategory);
    }
}
// ///////////////////////////////////////////////////
$info = '';


if (!empty($_POST)) {
    debug($_POST);

    $verif = true;

    foreach ($_POST as $value) {

        if (empty(trim($value))) {
            $verif = false;
        }
    }

    // la superglobal $_FILES a un indice "image" qui correspond au "name" de l'input type="file" du formulaire, ainsi qu'un indice "name" qui contient le nom du fichier en cours de téléchargement.

    // if (!empty($_FILES['image']['name'])) { 
    // si le nom du fichier en cours de téléchargement n'est pas vide, alors c'est qu'on est entrain de télécharger une photo
    // debug($_FILES);

    // $image = $_FILES['image']['name']; 
    // $image contient le chemin relatif de la photo et sera enregistré en BDD. On utilise ce chemin pour les "src" des balises <img>.
    // }



    if (!$verif) {
        $info = alert("Tous les champs sont requis", "danger");
    } else {

        // ************************************************************************

        $maxSize = 500000;
        $extensions = array('.jpg', '.jpeg');
        $extension = strrchr($_FILES['image']['name'], '.');
        if (!in_array($extension, $extensions)) {
            echo 'vous devez uploader un fichier de type jpeg ou jpg';
        }
        if ($_FILES['image']['size'] > $maxSize) {
            echo 'alert';
        }
        // ***************************************************************************

        if ($_FILES['image']['error'] != 0 || $_FILES['image']['size'] == 0 || !isset($_FILES['image']['type'])) {
            $info = alert("L'image n'est pas valide", "danger");
        }
        if (!isset($_POST['name']) || (strlen($_POST['name']) < 3 && trim($_POST['name'])) || preg_match('/[0-9]+/', $_POST['name'])) {


            $info .= alert("Le champ nom n'est pas valide", "danger");
        }

        if (!isset($_POST['couleur']) || (strlen($_POST['couleur']) < 2 && trim($_POST['couleur'])) || preg_match('/[0-9]+/', $_POST['couleur'])) {

            $info .= alert("Le champs couleur n'est pas valide", "danger");
        }

        

        if (!isset($_POST['categories'])) {

            $info .= alert("Le champs catégories n'est pas valide", "danger");
        }

        if (!isset($_POST['detail']) || strlen($_POST['detail']) < 50) {

            $info .= alert("Le champs detail n'est pas valide", "danger");
        }

        

        if (!isset($_POST['date'])) {

            $info .= alert("Le champs date n'est pas valide", "danger");
        }

        if (!isset($_POST['price']) || !is_numeric($_POST['price'])) {

            $info .= alert("Le prix n'est pas valide", "danger");
        }

        if (!isset($_POST['stock'])) {

            $info .= alert("Le stock n'est pas valide", "danger");
        }


        //S'il n y a pas d'erreur sur le formulaire
        if (empty($info)) {


            $category = $_POST['categories'];
            $name = htmlentities(trim($_POST['name']));
            // $category = $_POST['categories'];
            $couleur = $_POST['couleur'];
            $detail = htmlentities(trim($_POST['detail']));
            $dateEntree = $_POST['date'];
            $image = $_FILES['image']['name'];
            $price = (float) htmlentities(trim($_POST['price']));
            $stock = (int) $_POST['stock'];
            $promo = isset($_POST['promo']);
            // $idCategory = idCategory($category);
            // $category_id = idCategory['id_category'];


            if (isset($_GET['action']) && $_GET['action'] == 'update' && isset($_GET['id_produit'])) {


                move_uploaded_file($_FILES['image']['tmp_name'], '../assets/img/' . $image);

                 updateProduit($idProduit, $category, $name, $couleur, $detail,  $dateEntree, $image, $price, $stock, $promo);
            } else {

                move_uploaded_file($_FILES['image']['tmp_name'], '../assets/img/' . $image);

                // On enregistre le fichier image qui se trouve à l'adresse contenue dans $_FILES['image']['tmp_name'] vers la destination qui est le dossier "img" à l'adresse "../assets/nom_du_fichier.jpg".

                addProduit( $category, $name, $couleur, $detail,  $dateEntree, $image, $price, $stock ,$promo);
            }

            header('location:dashboard.php?produits_php');
        }
    }
}





$metaDescription ="Gestion des produit formulaire d' ajout et modification";
$title = 'Gestion des produits';

require_once "../inc/header.inc.php";

?>

<main>
<section class="container">
    <h2 class="text-center fw-bolder mb-5 text-danger"><?= isset($produit) ? 'Modifier un produit' : 'Ajouter un produit' ?></h2>
    <?php
    echo $info;
    ?>
    <form action="" method="post" enctype="multipart/form-data">
        <!-- l'attribut enctype spécifie que le formulaire envoie des fichiers en plus des données texte => permet d'uploader un fichier (ex photo)-->

        <div class="row">
            <div class="col-md-6 mb-5 text-dark">
                <label for="name">Nom</label>
                <input type="text" id="name" name="name" class="form-control fs-3" value="<?= $produit['name'] ?? '' ?>">
            </div>
            <div class="col-md-6 mb-5 text-dark">
                <label for="image">Photo</label>
                <input class="form-control fs-3" type="file" id="image" name="image" value="<?= $produit['image'] ?? '' ?>">
            </div>
        </div>


        <div class="row">
            <div class="mb-3">
                <label for="couleur" class="form-label text-dark">Couleur de sac</label>
                <select multiple name="couleur" id="couleur" class="form-select form-select-lg fs-3">
                    <option value="multi" <?php if (isset($produit['couleur']) && $produit['couleur'] =='multi') echo 'selected' ?>>multi</option>
                    <option value="rose" <?php if (isset($produit['couleur']) && $produit['couleur'] == 'rose') echo 'selected' ?>>rose</option>
                    <option value="noir" <?php if (isset($produit['couleur']) && $produit['couleur'] == 'noir') echo 'selected' ?>>noir</option>
                    <option value="marron" <?php if (isset($produit['couleur']) && $produit['couleur'] == 'marron') echo 'selected' ?>>marron</option>
                    <option value="vert" <?php if (isset($produit['couleur']) && $produit['couleur'] == 'vert') echo 'selected' ?>>vert</option>
                    <option value="bleu" <?php if (isset($produit['couleur']) && $produit['couleur'] =='bleu') echo 'selected' ?>>bleu</option>
     
                </select>
            </div>
        </div>

        <div class="row">
            <label for="categories">Genre du Sac</label>

            <?php
            $categories = allCategories();

            foreach ($categories as $category) {

            ?>
                <div class="form-check col-sm-12 col-md-4">
                    <input type="checkbox" name="categories" class="form-check-input text-dark" id="flexRadioDefault1" value="<?= $category['id_category'] ?>" <?php if (isset($produit['category_id']) && $produit['category_id'] == $category['id_category']) echo 'checked' ?>>

                    <label class="form-check-label text-dark" for="flexRadioDefault1"><?= $category['name'] ?></label>
                </div>
            <?php
            }
            ?>
        </div>

        <div class="row">
            
            <div class="col-md-6 mb-5 text-dark">
                <label for="date">Date d'entrée</label>
                <input type="date" class="form-control fs-3" id="date" name="date" value="<?= $produit['date'] ?? '' ?>">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-5">
                <label for="price">Prix</label>
                <div class="input-group">
                    <input type="text" class="form-control fs-3" id="price" name="price" value="<?= $produit['price'] ?? '' ?>" aria-label="Euros amount(with dot and two decimal places">
                    <span class="input-group-text">€</span>
                </div>
            </div>
            <div class="col-md-6 mb-5">
                <label for="stock">Stock</label>
                <input type="number" name="stock" id="stock" class="form-control fs-3" min="0" value="<?= $produit['stock'] ?? '' ?>">
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <label for="detail">Detail</label>
                <textarea name="detail" id="detail" cols="30" rows="10" class="form-control fs-3"><?= $produit['detail'] ?? '' ?></textarea>
            </div>
        </div>

        <div class="form-check col-sm-12 col-md-4">
        <input type="checkbox" name="promo" class="form-check-input" id="flexRadioDefault1" value="oui" <?php if (isset($produit['promo']) && $produit['promo'] === 'oui') echo 'checked' ?>>


                    <label class="form-check-label text-dark" for="flexRadioDefault1">En promotion</label>
                </div>

        <div class="row">
            <button type="submit" class="btn btn-danger w-50 p-3 mx-auto fs-3 mt-5"><?= isset($produit) ? 'Modifier' : 'Ajouter' ?></button>
        </div>


    </form>

    </section>


</main>




<?php

require_once "../inc/footer.inc.php";
?>





