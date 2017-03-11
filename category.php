<?php
$filename = "lib/config.php";
require "lib/form.class.php";
$form = new form();

if(file_exists($filename)){
	require $filename;
}else{
	echo "Le fichier est manquant";
	exit();
}


$select = $db->query("SELECT news.id, news.content, news.category_id, news.name FROM news RIGHT JOIN categories ON news.category_id=categories.id");
$categories = $select->fetch();

if(isset($_GET['id'])){
	$id = $db->quote($_GET['id']); //On sécurise l'entrée  GET pour se prémurir des injections SQL

	$select = $db->query("SELECT categories.name, categories.slug, categories.id , news.name, news.content FROM categories INNER JOIN news ON categories.id = (news.category_id) WHERE categories.id=$id");


	if($select->rowCount() == 0){ // Si aucune catégorie n'existe on redirige l'utilisateur
		header('Location:index.php');
		die();
	}

	$categories = $select->fetchAll();
}

//var_dump($news);
?>
<html>
	<head>
		<title>Titre</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/app.css">
	</head>
	<body>
		<header id="header">
			<nav class="nav right">
			<?php foreach($categories as $category): ?>
				<li>
					<a href="category.php?id=<?= $category['id']; ?>"><?= $category['name']; ?></a>
				</li>
			<?php endforeach; ?>
			</nav>
		</header>
		<section id="news">
			<h1>Liste des news</h1>
		<?php foreach($categories as $billet): ?>
			<div class="post">
				<h3><?= $billet['name']; ?></h3>
				<p>
					<?= $billet['content']; ?>
				</p>
				<a href="view.php?id=<?= $billet['id']; ?>">Voir la suite</a>
			</div>
		<?php endforeach; ?>
		</section>
	</body>
</html>
