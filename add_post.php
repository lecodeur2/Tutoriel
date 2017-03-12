<?php
require "lib/requires.php";

if(!empty($_POST)){
	extract($_POST);

	$valid = true;

	if(empty($name)){
		$error_name = "Erreur : ce champ est vide";
		$valid = false;
	}

	if(empty($content)){
		$error_content = "Erreur : ce champ est vide";
		$valid = false;
	}

	if($valid){

		if(isset($_GET['id'])){
			$id = (int) $_GET['id'];
			$select = $db->prepare("UPDATE news SET name = :name,  content = :content WHERE id=$id");
			$select->execute(array(
				'name' => $name,
				'content' => $content
			));
			$session->setFlash("Le post a bien été modifié", "success"); header('Location:index.php'); die(); 
		}else{
			$select = $db->prepare("INSERT INTO news (name, content)  VALUES(:name, :content) ");
			$select->execute(array(
				'name' => $name,
				'content' => $content
			));
			$session->setFlash("Le post a bien été ajouté", "success"); header('Location:index.php'); die();
		}
	}
}

if(isset($_GET['id'])){
	$id = (int) $_GET['id'];

	$select = $db->prepare("SELECT name, content FROM news WHERE id = :id LIMIT 1");
	$select->bindParam(':id', $id, PDO::PARAM_INT);
	$select->execute();

	$results = $select->fetch();

	$form->set(array(
		'name' => $results->name,
		'content' => $results->content
	));

	if($select->rowCount() == 0){
		$session->setFlash("Il y a pas de poste avec cet ID", "error"); header('Location:index.php'); die();
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Add category</title>
	<meta charset="utf-8">
</head>
<body>
	<section id="addpost">
		<h2>Add Post</h2>
		<form method="post">
			<div class="input">
				<?= $form->input("text", "name", "Nom de votre contenu :", array("placeholder" => "Nom de votre poste"), null); ?>
				<?php if(isset($error_name)): ?>
				<span class="error-name">
					<?= $error_name; ?>
				</span>
				<?php endif; ?>
			</div>
			<div class="input">
				<?= $form->text("content", "Votre contenu :", array("placeholder" => "votre contenu", "rows" => "20", "cols" => "50"), null ); ?>
				<?php if(isset($error_content)): ?>
				<span class="error-name">
					<?= $error_content; ?>
				</span>
				<?php endif; ?>
			</div>
			<div class="input">
				<?= $form->submit('submit', 'Envoyer'); ?>
			</div>
		</form>
	</section>
</body>
</html>