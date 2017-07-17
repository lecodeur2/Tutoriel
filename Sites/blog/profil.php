<?php

require 'lib/requires.php';

if(isset($_GET['id'])){
  $id = (int) $_GET['id'];
  $select = $db->prepare("SELECT roles.name AS role_name, users.username AS user_name, users.id AS user_id , users.email AS user_email, users.facebook AS user_facebook, users.twitter AS user_twitter, users.url AS user_url, users.biographie AS user_biographie FROM roles LEFT JOIN users ON users.role_id = (roles.id) WHERE users.id = :id");
  $select->execute(array('id' => $id));
  $results = $select->fetchAll();
}

require 'inc/header.php';

?>

    <div class="container">
      <table class="table table-striped">
      <thead>
          <tr>
              <th>ID</th>
              <th>Nom d'utilisateur</th>
              <th>Email</th>
              <th>Facebook</th>
              <th>Twitter</th>
          </tr>
      </thead>
      <tbody>
          <tr>
              <?php foreach ($results as $d): ?>
                <td><?= $d->user_id; ?></td>
                <td><?= $d->user_name; ?></td>
                <td><?= $d->user_email; ?></td>
                <td><?= $d->user_facebook; ?></td>
                <td><?= $d->user_twitter; ?></td>
              <?php endforeach ?>
          </tr>
      </tbody>
      </table>
      <?php foreach ($results as $datas): ?>
      <h3>Profil <?= $datas->user_name; ?> <button type="button" name="button" class="btn btn-primary"><?= $datas->role_name; ?></button></h3>
      <h5>Biographie</h5>
      <p>
        <?= $datas->user_biographie; ?>
      </p>

      <?php endforeach; ?>
    </div>

<?php

require 'inc/footer.php';

?>
