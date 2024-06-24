<?php
require_once "../inc/functions.inc.php";

$metaDescription ="Gestion des utilisateure ";
$title = "Users";
require_once "../inc/header.inc.php";







?>

<main class="" style="background:rosybrown  ;"> 
<div class="d-flex flex-column m-5  table-responsive">
    <h1 class="text-center fw-bolder mb-5">Liste des utilisateurs</h1>
    <table class="table table-rosybrown table-bordered  mt-5">
        <thead>
            <tr>
                <th>ID</th>
                <th>Prenom</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Civility</th>
                <th>Adresse</th>
                <th>ZipCode</th>
                <th>Country</th>
                <th>Role</th>
                <th>Supprimer</th>
                <th>Modifier</th>
            </tr>
        </thead>
        <tbody>

        <?php
        $users = allUsers();

        foreach($users as $user){

        
        ?>
            <tr>
                <td><?=$user['id_user']?></td>
                <td><?=ucfirst($user['prenom'])?></td>
                <td><?=ucfirst($user['nom'])?></td>
                <td><?=$user['email']?></td>
                <td><?=$user['civility']?></td>
                <td><?=$user['adresse']?></td>
                <td><?=$user['zipCode']?></td>
                <td><?=ucfirst($user['country'])?></td>
                <td><?=$user['role']?></td>
                <td class="text-center">
                    <a href="dashboard.php?users.php&action=delete&id_user=<?= $user['id_user']?>"><i class="bi bi-trash3-fill text-dark"></i></a>
                </td>
                <td class="text-center">
                    <a href="dashboard.php?users.php&action=update&id_user=<?= $user['id_user']?>" class="btn btn-dark"><?=($user['role']) == 'ROLE_ADMIN' ? 'Rôle user' : 'Rôle admin'?>
                </td>
            </tr>

            <?php
            }
            ?>
        </tbody>

    </table>
</div>


</main>

<?php
require_once "../inc/footer.inc.php"
?>