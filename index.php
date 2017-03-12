<?php
require "lib/requires.php";


$select = $db->query('SELECT news.id, news.name, news.content, categories.name AS category_name FROM news INNER JOIN categories ON news.category_id = (categories.id) ORDER BY news.id DESC');
$news = $select->fetchAll();

$categories = $db->query("SELECT * FROM categories");
$category = $categories->fetchAll();
?>
<html>
	<head>
		<title>Titre</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="assets/css/app.css">
	</head>
	<body>
		<?= $session->flash(); ?>
		<header id="header">
			<nav class="nav right">
			<?php foreach($category as $category): ?>
				<li>
					<a href="category.php?id=<?= $category->id; ?>"><?= $category->name; ?></a>
				</li>
			<?php endforeach; ?>
			</nav>
		</header>
		<section id="news">
			<h1>Liste des news</h1>
		<?php foreach($news as $billet): ?>
			<div class="post">
				<h3><?= $billet->name; ?>&nbsp;<small style="font-size:11px;font-weight:normal;">Catégorie : <?= $billet->category_name; ?></small></h3>
				<p>
					<?= $billet->content; ?>
				</p>
				<a href="view.php?id=<?= $billet->id; ?>">Voir la suite</a>
			</div>
		<?php endforeach; ?>
		</section>

		<script src="assets/js/jquery-3.1.1.min.js"></script>
	</body>
</html>
