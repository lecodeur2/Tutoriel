<?php
require 'lib/requires.php';

$select = $db->prepare("SELECT * FROM posts");
$select->execute();

$results = $select->fetchAll();

require 'inc/header.php';

?>

  <div class="container">
    <?php echo $Session->flash(); ?>
    <?php if(isset($_SESSION['Auth'])) : ?>

      <?php if($_SESSION['Auth']->role_id == 1): ?>
        <a href="<?= WEBROOT ?>edit_posts.php" class="btn btn-primary">Ajouter un nouveau billet</a>
      <?php else: ?>
      <?php endif; ?>
    <?php endif; ?>
    <?php foreach($results as $datas): ?>
      <article class="posts">
        <h3><?= $datas->name; ?> :: <?= $datas->date; ?></h3>
        <p>
          <?= substr($datas->content, 0, 500); ?>
        </p>
        <a href="<?= WEBROOT; ?>view_posts.php?id=<?= $datas->id; ?>" class="btn btn-secondary">Lire la suite</a>
        <button type="button" class="btn btn-info">Posté par :: <?= $datas->username; ?></button>
      </article>
    <?php endforeach; ?>
  </div>

<?php
require 'inc/footer.php';
?>
