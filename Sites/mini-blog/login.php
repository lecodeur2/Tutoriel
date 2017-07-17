<?php
require "lib/requires.php";
// Traitement des différentes tâcheckdnses

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
      if($user == null){
          $Session->setFlash("Identifiant ou mot de passe incorrecte ou vous n'avez pas confirmer votre compte", "warning", "Attention !")->redirect("login.php");
      }elseif(password_verify($_POST['passwd'], $user->passwd)){
          $_SESSION['Auth'] = $user;
          $Session->setFlash("Vous êtes maintenant connecté", "success", "Success")->redirect("index.php");
      }
  }
}

require "inc/header.php";
debug($_POST);
if(isset($errors)){
  debug($errors);
}
 ?>

  <div class="container">
    <h1>Se connecter</h1>
    <form method="post">
      <div class="input">
        <input type="text" name="username" class="form-control" placeholder="Votre nom d'utilisateur ou votre adresse email">
      </div>
      <div class="input">
        <input type="password" name="passwd" class="form-control" placeholder="Votre mot de passe">
      </div>
      <div class="input">
        <button type="submit" name="login" class="btn btn-primary">Se connecter</button>
      </div>
    </form>
  </div>

 <?php
require "inc/footer.php";
 ?>
