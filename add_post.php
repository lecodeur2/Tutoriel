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

	if(isset($_GET['id'])){

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
				<?= $form->input("text", "name", "Nom de la catégorie :", array("placeholder" => "Nom de la catégorie"), null); ?>
				<?php if(isset($error_name)): ?>
				<span class="error-name">
					<?= $error_name; ?>
				</span>
				<?php endif; ?>
			</div>
			<div class="input">
				<?= $form->text("content", "Votre message :", array("placeholder" => "votre message", "rows" => "20", "cols" => "50"), null ); ?>
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