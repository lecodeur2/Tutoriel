<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <title><?php echo isset($title) ? $title : 'blog'; ?></title>

    <!-- Bootstrap core CSS -->
    <link href='<?php echo WEBROOT; ?>assets/css/app.css' rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src='<?= WEBROOT; ?>js/ie-emulation-modes-warning.js'></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Latest compiled and minified JavaScript -->
    <script type="text/javascript" src="<?= WEBROOT; ?>assets/js/bootstrap.min.js"></script>
  </head>
  <body>

    <nav class="navbar navbar-inverse navbar-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Blog</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="<?= WEBROOT; ?>">Home</a></li>
            <li><a href="<?= WEBROOT; ?>posts.php">Les billets</a></li>
            <li><a href="<?= WEBROOT; ?>members.php">Liste des membres</a></li>
          </ul>
          <ul class="nav navbar-nav">
          <?php if(isset($_SESSION['Auth'])): ?>
              <li><a href="<?= WEBROOT; ?>account.php">Account : <?= $_SESSION['Auth']->username; ?></a></li>
              <?php if(isset($_SESSION['Auth'])): ?>
                <?php if($_SESSION['Auth']->role_id == 1): ?>
                  <li><a href="<?= WEBROOT ?>admin/">Administration</a></li>
                <?php endif; ?>
              <?php endif; ?>
              <li><a href="<?= WEBROOT; ?>logout.php">Se deconnecter</a></li>
            <?php else: ?>
              <li><a href="<?= WEBROOT; ?>login.php">Se connecter</a></li>
              <li><a href="<?= WEBROOT; ?>register.php">S'inscrire</a></li>
          <?php endif; ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
