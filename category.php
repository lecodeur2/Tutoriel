<?php
require "lib/requires.php";


$select = $db->query("SELECT news.id, news.content, news.category_id, news.name, categories.name FROM news INNER JOIN categories ON news.category_id=categories.id");
$categories = $select->fetch();

if(isset($_GET['id'])){
	$id = $db->quote($_GET['id']); //On sécurise l'entrée  GET pour se prémurir des injections SQL
    $id = (int) $_GET['id'];
 
	$select = $db->query("SELECT categories.name, categories.slug, categories.id , news.name, news.content FROM categories INNER JOIN news ON categories.id = (news.category_id) WHERE categories.id=$id");


	if($select->rowCount() == 0){ // Si aucune catégorie n'existe on redirige l'utilisateur
		header('Location:index.php');
		die();
	}

	$categories = $select->fetchAll();
}

$category = $db->query("SELECT id, name FROM categories");
$category = $category->fetchAll();

?>
<html>
	<head>
		<?php foreach($categories as $c): ?>
		<title><?= $title = isset($c->name)? $c->name : 'Tutoriel'; ?></title>
		<?php endforeach; ?>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/app.css">
	</head>
	<body>
		<header id="header">
			<nav class="nav right">
			<?php foreach($category as $c): ?>
				<li>
					<a href="category.php?id=<?= $c->id; ?>"><?= $c->name; ?></a>
				</li>
			<?php endforeach; ?>
			</nav>
		</header>
		<section id="news">
			<h1>Liste des news</h1>
		<?php foreach($categories as $billet): ?>
			<div class="post">
				<h3><?= $billet->name; ?></h3>
				<p>
					<?= $billet->content; ?>
				</p>
				<a href="view.php?id=<?= $billet->id; ?>">Voir la suite</a>
			</div>
		<?php endforeach; ?>
		</section>
	</body>
</html>
