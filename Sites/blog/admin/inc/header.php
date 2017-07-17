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

    <title>Administration</title>

    <!-- Bootstrap core CSS -->
    <link href='<?= WEBROOT; ?>assets/css/app.css' rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src='<?= WEBROOT; ?>js/ie-emulation-modes-warning.js'></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
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
          <a class="navbar-brand" href="<?= WEBROOT; ?>admin/">Blog</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
          <?php if(isset($_SESSION['Auth'])): $user = $_SESSION; ?>
            <li class="active"><a href='<?= WEBROOT; ?>admin/'>Home</a></li>
            <li><a href="<?= WEBROOT; ?>">Accueil du site</a></li>
            <li><a href='<?= WEBROOT; ?>members.php'>Liste des membres</a></li>
            <?php foreach ($user as $u): ?>
            <li><a href='<?= WEBROOT; ?>account.php?id=<?php echo $u->id; ?>'>Utilisateur : <?php echo $u->username; ?></a></li>
            <?php endforeach; ?>
            <li><a href='<?= WEBROOT; ?>logout.php'>Se déconnecter</a></li>
            <?php else: ?>
            <li><a href='<?= WEBROOT; ?>index.php' class="active">Home</a></li>
            <li><a href='<?= WEBROOT; ?>login.php'>Se connecter</a></li>
            <?php endif; ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
