<!-- Fichier qui contient les fonctions php à utiliser dans notre site -->
<?php

session_start();

define("RACINE_SITE", "/A_VOS_SACS/"); // constante qui définit les dossiers dans lesquels se situe le site pour pouvoir déterminer des chemin absolus à partir de localhost (on ne prend pas locahost). Ainsi nous écrivons tous les chemins (exp : src, href) en absolus avec cette constante.


///////////////////////////// Fonction de débugage //////////////////////////
/**
 * c'est une fonction pour recuperer le tableau 
 * 
 *
 * @param [type] $var
 * @return void
 */
function debug($var)


 
{

    echo '<pre class="border border-dark bg-light text-primary w-50 p-3">';

    var_dump($var);

    echo '</pre>';
}


////////////////////// Fonction d'alert ////////////////////////////////////////

function alert(string $contenu, string $class)
{

    return "<div class='alert alert-$class alert-dismissible fade show text-center w-50 m-auto mb-5' role='alert'>
        $contenu

            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>

        </div>";
}


///////////////////////////// Fonction de déconnexion/////////////////////////

function logOut()
{

    if (isset($_GET['action']) && !empty($_GET['action']) && $_GET['action'] == 'deconnexion') {


        unset($_SESSION['user']);
        // On supprime l'indice "user " de la session pour se déconnecter // cette fonction détruit les variables  stocké  comme 'firstName' et 'email'.

        //session_destroy(); // Détruit toutes les données de la session déjà  établie . cette fonction détruit la session sur le serveur 

        header("location:" . RACINE_SITE . "index.php");
    }
}
// logOut();


///////////////////////////  Fonction de connexion à la BDD //////////////////////////

/**
 * On va utiliser l'extension PHP Data Object (PDO), elle définit une excellente interface pour accèder à une base de données depuis PHP et d'éxécuter des requêtes SQL.
 * pour se connecter à la BDD avec PDO, il faut créer une instance de cette Class/Objet (PDO) qui représente une connexion à la BDD.
 */

// On déclare des constantes d'environnement qui vont contenir les informations à la connexion à la BDD

// Constante du serveur => localhost
define("DBHOST", "localhost");

// Constante de l'utilisateur de la BDD du serveur en local  => root
define("DBUSER", "root");

// Constante pour le mot de passe de serveur en local => pas de mot de passe
define("DBPASS", "");

// Constante pour le nom de la BDD
define("DBNAME", "sacs");


function connexionBdd()
{

    // Sans la variable $dsn et sans le constantes, on se connecte à la BDD :

    // $pdo = new PDO('mysql:host=localhost;dbname=cinema;charset=utf8', 'root', '');

    // avec la variable DSN (Data Source Name) et les constantes

    // $dsn = "mysql:host=localhost;dbname=cinema;charset=utf8";

    $dsn = "mysql:host=" . DBHOST . ";dbname=" . DBNAME . ";charset=utf8";

    try {

        $pdo = new PDO($dsn, DBUSER, DBPASS);

        // On définit le mode d'erreur de PDO sur Exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch (PDOException $e) {

        die($e->getMessage());
    }

    return $pdo;
}

//////////////////// Fonctions du CRUD pour les utilisateurs Users /////////////////////

function inscriptionUsers( string $prenom, string $nom, string $email, string $mdp,string $civility,  string $adresse, string $zipCode,  string $country): void
{

    $pdo = connexionBdd(); // je stock ma connexion  à la BDD dans une variable

    $sql = "INSERT INTO users 
        (prenom,nom,email,mdp,civility,adresse, zipCode,country)
        VALUES
        (:prenom, :nom, :email, :mdp, :civility, :adresse, :zipCode, :country)"; // Requête d'insertion que je stock dans une variable
    $request = $pdo->prepare($sql); // Je prépare ma requête et je l'exécute
    $request->execute(
        array(
            ':prenom' => $prenom,
            ':nom' => $nom,
            ':email' => $email,
            ':mdp' => $mdp,
            ':civility' => $civility,
            ':adresse' => $adresse,
            ':zipCode' => $zipCode,
            ':country' => $country

        )
    );
}
// connexionBdd();
////////////////// Fonction pour vérifier si un email existe dans la BDD ///////////////////////////////
/**
 * Undocumented function
 *
 * @param string $email
 * @return mixed
 */
function checkEmailUser(string $email): mixed
{
    $pdo = connexionBdd();
    $sql = "SELECT * FROM users WHERE email = :email";
    $request = $pdo->prepare($sql);
    $request->execute(array(
        ':email' => $email

    ));

    $resultat = $request->fetch();
    return $resultat;
}

////////////////// Fonction pour vérifier si un prenom existe dans la BDD ///////////////////////////////

function checkPrenomUser(string $prenom)
{
    $pdo = connexionBdd();
    $sql = "SELECT * FROM users WHERE prenom = :prenom";
    $request = $pdo->prepare($sql);
    $request->execute(array(
        ':prenom' => $prenom

    ));

    $resultat = $request->fetch();
    return $resultat;
}

/////////// Fonction pour vérifier un utilisateur ////////////////////

function checkUser(string $email, string $prenom): mixed
{

    $pdo = connexionBdd();

    $sql = "SELECT * FROM users WHERE prenom = :prenom AND email = :email";
    $request = $pdo->prepare($sql);
    $request->execute(array(
        ':prenom' => $prenom,
        ':email' => $email


    ));
    $resultat = $request->fetch();
    return $resultat;
}

//  /////////////////Fonction pour récupérer tous les utilisateurs///////////////////


function allUsers(): array
{

    $pdo = connexionBdd();
    $sql = "SELECT * FROM users";
    $request = $pdo->query($sql);
    $result = $request->fetchAll();
    return $result;
}

// /////////////////  Fonction pour recupereer un seul utilisateur  //////////////////////

function showUser(int $id): array
{
    $pdo = connexionBdd();
    $sql = "SELECT * FROM users WHERE id_user = :id_user";
    $request = $pdo->prepare($sql);
    $request->execute(array(

        ':id_user' => $id

    ));
    $result = $request->fetch();
    return $result;
}

// /////////////////  Fonction pour supprimer un utilisateur  ///////////////////////

function deleteUser(int $id): void
{
    $pdo = connexionBdd();
    $sql = "DELETE FROM users WHERE id_user = :id_user";
    $request = $pdo->prepare($sql);
    $request->execute(array(

        ':id_user' => $id

    ));
}

// ////////////////////  Fonction pour modifier le role d'un utilisateur//////////////

function updateRole(string $role, int $id): void
{
    $pdo = connexionBdd();
    $sql = "UPDATE users SET role = :role WHERE id_user = :id_user";
    $request = $pdo->prepare($sql);
    $request->execute(array(
        ':role' => $role,
        ':id_user' => $id

    ));
}

// ////////   Fonction pour ajouter une catégorie   /////////////
function addCategory(string $categoryName, string $description): void
{

    $pdo = connexionBdd();

    $sql = "INSERT INTO categories (name, description) VALUES (:name, :description)";

     $request = $pdo->prepare($sql);
     $request->execute(array(

        ':name' => $categoryName,
        ':description' => $description
     ));
 }


//////////////une fonction pour recupérer toutes les catégories//////////

function allCategories(): array
{

    $pdo = connexionBdd();
    $sql = "SELECT * FROM categories";
    $request = $pdo->query($sql);
    $result = $request->fetchAll();
    return $result;
}

////////  Fonction pour supprimer une categorie //////////

function deleteCategory(int $id): void
{
    $pdo = connexionBdd();

    $sql = "DELETE FROM categories WHERE id_category = :id";
    $request = $pdo->prepare($sql);
    $request->execute(array(':id' => $id));
}

// //////////   fonction pour afficher une categorie  ////////////

function showCategory(int $id): mixed
{
    $pdo = connexionBdd();
    $sql = "SELECT * FROM categories WHERE id_category = :id ";
    $request = $pdo->prepare($sql);
    $request->execute(array(
        ':id' => $id
    ));

    $result = $request->fetch();
    return $result;
}

// //////////////  Fonction pour récuperer un produit qui a la même catégorie  /////////////////

function produitByCategory(int $id): array
{
    $pdo = connexionBdd();
    $sql = "SELECT * FROM produits WHERE category_id = :id";
    $request = $pdo->prepare($sql);
    $request->execute([':id' => $id]);

    $result = $request->fetchAll();
    return $result;
}


// ///////////  Fonction pour ajouter un produit ////////////

function addProduit(int $category, string $name, string $couleur,string $detail, string $dateEntree, string $image, float $price, int $stock, string $promo): void
{

    $pdo = connexionBdd();

    $sql = "INSERT INTO produits (category_id, name, couleur, detail, date, image, price, stock, promo) VALUES (:category_id, :name, :couleur,:detail , :date, :image, :price, :stock, :promo)";

    $request = $pdo->prepare($sql);
    $request->execute(array(

        ':category_id' => $category,
        ':name' => $name,
        ':couleur' => $couleur,
        ':detail' => $detail,
        ':date' => $dateEntree,
        ':image' => $image,
        ':price' => $price,
        ':stock' => $stock,
        ':promo' => $promo
    ));
}

//////////////  fonction pour afficher un produit///////////////

function showProduits(int $id): mixed
{
    $pdo = connexionBdd();
    $sql = "SELECT * FROM produits WHERE id_produit = :id ";
    $request = $pdo->prepare($sql);
    $request->execute(array(
        ':id' => $id
    ));

    $result = $request->fetch();
    return $result;
}

// //////////  Fonction pour supprimer un Produit/////////////

function deleteProduits(int $id): void
{
    $pdo = connexionBdd();

    $sql = "DELETE FROM produits WHERE id_produit = :id";
    $request = $pdo->prepare($sql);
    $request->execute([':id' => $id]);
}


// //////////////  fonction pour modifier un Produit  //////////////

function updateProduit(int $idProduit, int $category, string $name, string $couleur, string $detail, string $dateEntree, string $image, float $price, int $stock, string $promo): void
{
    $pdo = connexionBdd();

    $sql = "UPDATE produits SET category_id = :category_id, name = :name, couleur = :couleur, detail = :detail, date = :date, image = :image, price = :price, stock = :stock, promo = :promo WHERE id_produit = :id";

    $request = $pdo->prepare($sql);
    $request->execute(array(
        ':id' => $idProduit,
        ':category_id' => $category,
        ':name' => $name,
        ':couleur' => $couleur,
        ':detail' => $detail,
        ':date' => $dateEntree,
        ':image' => $image,
        ':price' => $price,
        ':stock' => $stock,
        ':promo' => $promo
    ));
}

// //////////  Fonction pour supprimer un produit/////////////

function deleteProduit(int $id): void
{
    $pdo = connexionBdd();

    $sql = "DELETE FROM produit WHERE id_produit = :id";
    $request = $pdo->prepare($sql);
    $request->execute([':id' => $id]);
}

////////////////// fonction pour récupérer tous les produits/////////////////////
function allProduits(): array
{

    $pdo = connexionBdd();
    $sql = "SELECT produits.* , categories.name as genre
    FROM produits
    LEFT JOIN categories ON produits.category_id = categories.id_category";
    $request = $pdo->query($sql);
    $result = $request->fetchAll();
    return $result;
}

// fonction pour recuperer les 15 dernieres annonces


function recupererPromo(): array
{


    $pdo = connexionBdd();
    $sql = "SELECT * FROM produits
    WHERE promo = 'oui'
    ORDER BY id_produit DESC
    LIMIT 6
    ";
    $request = $pdo->query($sql);
    $result = $request->fetchAll();
    return $result;
}

// //////////////// fonction pour trier les produits les plus recents  ////////////////////////

function produitByDate(){
    $pdo = connexionBdd();
    $sql = "SELECT * FROM produits ORDER BY date DESC LIMIT 6";
    $request = $pdo->query($sql);
    $result = $request->fetchAll();
    return $result;
}


function estConnecte() {
    if(isset($_SESSION['users'])) { // si je récupère un indice 'users' dans la superglobale $_SESSION, cela signifie qu'un utilisateur est connecté
        return true;
    }else{ // sinon personne n'est connecté
        return false;
    }
}

// 3- création d'une fonction pour vérifier qu'un membre connecté est admin
////////////////////////////
    function estAdmin() {
        if (estConnecte() && $_SESSION['users']['Role'] == 1) { // je vérifie que l'utilisateur est connecté et que son statut correspond à 1 dans la BDD
            return true; // si c'est le cas, il est administrateur
        }else {
            return false; // sinon, c'est un utilisateur lambda ou la personne n'est pas connectée.
        }
    }
    ////////////////////////////////////////////////// PANIER /////////////////////////////////

// calculerMontantTotal() pour calculer le montant total du panier en additionnant les prix de chaque produit.
function calculerMontantTotal(array $tab): int
{
    $montant_total = 0;

    foreach ($tab as $key) {
        $montant_total += $key['price'] * $key['quantity'];
    }

    return $montant_total;
}

// ///////  Une fonction pour la création des clés étrangères /////

//  $tableF : table où on va créer la clé étrangère
//  $tableP : table à partir de laquelle on récupère la clé primaire
// $foreign : le nom de la clé étrangère
//  $primary : le nom de la clé primaire

 function foreignKey(string $tableF, string $foreign, string $tableP, string $primary)
 {

     $pdo = connexionBdd();

    $sql = "ALTER TABLE $tableF ADD CONSTRAINT FOREIGN KEY ($foreign) REFERENCES $tableP ($primary)";

    $request = $pdo->exec($sql);
 }