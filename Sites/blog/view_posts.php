<?php
require 'lib/requires.php';

if(isset($_GET['id'])){
  $id = (int) $_GET['id'];
  $select = $db->prepare("SELECT * FROM posts WHERE id = :id");
  $select->execute(array(
    'id' => $id
  ));
  $results = $select->fetchAll();
  if($results == null){
    $Session->setFlash("Il y a aucun billet avec cette ID", "warning", "Le billet n'existe pas ou n'existe plus")->redirect(WEBROOT);
  }

  $comments = $db->prepare("SELECT * FROM comments WHERE posts_id = :id");
  $comments->execute(array('id' => $id));

  $c = $comments->fetchAll();
  if($c == null){
    $empty_comments = "Il y a aucun commentaire sur ce billet";
  }
}

if(!empty($_POST)){
  $valid = true;

  if($_POST['username'] != $_SESSION['Auth']->username){
    $errors['username'] = "Le nom d'utilisateur est incorrect"; $valid = false;
  }elseif (empty($_POST['username'])){
    $errors['username'] = "Le nom d'utilisateur ne doit pas être vide"; $valid = false;
  }
  if(empty($_POST['content'])){
    $errors['content'] = "Veuillez écrire un commentaire"; $valid = false;
  }

  if($valid){
    $username = $_POST['username'];
    $content = $_POST['content'];
    $posts_id = (int) $_POST['posts_id'];
    $req = $db->prepare("INSERT INTO comments (username, content, posts_id) VALUES(:username, :content, :posts_id)");
    $req->execute(array(
      'username' => $username,
      'content' => $content,
      'posts_id' => $posts_id
    ));
    $Session->setFlash("Félicitation votre commentaire a bien été enregistré", "success", "Votre commentaire bien a été créé")->redirect(WEBROOT);
  }
}
require 'inc/header.php';
?>

  <div class="container">
    <?php echo $Session->flash(); ?>
    <?php if(isset($_SESSION['Auth'])) : ?>

      <?php if($_SESSION['Auth']->role_id == 1): ?>
        <?php foreach ($results as $datas): ?>
          <a href="<?= WEBROOT; ?>admin/edit_posts.php?id=<?= $datas->id; ?>" class="btn btn-warning">Editer</a>
          <a href="<?= WEBROOT; ?>admin/delete?id=<?= $datas->id; ?>" class="btn btn-danger">Delete</a>
        <?php endforeach; ?>
      <?php else: ?>
        <?php foreach ($results as $d): ?>
          <?php if($_SESSION['Auth']->username == $d->username): ?>
            <a href="<?= WEBROOT ?>edit_posts.php?id=<?= $d->id; ?>" class="btn btn-warning">Editer</a>
          <?php endif; ?>
        <?php endforeach; ?>
        <?php endif; ?>
    <?php endif; ?>
    <?php foreach($results as $datas): ?>
      <article class="posts">
        <h3><?= $datas->name; ?> :: <?= $datas->date; ?></h3>
        <p>
          <?= $datas->content; ?>
        </p>
        <button type="button" class="btn btn-info">Posté par :: <?= $datas->username; ?></button>
      </article>
    <?php endforeach; ?>
    <h2>Les commentaires liés à ce billet</h2>
    <?php if(isset($empty_comments)): ?>
      <?= $empty_comments; ?>
    <?php endif; ?>
    <?php foreach($c as $c): ?>
      <h4><strong><?= $c->username; ?></strong> à écrit  à <?= $c->date; ?>:</h4>
      <p>
        <?= $c->content; ?>
      </p>
    <?php endforeach; ?>
    <?php if(isset($_SESSION['Auth'])): ?>
    <h3>Poster un commentaire</h3>
      <form method="post">
        <div class="input">
          <input type="hidden" name="username" value="<?= isset($_SESSION['Auth']->username) ? $_SESSION['Auth']->username : ''?>">
        </div>
        <div class="input">
          <input type="hidden" name="posts_id" value="<?= isset($_GET['id']) ? $_GET['id'] : '' ?>">
        </div>
        <div class="input">
          <textarea name="content" rows="8" cols="80" placeholder="Votre commentaire" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
      </form>
    <?php endif; ?>
  </div>
<?php
require 'inc/footer.php';
?>
