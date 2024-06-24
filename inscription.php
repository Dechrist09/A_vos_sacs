<?php


require_once "inc/functions.inc.php";

// Si l'utilisateur est déjà connecté, il pourras pas avoir accés à la page d'inscription
if (!empty($_SESSION['user'])) {

    header("location:" . RACINE_SITE . "profil.php");
}

echo "<br><br><br><br><br>";




$year1 = ((int) date('Y')) - 12; // 2012
$month = (date('m'));
$date = (date('d'));
// date limite supèrieure
$dateLimitSup = $year1 . "-" . $month . "-" . $date;
// date limite infèrieur
$year2 = ((int) date('Y')) - 90;
$dateLimitInf = $year2 . "-" . $month . "-" . $date;

$info = '';

if (!empty($_POST)) // l'envoi du Formulaire (button "S'inscrire" ) 
{
    // debug($_POST);

    $verif = true;

    foreach ($_POST as $value) {


        if (empty($value)) {

            $verif = false;
        }
    }

    if (!$verif) {
        debug($_POST);


        $info = alert("Veuillez renseigner tout les champs", "danger");
    } else {

        debug($_POST);

        // On stock les values de nos champs dans des variables et en les passant dans la fonction trim()



        // $firstName = isset($_POST['firstName']) ? $_POST['firstName'] : null;
        $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : null;
        $nom = isset($_POST['nom']) ? $_POST['nom'] : null;
        $email = isset($_POST['email']) ? $_POST['email'] : null;
        $mdp = isset($_POST['mdp']) ? $_POST['mdp'] : null;
        $confirmMdp = isset($_POST['confirmMdp']) ? $_POST['confirmMdp'] : null;
        // $phone = isset($_POST['phone']) ? $_POST['phone'] : null;
        $civility = isset($_POST['civility']) ? $_POST['civility'] : null;
        // $birthday = isset($_POST['birthday']) ? $_POST['birthday'] : null;
        $adresse = isset($_POST['adresse']) ? $_POST['adresse'] : null;
        $zipCode = isset($_POST['zipCode']) ? $_POST['zipCode'] : null;
        // $city = isset($_POST['city']) ? $_POST['city'] : null;
        $country = isset($_POST['country']) ? $_POST['country'] : null;




        if (strlen($prenom) < 2 || preg_match('/[0-9]+/', $prenom)) {

            $info = alert("Le prenom n'est pas valide.", "danger");
        }

        if (strlen($nom) < 2 || preg_match('/[0-9]+/', $nom)) {

            $info .= alert("Le nom n'est pas valide.", "danger");
        }

        // if (strlen($pseudo) < 2) {

        //     $info .= alert("Le pseudo n'est pas valide.", "danger");
        // }

        if (strlen($mdp) < 5 || strlen($mdp) > 15) {

            $info .= alert("Le mot de passe n'est pas valide.", "danger");
        }
        if ($mdp !== $confirmMdp) {

            $info .= alert("Le mot de passe et la confirmation doivent être identique.", "danger");
        }


        if (strlen($email) > 50 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $info .= alert("L'email n'est pas valide.", "danger");
        }

        // if (!preg_match('#^[0-9]+$#', $phone) || strlen($phone) > 10 || !trim($phone)) {

        //     $info .= alert("Le Téléphone n'est pas valide.", "danger");
        // }

        if ($civility != 'femme' && $civility != 'homme') {
            $info .= alert("La civilité n'est pas valide.", "danger");
        }

        if (strlen($adresse) < 5 || strlen($adresse) > 50) {
            $info .= alert("L'adresse n'est pas valide.", "danger");
        }

        if (!preg_match('#^[0-9]+$#', $zipCode)) {
            $info .= alert("Le code postal n'est pas valide.", "danger");
        }

        // if (strlen($city) > 20) {
        //     $info .= alert("La ville n'est pas valide.", "danger");
        // }

        if (strlen($country) < 5 || strlen($country) > 50) {
            $info .= alert("Le pays n'est pas valide.", "danger");
        }

        // if ($birthday > $dateLimitSup && $birthday < $dateLimitInf) {
        //     $info .= alert("La date de naissance n'est pas valide.", "danger");
        // }


        if (empty($info)) {

            $emailExist = checkEmailUser($email);
            $prenomExist = checkPrenomUser($prenom);


            if ($emailExist || $prenomExist) {

                $info = alert("Vous avez déjà un compte", "danger");
                // ***************** REDIRECTION "authentification.php"



            } else if ($mdp !== $confirmMdp) {

                $info .= alert("Le mot de passe et la confirmation doivent être identiques.", "danger");
            } else {
                // $datas = array($prenom, $nom, $email, $mdp, $civility, $adresse, $zipCode, $country);
                // debug($datas);

                $mdp = password_hash($mdp, PASSWORD_DEFAULT);

                inscriptionUsers($prenom, $nom, $email, $mdp, $civility, $adresse, $zipCode, $country);

                $info = alert('Vous êtes bien inscrit, vous pouvez vous connectez !', 'success');
            }
        }
    }
} else {
    debug($_POST);
    echo 'Non SUBMIT';
}



$metaDescription ="Bienvenue sur la pade inscription , veuillez vous inscrire sur le formulaire d'inscription";
$title = "Inscription";
require_once "inc/header.inc.php";

?>

?>

<main style="background:url(assets/img/image13.jpeg) no-repeat; background-size: cover; background-attachment: fixed;"
    class="pt-5">

    <div class="w-75 m-auto p-5" style="background: rgba(20, 20, 20, 0.9);">
        <h2 class="text-center text-white p-3 mb-5 blanc ">Créer un compte</h2>

        <?php

        echo $info;

        ?>

        <form action="" method="post" class="p-5">

            <div class="row mb-3">
                <div class="col-md-12 mb-5">
                    <label for="prenom" class="form-label text-white mb-3">Prenom</label>
                    <input type="text" class="form-control fs-5 A" id="prenom" name="prenom">
                </div>
                <div class="col-md-12 mb-5">
                    <label for="nom" class="form-label text-white mb-3">Nom</label>
                    <input type="text" class="form-control fs-5 A" id="nom" name="nom">
                </div>

            </div>

            <div class="row mb-3">

                <div class="col-md-12 mb-5">
                    <label for="email" class="form-label text-white mb-3">Email</label>
                    <input type="text" class="form-control fs-5 A" id="email" name="email"
                        placeholder="exemple.email@exemple.com">
                </div>

            </div>

            <div class="row mb-3">
                <div class="col-md-12 mb-5">
                    <label for="mdp" class="form-label text-white mb-3">Mot de passe</label>
                    <input type="password" class="form-control fs-5 A" id="mdp" name="mdp"
                        placeholder="Entrez votre mot de passe">
                </div>
                <div class="col-md-12 mb-5">
                    <label for="confirmMdp" class="form-label text-white mb-3">Confirmation mot de passe</label>
                    <input type="password" class="form-control fs-5 A" id="confirmMdp" name="confirmMdp"
                        placeholder="Confirmer votre mot de passe">
                    <input type="checkbox" onclick="showPass()"><span class="text-danger A">Afficher/masquer le mot de
                        passe</span>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12 mb-5">
                    <label class="form-label text-white mb-3">Civilité</label>
                    <select class="form-select fs-5 A" name="civility">
                        <option value="c">choix</option>
                        <option value="homme">h</option>
                        <option value="femme">f</option>

                    </select>


                    <div class="row mb-3">
                        <div class="col-12 mb-5">
                            <label for="adresse" class="form-label text-white mb-3">Adresse</label>
                            <input type="text" class="form-control fs-5 A" id="adresse" name="adresse">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 mb-5">
                            <label for="zipCode" class="form-label text-white mb-3">Code postal</label>
                            <input type="text" class="form-control fs-5 A" id="zipCode" name="zipCode">
                        </div>

                        <div class="col-md-6 mb-5">
                            <label for="country" class="form-label text-white  mb-3">Pays</label>
                            <input type="text" class="form-control fs-5 A" id="country" name="country">
                        </div>
                    </div>


                    <div class="row mt-5">
                        <button class="w-25 m-auto btn btn-danger btn-lg fs-5" type="submit">Annuler</button>

                        <button class="w-25 m-auto btn btn-danger btn-lg fs-5" type="submit">S'inscrire</button>
                        <p class="text-center text-white mt-5">Vous avez déjà un compte ! <a href="authentification.php"
                                class="text-danger">Connectez-vous ici</a></p>
                    </div>
                    <p class="couleur text-white"> Je m'inscris à la newsletter et profite de 10% sur ma PREMIERE
                        COMMANDE !!!</p>

        </form>
    </div>


</main>

<?php
require_once "inc/footer.inc.php";
?>