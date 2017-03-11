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

$select = $db->query("SELECT * FROM news");
$news = $select->fetchAll();

$categories = $db->query("SELECT * FROM categories");
$category = $categories->fetchAll();


// if(isset($_GET['id'])){
// 	$id = $db->quote($_GET['id']);
// 	$select = $db->query("SELECT * FROM news WHERE id=$id");
// 	if($select->rowCount() == 0){
// 		header('Location:index.php');
// 	}
// 		$news = $select->fetchAll();
// }

// if(isset($_GET['id'])){
// 	$id = $_GET['id'];
// 	$select = $db->query("SELECT * FROM categories WHERE id=$id");
// 	if($select->rowCount() == 0){ // Si aucune catégorie n'existe on redirige l'utilisateur
// 		header('Location:index.php');
// 	}
// 	$categories = $select->fetchAll();
// }

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
			<?php foreach($category as $category): ?>
				<li>
					<a href="category.php?id=<?= $category['id']; ?>"><?= $category['name']; ?></a>
				</li>
			<?php endforeach; ?>
			</nav>
		</header>
		<section id="news">
			<h1>Liste des news</h1>
		<?php foreach($news as $billet): ?>
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
