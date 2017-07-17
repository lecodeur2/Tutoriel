<?php
require '../lib/requires.php';

if(!isset($_SESSION['Auth'])){
  $Session->setFlash("Vous devez être connecté", "warning", "Vous n'êtes pas connecté")->redirect(WEBROOT .'login.php');
}elseif (isset($_SESSION['Auth'])){
  if($_SESSION['Auth']->role_id == 2){
    $Session->setFlash("Vous n'avez pas les permissions pour accéder à cette partie du site", "danger", "Vous n'avez pas les droits néccessaires")->redirect(WEBROOT);
  }
}

$select = $db->prepare("SELECT * FROM posts");
$select->execute();

$results = $select->fetchAll();

require 'inc/header.php';

?>

    <div class="container">
      <?php if(isset($_SESSION['Auth'])) : ?>

        <?php if($_SESSION['Auth']->role_id == 1): ?>
          <a href="<?= WEBROOT ?>admin/edit_users.php" class="btn btn-primary">Ajouter un nouvel utilisateur</a>
        <?php else: ?>
        <?php endif; ?>
      <?php endif; ?>
    <h1>Liste des billets</h1>
    <table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom du billet</th>
            <th>Slug du billet</th>
            <th>Auteur du billet</th>
            <th>Date</th>
            <?php if(isset($_SESSION['Auth'])): ?>
              <?php if($_SESSION['Auth']->role_id == 1): ?>
            <th>Action</th>
              <?php endif; ?>
            <?php endif; ?>
        </tr>
    </thead>
      <tbody>
    <?php foreach ($results as $d): ?>
        <tr>
            <td><?= $d->id; ?></td>
            <td><?= $d->name;?></td>
            <td><?= $d->slug; ?></td>
            <td><?= $d->username; ?></td>
            <td><?= $d->date; ?></td>
            <?php if(isset($_SESSION['Auth'])): ?>
              <?php if($_SESSION['Auth']->role_id == 1): ?>
              <td><a href="<?= WEBROOT; ?>delete?id=<?= $d->id; ?>">Supprimer</a> <a href="<?= WEBROOT; ?>admin/edit_posts.php?id=<?= $d->id; ?>">Editer</a></td>
              <?php endif; ?>
            <?php endif; ?>
        </tr>
    <?php endforeach; ?>
      </tbody>
    </table>
    </div><!-- /.container -->

<?php

require 'inc/footer.php';
?>
