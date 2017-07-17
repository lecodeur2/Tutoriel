<?php
require '../lib/requires.php';

if(!isset($_SESSION['Auth'])){ // Si aucune session n'est défini on redirige
  $Session->setFlash("Vous devez être connecté pour accéder à cette page", "warning", "Accès refusé")->redirect(WEBROOT .'login.php');
}elseif (isset($_SESSION['Auth'])){ // Si une session est défini on vérifier après coup si l'utilisateur est un administrateur
  if($_SESSION['Auth']->role_id != 1){
    $Session->setFlash("Vous n'avez pas les permissions pour accéder à cette partie du site", "danger", "Accès refusé")->redirect(WEBROOT);
  }elseif (!empty($_POST)){ // Si le tableau poste n'est pas vide
    $valid = true;
    $errors = array();

    if(empty($_POST['username'])){ // Si username est vide on refuse l'execution du script
      $errors['username'] = "<strong> Nom d'utilisateur : </strong> Le nom d'utilisateur ne peut pas être vide"; $valid = false;
    }

    if(empty($_POST['passwd'])){
      $errors['passwd'] = "<strong> Mot de passe : </strong> Le mot de passe ne peut pas être vide"; $valid = false;
    }

    if(empty($_POST['role_id'])){
      $errors['role_id'] = "<strong> Groupe de l'utilisateur : </strong> Le groupe de l'utilisateur ne peut pas être vide"; $valid = false;
    }

    if($valid){ // Si $valid est true alors on commence le traitement
      $username = htmlentities($_POST['username']);
      $passwd = password_hash($_POST['passwd'], PASSWORD_BCRYPT);
      $role_id = (int) $_POST['role_id'];
      if(isset($_GET['id'])){
        $id = (int) $_GET['id'];
        $req = $db->prepare("UPDATE users SET username = :username, passwd = :passwd, role_id = :role_id WHERE id = :id");
        $req->execute(array(
          'username' => $username,
          'passwd' => $passwd,
          'role_id' => $role_id,
          'id' => $id
        ));
        $Session->setFlash("Félicitation votre utilisateur a bien été modifié", "success", "Compte modifié")->redirect(WEBROOT);
      }else{
        $req = $db->prepare("INSERT INTO users (username, email, passwd, twitter, facebook, url, biographie, confirmation_token, confirmed_at, role_id) VALUES(:username, :email, :passwd, null, null, null, null, null, null, :role_id)");
        $req->execute(array(
          'username' => $username,
          'email' => $email,
          'passwd' => $passwd,
          'role_id' => $role_id
        ));
        $Session->setFlash("Félicitation votre utilisateur a bien été enregistré", "success", "Compte créé")->redirect(WEBROOT);
      }
    }
  }
}

if(isset($_GET['id'])){
  $id = (int) $_GET['id'];
  $select = $db->prepare("SELECT * FROM users WHERE id = :id");
  $select->execute(array('id' => $id));

  $d = $select->fetchAll();
}

require 'inc/header.php';

if(isset($_POST) && isset($errors)){
  debug($_POST);
  debug($errors);
}
?>

  <div class="container">
    <?php echo $Session->flash(); ?>
    <?php if(isset($_GET['id'])): ?>
      <?php foreach ($d as $d): ?>
        <h3>Modifier <?= $d->usersname; ?></h3>
      <?php endforeach; ?>
    <?php else: ?>
      <h3>Ajouter un nouveau billet</h3>
    <?php endif; ?>
    <?php if(isset($errors)): ?>
    <div class="alert alert-warning" role="alert">
    <h3>Veuillez corriger les erreurs</h3>
      <?php foreach($errors as $e): ?>
        <?php echo $e; ?> <br />

      <?php endforeach; ?>
    </div>
    <?php endif; ?>
    <form method="post">
      <div class="form-groupe input">
        <input type="text" name="username" placeholder="Nom d'utilisateur" class="form-control" value="<?= isset($d->username) ? $d->username : '' ?>">
      </div>
      <div class="form-groupe input">
        <input type="text" name="passwd" placeholder="Mot de passe de l'utilisateur" class="form-control" value="<?= isset($d->passwd) ? $d->passwd : '' ?>">
      </div>
      <div class="input">
        <input type="text" name="email" placeholder="Email de l'utilisateur" class="form-control" value="<?= isset($d->email) ? $d->email : ''?>">
      </div>
      <div class="input">
        <input type="checkbox" name="role_id" value="1" id="primary"> Administrateur
        <input type="checkbox" name="role_id" value="2" id="primary"> Members
        <input type="checkbox" name="role_id" value="3" id="primary"> Moderator
      </div>
      <div class="form-groupe input">
        <button type="submit" class="btn btn-primary">Envoyer</button>
      </div>
    </form>
  </div>

<?php
require 'inc/footer.php';
?>
