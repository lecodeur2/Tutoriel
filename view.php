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

if(isset($_GET['id'])){
	$id = (int) $_GET['id'];	

	$select = $db->prepare("SELECT * FROM news WHERE id = :id");
	$select->bindParam(':id', $id, PDO::PARAM_INT);
	$select->execute();
	if($select->rowCount() == 0){
		header('Location:index.php');
	}

	$news = $select->fetchAll();
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
				<li><a href="">Lien 1</a></li>
				<li><a href="">Lien 2</a></li>
				<li><a href="">Lien 3</a></li>
				<li><a href="">Lien 4</a></li>
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
			</div>
		<?php endforeach; ?>
		</section>
	</body>
</html>