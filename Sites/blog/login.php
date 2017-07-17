<?php
$title = 'Se connecter';
require 'lib/requires.php';

if(isset($_SESSION['Auth'])){
    $Session->setFlash("Vous êtes déjà connecté", "warning","Information")->redirect("index.php");
}else{
  if(!empty($_POST) && !empty($_POST['username']) && !empty($_POST['passwd'])){
      extract($_POST);
      $select = $db->prepare("SELECT * FROM users WHERE (username = :username OR email = :username) AND confirmed_at IS NOT NULL");
      $select->execute(array(
          'username' => $username,
      ));
      $user = $select->fetch();
      var_dump($user);
      if($user == null){
          $Session->setFlash("Identifiant ou mot de passe incorrecte ou vous n'avez pas confirmer votre compte", "warning", "Attention !")->redirect("login.php");
      }elseif(password_verify($_POST['passwd'], $user->passwd)){
          $_SESSION['Auth'] = $user;
          $Session->setFlash("Vous êtes maintenant connecté", "success", "Success")->redirect("index.php");
      }
  }
}

require 'inc/header.php';

?>

  <div class="container">
      <?php echo $Session->flash(); ?>
      <h1>Se connecter</h1>
      <?php if(isset($errors)): ?>
      <div class="alert alert-warning" role="alert">
      <h3>Veuillez corriger les erreurs</h3>
        <?php foreach($errors as $e): ?>
       <strong>Erreur :</strong> <?php echo $e; ?> <br />

        <?php endforeach; ?>
      </div>
      <?php endif; ?>
      <form method="post">
          <div class="input">
              <input type="text" name="username" class="form-control" placeholder="Votre nom d'utilisateur ou adresse email *">
          </div>
          <div class="input">
            <input type="password" name="passwd" class="form-control" placeholder="Votre mot de passe">
          </div>
          <div class="input">
              <button type="submit" class="btn btn-primary">M'inscrire</button>
          </div>
      </form>
  </div><!-- /.container -->

<?php
require 'inc/footer.php';
?>
