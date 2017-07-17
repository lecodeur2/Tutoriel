<?php
require 'lib/requires.php';

if(!isset($_SESSION['Auth'])){
  $Session->setFlash("Vous devez être connecté", "warning", "Vous n'êtes pas connecté")->redirect(WEBROOT .'login.php');
}else{
  if(isset($_POST['mail'])){
    $valid = true;
    $errors = array();

    if(empty($_POST['email'])){
      $errors['email'] = "Vous devez entrer une adresse email"; $valid = false;
    }elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
      $errors['email'] = "Votre adresse email n'a pas un format valide"; $valid = false;
    }elseif($_POST['email_confirm'] != $_POST['email']){
      $errors['email'] = "Les deux adresses emails ne correspondant pas"; $valid = false;
    }

    if($valid){
      $email = htmlentities($_POST['email']);
      $id = (int) $_SESSION['Auth']->id;
      $req = $db->prepare("UPDATE users SET email = :email WHERE id = :id");
      $req->execute(array(
        'email' => $email,
        'id' => $id
      ));
      $Session->setFlash("Votre adresse email a bien été modifiée", "success", "Adresse email changée")->redirect(WEBROOT .'account.php');
    }
  }

  if(isset($_POST['password'])){
    $valid = true;
    $errors = array();

    if(empty($_POST['passwd'])){
      $errors['passwd'] = "Vous devez choisir un nouveau mot de passe"; $valid = false;
    }elseif($_POST['passwd_confirm'] != $_POST['passwd']){
      $errors['passwd_confirm'] = "Les deux mots de passes ne correspondant pas"; $valid = false;
    }

    if($valid){
      $passwd = password_hash($_POST['passwd'], PASSWORD_BCRYPT);
      $id = (int) $_SESSION['Auth']->id;
      $req = $db->prepare("UPDATE users SET passwd = :passwd WHERE id = :id");
      $req->execute(array(
        'passwd' => $passwd,
        'id' => $id
      ));
      $Session->setFlash("Votre mot de apsse a bien été modifiée", "success", "Mot de passe changé")->redirect(WEBROOT .'account.php');
    }
  }

  if(isset($_POST['infos'])){
    $valid = true;
    $errors = array();

    if($valid){
      $twitter = htmlentities($_POST['twitter']);
      $facebook = htmlentities($_POST['facebook']);
      $biographie = htmlentities($_POST['biographie']);
      $url = htmlentities($_POST['url']);
      $id = (int) $_SESSION['Auth']->id;
      $req = $db->prepare("UPDATE users SET twitter = :twitter, facebook = :facebook, url = :url, biographie = :biographie WHERE id = :id");
      $req->execute(array(
        'twitter' => $twitter,
        'facebook' => $facebook,
        'url' => $url,
        'biographie' => $biographie,
        'id' => $id
      ));
      $Session->setFlash("Vos informations ont été mises à jours", "success", "Mise à jours des informations")->redirect(WEBROOT .'account.php');
    }
  }
}

require 'inc/header.php';

debug($_SESSION['Auth']);
if(isset($errors) && isset($_POST)){
  debug($_POST);
  debug($errors);
}

?>

    <div class="container">
      <?php echo $Session->flash(); ?>
      <form method="post">
        <fieldset>
          <legend>Modifier votre adresse email</legend>
          <div class="input">
            <input type="text" name="email" class="form-control" placeholder="Modifier votre adresse email">
          </div>
          <div class="input">
              <input type="text" name="email_confirm" class="form-control" placeholder="Confirm votre nouvelle adresses email">
          </div>
          <div class="input">
            <button type="submit" name="mail" class="btn btn-primary">Modifier votre email</button>
          </div>
        </fieldset><br>
        <fieldset>
          <legend>Modifier votre mot de passe</legend>
          <div class="input">
            <input type="password" name="passwd" class="form-control" placeholder="Votre nouveau mot de passe">
          </div>
          <div class="input">
            <input type="password" name="passwd_confirm" class="form-control" placeholder="Confirmer votre nouveau mot de passe">
          </div>
          <div class="input">
            <button type="submit" name="password" class="btn btn-primary">Modifier votre mot de passe</button>
          </div>
        </fieldset><br>
        <fieldset>
          <legend>Informations complémentaires</legend>
          <div class="input">
            <input type="text" name="twitter" class="form-control" placeholder="Votre Twitter">
          </div>
          <div class="input">
            <input type="text" name="facebook" class="form-control" placeholder="Votre Facebook">
          </div>
          <div class="input">
            <input type="text" name="url" class="form-control" placeholder="Votre Site web">
          </div>
          <div class="input">
            <textarea name="biographie" rows="8" cols="80" class="form-control" placeholder="Inscrivez une courte biographie"></textarea>
          </div>
          <div class="input">
            <button type="submit" name="infos" class="btn btn-primary">Modifier vos informations</button>
          </div>
        </fieldset>
      </form>
    </div>

<?php
require 'inc/footer.php';
?>
