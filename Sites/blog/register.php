<?php
require 'lib/requires.php';

if(isset($_SESSION['Auth'])){
    $Session->setFlash("Vous êtes ne pouvez pas accéder à cette page alors que vous êtes connecté", "warning", "Information")->redirect("index.php");
}else{
  if(!empty($_POST)){
    extract($_POST);
    $errors = array();
    $valid = true;

    if(empty($_POST['username'])){
      $errors['username'] = "Vous n'avez pas entre votre nom d'utilisateur";
      $valid = false;
    }else{
      $req = $db->prepare("SELECT id FROM users WHERE username = :username");
      $req->execute(array("username" => $username));
      $user = $req->fetch();
      if($user){
        $errors['username'] = "Ce nom d'utilisateur est déjà utilisé";
      }
    }

    if(empty($email)){
      $errors['email'] = "Vous n'avez pas entrer d'adresse email";
      $valid = false;
    }else{
      $req = $db->prepare("SELECT id FROM users WHERE email = :email");
      $req->execute(array("email" => $email));
      $user = $req->fetch();
      if($user){
        $errors['email'] = "Cette adresse email est déjà utilisée";
        $valid = false;
      }
    }

    if(empty($_POST['passwd'])){
      $errors['passwd'] = "Vous n'avez pas entre votre mot de passe";
      $valid = false;
    }

    if(empty($_POST['passwd_confirm'])){
      $errors['passwd_confirm'] = "Vous n'avez pas confirmé votre mot de passe";
    }elseif($_POST['passwd_confirm'] != $_POST['passwd']){
      $errors['passwd_confirm'] = "Les deux mots de passes ne sont pas indentique";
    }

    if(!empty($_POST['facebook']) && !preg_match('/^(https?:\/\/)?(www\.)?facebook.com\/[a-zA-Z0-9(\.\?)?]/', $_POST['facebook'])){
      $errors['facebook'] = "L'url Facebook n'est pas valide";
      $valid = false;
    }

    if(!empty($_POST['url']) && !filter_var($_POST['url'], FILTER_VALIDATE_URL)){
      $errors['url'] = "L'adresse URL que vous avez entrez n'est pas valide";
      $valid = false;
    }

    if($valid){
      $passwd = password_hash($passwd, PASSWORD_BCRYPT);
      $req = $db->prepare("INSERT INTO users (username, email, passwd, facebook, url, confirmation_token) VALUES(:username, :email, :passwd, :facebook, :url, :confirmation_token)");
      $token = str_random(60);
      $req->execute(array(
        'username' => $username,
        'email' => $email,
        'passwd' => $passwd,
        'facebook' => $facebook,
        'url' => $url,
        'confirmation_token' => $token
      ));
      $user_id = $db->lastInsertId();
     mail($_POST['email'], 'Confirmation de votre compte', "Afin de valider votre compte merci de cliquer sur ce lien\n\nhttp://localhost/Blog/confirm.php?id=$user_id&token=$token");
      $Session->setFlash("votre compte a été créé avec succès, vous allez recevoir un email afin de valider votre compte", "success", "Success")->redirect('index.php');
    }
  }
}

require 'inc/header.php';

?>

<div class="container">
    <?php echo $Session->flash(); ?>
    <h2>S'inscire</h2>
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
            <input type="text" name="username" class="form-control" placeholder="Votre nom d'utilisateur *">
        </div>
        <div class="input">
          <input type="text" name="email" class="form-control" placeholder="Votre adresse email *">
        </div>
        <div class="input">
            <input type="text" name="passwd" class="form-control" placeholder="Votre mot de passe *">
        </div>
        <div class="input">
            <input type="text" name="passwd_confirm" class="form-control" placeholder="Confirmer votre mot de passe *">
        </div>
        <div class="input">
          <input ty="text" name="facebook" class="form-control" placeholder="Votre Facebook (exemple https://www.facebook.com/Graphiweb)">
        </div>
        <div class="input">
          <input type="text" name="url" class="form-control" placeholder="Votre site web (https ou http suivis de l'adresse'">
        </div>
        <div class="input">
            <button type="submit" class="btn btn-primary">M'inscrire</button>
        </div>
    </form>
</div><!-- /.container -->

<?php
require 'inc/footer.php';
?>
