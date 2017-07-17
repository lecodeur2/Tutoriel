<?php
require '../lib/requires.php';

if(!isset($_SESSION['Auth'])){
  $Session->setFlash("Vous devez être connecté pour accéder à cette page", "warning", "Vous n'êtes pas connecté")->redirect(WEBROOT);
}elseif (isset($_SESSION['Auth'])){
  if($_SESSION['Auth']->role_id == 2){
      $Session->setFlash("Vous n'avez pas les permissions pour accéder à cette partie du site", "danger", "Vous n'avez pas les droits néccessaires")->redirect(WEBROOT);
  }else{
    if(!empty($_POST)){
      $valid = true;

      if(empty($_POST['name'])){
        $errors['name'] = "Vous devez choisir le nom du billet"; $valid = false;
      }
      if(empty($_POST['slug'])){
        $errors['slug'] = "Vous devez choisir le slug du billet"; $valid = false;
      }

      if(empty($_POST['content'])){
        $errors['content'] = "Vous devez écrire le contenu du billet"; $valid = false;
      }
      if($valid){ // Si $valid = true on traite le formulaire
        extract($_POST);
        $id = (int) $_GET['id'];
        $name = htmlentities($name);
        $slug = htmlentities($slug);
        $username = htmlentities($username);
        $content =  htmlentities($content);
        if(isset($_GET['id'])){ // Modification dans l'entrée de la table poste
          $req = $db->prepare("UPDATE posts SET name = :name, slug = :slug, content = :content WHERE id = :id");
          $req->execute(array(
            'name' => $name,
            'slug' => $slug,
            'content' => $content,
            'id' => $id
          ));
          $Session->setFlash("Votre modification a bien été enregistrer", "success", "Modification effectuée")->redirect(WEBROOT);
        }else{ // Nouvelle entrée dans la table poste
          $req = $db->prepare("INSERT INTO posts (name, slug, username, content) VALUES(:name, :slug, :username, :content)");
          $req->execute(array(
            'name' => $name,
            'slug' => $slug,
            'username' => $username,
            'content' => $content
          ));
          $Session->setFlash("Félicitation votre billet a bien été enregistré", "success", "Votre bien a été créé")->redirect(WEBROOT);
        }
      }
    }
  }
}

if(isset($_GET['id'])){
  $id = (int) $_GET['id'];
  $select = $db->prepare("SELECT * FROM posts WHERE id = :id");
  $select->execute(array('id' => $id));

  $d = $select->fetch();
}

require 'inc/header.php';

?>

  <div class="container">
    <?php echo $Session->flash(); ?>
    <?php if(isset($_GET['id'])): ?>
      <h3>Modifier <?= $d->name; ?></h3>
    <?php else: ?>
      <h3>Ajouter un nouveau billet</h3>
    <?php endif; ?>
    <?php if(isset($errors)): ?>
    <div class="alert alert-warning" role="alert">
    <h3>Veuillez corriger les erreurs</h3>
      <?php foreach($errors as $e): ?>
     <strong>Erreur :</strong> <?php echo $e; ?> <br />

      <?php endforeach; ?>
    </div>
    <?php endif; ?>
    <form method="post">
      <div class="form-groupe input">
        <input type="text" name="name" placeholder="Nom du billet" class="form-control" value="<?= isset($d->name) ? $d->name : '' ?>">
      </div>
      <div class="form-groupe input">
        <input type="text" name="slug" placeholder="Slug du billet" class="form-control" value="<?= isset($d->slug) ? $d->slug : '' ?>">
      </div>
      <div class="form-groupe input">
        <textarea name="content" rows="8" cols="80" placeholder="Contenu du billet" class="form-control"><?= isset($d->content) ? $d->content : ''?></textarea>
      </div>
      <div class="form-groupe input">
        <button type="submit" class="btn btn-primary">Envoyer</button>
      </div>
    </form>
  </div>

<?php
require 'inc/footer.php';
?>
