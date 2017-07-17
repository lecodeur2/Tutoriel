<?php
$title = "liste des membres";
require "lib/requires.php";

$select = $db->query("SELECT roles.name AS role_name, users.username AS user_name, users.id AS user_id , users.email AS user_email, users.facebook AS user_facebook, users.twitter AS user_twitter, users.url AS user_url FROM roles LEFT JOIN users ON users.role_id = (roles.id)");
$users = $select->fetchAll();

require "inc/header.php";
?>

    <div class="container">
      <?php if(isset($_SESSION['Auth'])) : ?>

        <?php if($_SESSION['Auth']->role_id == 1): ?>
          <a href="<?= WEBROOT ?>admin/edit_users.php" class="btn btn-primary">Ajouter un nouvel utilisateur</a>
        <?php else: ?>
        <?php endif; ?>
      <?php endif; ?>
    <h1>Liste des utilisateurs</h1>
    <table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom d'utilisateur</th>
            <th>Email</th>
            <th>Facebook</th>
            <th>Twitter</th>
            <th>Rôle utilisateur</th>
            <?php if(isset($_SESSION['Auth'])): ?>
              <?php if($_SESSION['Auth']->role_id == 1): ?>
            <th>Action</th>
              <?php endif; ?>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $datas): ?>
        <tr>
            <td><?= $datas->user_id; ?></td>
            <td><a href="profil.php?id=<?= $datas->user_id; ?>"><?= $datas->user_name; ?></a></td>
            <td><?= $datas->user_email; ?></td>
            <td><?= $datas->user_facebook; ?></td>
            <td><?= $datas->user_twitter; ?></td>
            <td><?= $datas->role_name; ?></td>
            <?php if(isset($_SESSION['Auth'])): ?>
              <?php if($_SESSION['Auth']->role_id == 1): ?>
              <td><a href="<?= WEBROOT; ?>admin/profil_delete?id=<?= $datas->user_id; ?>" class="btn btn-danger">Delete</a> <a href="<?= WEBROOT; ?>admin/edit_users.php?id=<?= $datas->user_id; ?>" class="btn btn-warning">Edit</a></td>
              <?php endif; ?>
            <?php endif; ?>
        </tr>
    <?php endforeach; ?>
    </tbody>
    </table>
    </div><!-- /.container -->

<?php

require "inc/footer.php";

?>
